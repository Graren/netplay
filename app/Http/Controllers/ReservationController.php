<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Reservation;
use App\Stablishment;

use Auth;

use Validator;

class ReservationController extends Controller
{
    public function __construct()
    {
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       $this->middleware('jwt.auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();
        return $reservations;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO: Nada de esto vale un refactor
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'stablishment_id' => 'required|exists:stablishments,id',
            'start' => 'required',
            'end' => 'required',
            'commodity_id' => 'required|exists:commodities,id'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 400);
        }

        $stablishment = Stablishment::where('id',$request->stablishment_id)->first();
        $slots = $stablishment->commodities()->where('commodity_id',$request->commodity_id)->first()->pivot->slots;

        if(Reservation::where('start','<=', $request->start)->where('end','>',$request->start)->where('commodity_id',$request->commodity_id)->where('stablishment_id',$request->stablishment_id)->count() >= $slots ){
          return response()->json(['message' => 'That Time is Alredy Taken']);
        }

        $reservation = new Reservation($request->all());
        $reservation->user_id= $user->id;
        $reservation->save();
        return response()->json(['message' => 'Reservation Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::where('id',$id)->first();
        if($reservation == null){
          return response()->json(['message' => 'Reservation Not Found'],400);
        }
        return $reservation;
    }

    public function me()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->get();
        if($reservations == null){
          return response()->json(['message' => 'Reservations not found'],400);
        }
        return $reservations;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
