<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Report;

use App\Models\MedicalAppointment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportTest extends TestCase
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
    public function it_gets_reports_list()
    {
        $reports = Report::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.reports.index'));

        $response->assertOk()->assertSee($reports[0]->record);
    }

    /**
     * @test
     */
    public function it_stores_the_report()
    {
        $data = Report::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.reports.store'), $data);

        $this->assertDatabaseHas('reports', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_report()
    {
        $report = Report::factory()->create();

        $medicalAppointment = MedicalAppointment::factory()->create();

        $data = [
            'record' => $this->faker->text,
            'evaluation' => $this->faker->text,
            'diagnosis' => $this->faker->text,
            'recommendations' => $this->faker->text,
            'medical_appointment_id' => $medicalAppointment->id,
        ];

        $response = $this->putJson(route('api.reports.update', $report), $data);

        $data['id'] = $report->id;

        $this->assertDatabaseHas('reports', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_report()
    {
        $report = Report::factory()->create();

        $response = $this->deleteJson(route('api.reports.destroy', $report));

        $this->assertDeleted($report);

        $response->assertNoContent();
    }
}
