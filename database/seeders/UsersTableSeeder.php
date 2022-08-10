<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\User;

use Carbon\Carbon;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this -> command -> info('Seeding: DatabaseSeeder!');

        $users = [
            'admin' => [
                    'username'      => 'admin',
                    'password'      => 'Password', // $2y$10$tySIrWuYcOjZmQQ6WOERu.wk1JOmOIiQ5TboOs0eijrTA/nJ1DDzG',
                    // 'password'       => '$2y$10$7EMc/1kS3h/LOzH9IkXakOzHi9EG1PCDhmO3ckYlZcIh8R2jnQ0WK', // -- admin

                    'email'         => 'admin@example.com',
                    'family_name'   => 'Almighty',
                    'given_name'    => 'Admin',

                    'created_at'    => Carbon::now() -> subHour(),
                    'updated_at'    => Carbon::now() -> subHour(),
                ],
            'user'  => [
                    'username'      => 'user',
                    'password'      => 'Password', // $2y$10$tySIrWuYcOjZmQQ6WOERu.wk1JOmOIiQ5TboOs0eijrTA/nJ1DDzG',

                    'email'         => 'user@example.com',
                    'family_name'   => 'Humble',
                    'given_name'    => 'User',

                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ],
            'atobyss'  => [
                    'username'      => 'atobyss',
                    'password'      => 'Password', // $2y$10$tySIrWuYcOjZmQQ6WOERu.wk1JOmOIiQ5TboOs0eijrTA/nJ1DDzG',

                    'email'         => 'atobys@adient.com',
                    'family_name'   => 'Tobys',
                    'given_name'    => 'Sławomir',

                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ],
        ];

        $admin = User::create($users['admin']);
        $admin -> assignRole('supervisor');

        User::create($users['user']);
        
        $atobyss = User::create($users['atobyss']);
        $atobyss -> assignRole('admin');


        // $password = Hash::make('password');

        // And now let's generate a few dozen users for our app:
        // for ($i = 0; $i < 16; $i++) {
        //     User::create([
        //         'username'  => $faker -> username,
        //         'password'      => '$2y$10$tySIrWuYcOjZmQQ6WOERu.wk1JOmOIiQ5TboOs0eijrTA/nJ1DDzG',

        //         'family_name'   => $faker->name,
        //         'given_name'    => $faker->name,
        //     ]);
        // }
    }
}
