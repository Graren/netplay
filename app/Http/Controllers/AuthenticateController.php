<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Http\Requests;
use Carbon\Carbon;

class AuthenticateController extends Controller
{
  public function __construct()
  {
     // Apply the jwt.auth middleware to all methods in this controller
     // except for the authenticate method. We don't want to prevent
     // the user from retrieving their token if they don't already have it
     $this->middleware('jwt.auth', ['except' => ['authenticate', 'signup']]);
  }

  public function index()
  {
      // Retrieve all the users in the database and return them
      $users = User::all();
      return $users;
  }

  public function authenticate(Request $request)
  {
      // grab credentials from the request
      $credentials = $request->only('email', 'password');

      try {
          // attempt to verify the credentials and create a token for the user
          if (! $token = JWTAuth::attempt($credentials)) {
              return response()->json(['error' => 'invalid_credentials'], 401);
          }
      } catch (JWTException $e) {
          // something went wrong whilst attempting to encode the token
          return response()->json(['error' => 'could_not_create_token'], 500);
      }
      //update last login
      $user = JWTAuth::authenticate($token);
      $user->save();
      // all good so return the token
      return response()->json(compact('token'));
  }

  public function signup(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'name' =>'required',
          'email' => 'required|email|unique:users,email',
          'password' => 'required',
          'plan' => 'required'
      ]);
      if ($validator->fails()) {
          return response()->json(['message' => $validator->messages()], 400);
      }
      $user = new User($request->all());
      $user->save();
      return response()->json(['token' => JWTAuth::fromUser($user)]);
  }
}
