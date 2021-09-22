<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'record' => $this->faker->text,
            'evaluation' => $this->faker->text,
            'diagnosis' => $this->faker->text,
            'recommendations' => $this->faker->text,
            'medical_appointment_id' => \App\Models\MedicalAppointment::factory(),
        ];
    }
}
