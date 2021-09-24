<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\MedicalAppointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalAppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MedicalAppointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTime,
            'status' => 'programado',
            'doctor_id' => \App\Models\Doctor::factory(),
            'patient_id' => \App\Models\Patient::factory(),
            'user_id' => \App\Models\User::factory()
        ];
    }
}
