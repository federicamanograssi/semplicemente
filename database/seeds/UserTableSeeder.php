<?php

use Illuminate\Database\Seeder;
use App\User;
<<<<<<< Updated upstream:database/seeds/UsersSeeder.php
class UsersSeeder extends Seeder
=======


class UserTableSeeder extends Seeder
>>>>>>> Stashed changes:database/seeds/UserTableSeeder.php
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = config('users');

        foreach ($users as $user) {
            $newUser = new User();
            $newUser->name = $user['name'];
            $newUser->surname = $user['surname'];
            $newUser->email = $user['email'];
            $newUser->password = $user['password'];
            $newUser->date_of_birth = $user['date_of_birth'];
            $newUser->save();
            };
    }
}
