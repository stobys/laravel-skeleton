<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Actions\Users\BatchUserLogin;
use App\Models\User;


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
            'batch' => [
                    'username'      => 'batch',
                    'password'      => '!',

                    'email'         => 'batch@local.app',
                    'family_name'   => 'BATCH',
                    'given_name'    => 'Batch',

                    'created_at'    => now() -> subHour(),
                    'updated_at'    => now() -> subHour(),
                ],
            'supervisor' => [
                    'username'      => 'supervisor',
                    'password'      => 'Password', // $2y$10$tySIrWuYcOjZmQQ6WOERu.wk1JOmOIiQ5TboOs0eijrTA/nJ1DDzG',

                    'email'         => 'supervisor@example.com',
                    'family_name'   => 'Almighty',
                    'given_name'    => 'Admin',

                    'created_at'    => now() -> subHour(),
                    'updated_at'    => now() -> subHour(),
                ],
            'user' => [
                'username'      => 'user',
                'password'      => 'Password', // $2y$10$tySIrWuYcOjZmQQ6WOERu.wk1JOmOIiQ5TboOs0eijrTA/nJ1DDzG',

                'email'         => 'user@example.com',
                'family_name'   => 'Simple',
                'given_name'    => 'User',

                'created_at'    => now(),
                'updated_at'    => now(),
            ],

        ];

        User::create($users['batch']);
        BatchUserLogin::run();
        
        $supervisor = User::create($users['supervisor']);
        $supervisor -> assignRole('supervisor');

        User::create($users['user'] + ['id' => 11]);
    }
}
