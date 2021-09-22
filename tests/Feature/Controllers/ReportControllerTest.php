<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Report;

use App\Models\MedicalAppointment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportControllerTest extends TestCase
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
    public function it_displays_index_view_with_reports()
    {
        $reports = Report::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('reports.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.reports.index')
            ->assertViewHas('reports');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_report()
    {
        $response = $this->get(route('reports.create'));

        $response->assertOk()->assertViewIs('app.reports.create');
    }

    /**
     * @test
     */
    public function it_stores_the_report()
    {
        $data = Report::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('reports.store'), $data);

        $this->assertDatabaseHas('reports', $data);

        $report = Report::latest('id')->first();

        $response->assertRedirect(route('reports.edit', $report));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_report()
    {
        $report = Report::factory()->create();

        $response = $this->get(route('reports.show', $report));

        $response
            ->assertOk()
            ->assertViewIs('app.reports.show')
            ->assertViewHas('report');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_report()
    {
        $report = Report::factory()->create();

        $response = $this->get(route('reports.edit', $report));

        $response
            ->assertOk()
            ->assertViewIs('app.reports.edit')
            ->assertViewHas('report');
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

        $response = $this->put(route('reports.update', $report), $data);

        $data['id'] = $report->id;

        $this->assertDatabaseHas('reports', $data);

        $response->assertRedirect(route('reports.edit', $report));
    }

    /**
     * @test
     */
    public function it_deletes_the_report()
    {
        $report = Report::factory()->create();

        $response = $this->delete(route('reports.destroy', $report));

        $response->assertRedirect(route('reports.index'));

        $this->assertDeleted($report);
    }
}
