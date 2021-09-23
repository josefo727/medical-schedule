<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

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
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'gender' => 'hombre',
            'birthday' => $this->faker->date,
        ];
    }
}
