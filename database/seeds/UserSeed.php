<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fullName' => 'John Doe',
            'email' => 'john.doe@yahoo.com',
            'password' => 'demo',
            'role' => 'su'
        ]);
    }
}
