<?php

namespace Database\Seeders;

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
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(SpecialtySeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(ReportSeeder::class);
        $this->call(MedicalAppointmentSeeder::class);
    }
}
