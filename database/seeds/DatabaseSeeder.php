<?php

use App\Subject;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 3)->create()->each(function (User $user) {
            $user->subjects()
                ->saveMany(
                    factory(Subject::class, rand(1, 3))->make()
                );
        });
    }
}
