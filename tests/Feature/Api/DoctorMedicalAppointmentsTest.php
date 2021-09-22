<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Doctor;
use App\Models\MedicalAppointment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DoctorMedicalAppointmentsTest extends TestCase
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
    public function it_gets_doctor_medical_appointments()
    {
        $doctor = Doctor::factory()->create();
        $medicalAppointments = MedicalAppointment::factory()
            ->count(2)
            ->create([
                'doctor_id' => $doctor->id,
            ]);

        $response = $this->getJson(
            route('api.doctors.medical-appointments.index', $doctor)
        );

        $response->assertOk()->assertSee($medicalAppointments[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_doctor_medical_appointments()
    {
        $doctor = Doctor::factory()->create();
        $data = MedicalAppointment::factory()
            ->make([
                'doctor_id' => $doctor->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.doctors.medical-appointments.store', $doctor),
            $data
        );

        $this->assertDatabaseHas('medical_appointments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $medicalAppointment = MedicalAppointment::latest('id')->first();

        $this->assertEquals($doctor->id, $medicalAppointment->doctor_id);
    }
}
