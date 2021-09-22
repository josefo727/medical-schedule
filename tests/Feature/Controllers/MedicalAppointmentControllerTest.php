<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\MedicalAppointment;

use App\Models\Doctor;
use App\Models\Patient;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicalAppointmentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_medical_appointments()
    {
        $medicalAppointments = MedicalAppointment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('medical-appointments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.medical_appointments.index')
            ->assertViewHas('medicalAppointments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_medical_appointment()
    {
        $response = $this->get(route('medical-appointments.create'));

        $response->assertOk()->assertViewIs('app.medical_appointments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_medical_appointment()
    {
        $data = MedicalAppointment::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('medical-appointments.store'), $data);

        $this->assertDatabaseHas('medical_appointments', $data);

        $medicalAppointment = MedicalAppointment::latest('id')->first();

        $response->assertRedirect(
            route('medical-appointments.edit', $medicalAppointment)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_medical_appointment()
    {
        $medicalAppointment = MedicalAppointment::factory()->create();

        $response = $this->get(
            route('medical-appointments.show', $medicalAppointment)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.medical_appointments.show')
            ->assertViewHas('medicalAppointment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_medical_appointment()
    {
        $medicalAppointment = MedicalAppointment::factory()->create();

        $response = $this->get(
            route('medical-appointments.edit', $medicalAppointment)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.medical_appointments.edit')
            ->assertViewHas('medicalAppointment');
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

        $response = $this->put(
            route('medical-appointments.update', $medicalAppointment),
            $data
        );

        $data['id'] = $medicalAppointment->id;

        $this->assertDatabaseHas('medical_appointments', $data);

        $response->assertRedirect(
            route('medical-appointments.edit', $medicalAppointment)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_medical_appointment()
    {
        $medicalAppointment = MedicalAppointment::factory()->create();

        $response = $this->delete(
            route('medical-appointments.destroy', $medicalAppointment)
        );

        $response->assertRedirect(route('medical-appointments.index'));

        $this->assertDeleted($medicalAppointment);
    }
}
