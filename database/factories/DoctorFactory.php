<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'document_nro' => (string) rand(1000000000, 1500000000),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'specialty_id' => \App\Models\Specialty::factory(),
        ];
    }
}
