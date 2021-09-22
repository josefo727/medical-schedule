<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Patient;
use App\Models\MedicalAppointment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientMedicalAppointmentsTest extends TestCase
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
    public function it_gets_patient_medical_appointments()
    {
        $patient = Patient::factory()->create();
        $medicalAppointments = MedicalAppointment::factory()
            ->count(2)
            ->create([
                'patient_id' => $patient->id,
            ]);

        $response = $this->getJson(
            route('api.patients.medical-appointments.index', $patient)
        );

        $response->assertOk()->assertSee($medicalAppointments[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_patient_medical_appointments()
    {
        $patient = Patient::factory()->create();
        $data = MedicalAppointment::factory()
            ->make([
                'patient_id' => $patient->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.patients.medical-appointments.store', $patient),
            $data
        );

        $this->assertDatabaseHas('medical_appointments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $medicalAppointment = MedicalAppointment::latest('id')->first();

        $this->assertEquals($patient->id, $medicalAppointment->patient_id);
    }
}
