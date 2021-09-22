<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Report;
use App\Models\MedicalAppointment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicalAppointmentReportsTest extends TestCase
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
    public function it_gets_medical_appointment_reports()
    {
        $medicalAppointment = MedicalAppointment::factory()->create();
        $reports = Report::factory()
            ->count(2)
            ->create([
                'medical_appointment_id' => $medicalAppointment->id,
            ]);

        $response = $this->getJson(
            route('api.medical-appointments.reports.index', $medicalAppointment)
        );

        $response->assertOk()->assertSee($reports[0]->record);
    }

    /**
     * @test
     */
    public function it_stores_the_medical_appointment_reports()
    {
        $medicalAppointment = MedicalAppointment::factory()->create();
        $data = Report::factory()
            ->make([
                'medical_appointment_id' => $medicalAppointment->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.medical-appointments.reports.store',
                $medicalAppointment
            ),
            $data
        );

        $this->assertDatabaseHas('reports', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $report = Report::latest('id')->first();

        $this->assertEquals(
            $medicalAppointment->id,
            $report->medical_appointment_id
        );
    }
}
