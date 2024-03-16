<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'username' => 'Fast Spring',
            'name' => 'Fast',
            'surname' => 'Spring',
            'email' => 'test@fastspring.com',
            'password' => bcrypt('FastSpring1234'),
            'fs_account_id' => 'Po4-MoBxTCCr9iGvp7bG8w'
            //nvXALr7mSQqpBQcqqqFAcQ - sub id
        ]);
    }
}