<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->create([
                'email' => 'josefo727@gmail.com'
            ]);

        User::factory()
            ->count(15)
            ->create();
    }
}
