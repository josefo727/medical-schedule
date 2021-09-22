<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\MedicalAppointment;

use App\Models\Doctor;
use App\Models\Patient;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicalAppointmentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_medical_appointments_list()
    {
        $medicalAppointments = MedicalAppointment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.medical-appointments.index'));

        $response->assertOk()->assertSee($medicalAppointments[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_medical_appointment()
    {
        $data = MedicalAppointment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.medical-appointments.store'),
            $data
        );

        $this->assertDatabaseHas('medical_appointments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_medical_appointment()
    {
        $medicalAppointment = MedicalAppointment::factory()->create();

        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();

        $data = [
            'date' => $this->faker->dateTime,
            'status' => 'programado',
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
        ];

        $response = $this->putJson(
            route('api.medical-appointments.update', $medicalAppointment),
            $data
        );

        $data['id'] = $medicalAppointment->id;

        $this->assertDatabaseHas('medical_appointments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_medical_appointment()
    {
        $medicalAppointment = MedicalAppointment::factory()->create();

        $response = $this->deleteJson(
            route('api.medical-appointments.destroy', $medicalAppointment)
        );

        $this->assertDeleted($medicalAppointment);

        $response->assertNoContent();
    }
}
