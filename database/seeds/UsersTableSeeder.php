<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = [
        [
           'name' => 'Daniel Reinoso',
           'email' => 'daniel@gmail.com',
           'password' => bcrypt('secretpassword'),
           'created_at' => date("Y-m-d H:i:s"),
           'plan' => 3
       ],
       [
            'name' => 'Oscar Colmenares ',
            'email' => 'oscar@gmail.com',
            'password' => bcrypt('secretpassword'),
            'created_at' => date("Y-m-d H:i:s"),
            'plan' => 3
       ],
       [
             'name' => 'Oreste Hernandez',
             'email' => 'oreste@gmail.com',
             'password' => bcrypt('secretpassword'),
             'created_at' => date("Y-m-d H:i:s"),
             'plan' => 3
       ],
       [
             'name' => 'Eduardo Pacheco',
             'email' => 'eduardo@gmail.com',
             'password' => bcrypt('secretpassword'),
             'created_at' => date("Y-m-d H:i:s"),
             'plan' => 3
      ],
      [
             'name' => 'Jerry',
             'email' => 'jerry@gmail.com',
             'password' => bcrypt('secretpassword'),
             'created_at' => date("Y-m-d H:i:s"),
             'plan' => 3
      ]
    ];

    App\User::hydrate($users)->each(function($user) {
        $user->exists = false;
        $user->save();
    });

    factory(App\User::class, 50)->create();
    }
}
