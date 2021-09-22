<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Specialty;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpecialtyControllerTest extends TestCase
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
    public function it_displays_index_view_with_specialties()
    {
        $specialties = Specialty::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('specialties.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.specialties.index')
            ->assertViewHas('specialties');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_specialty()
    {
        $response = $this->get(route('specialties.create'));

        $response->assertOk()->assertViewIs('app.specialties.create');
    }

    /**
     * @test
     */
    public function it_stores_the_specialty()
    {
        $data = Specialty::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('specialties.store'), $data);

        $this->assertDatabaseHas('specialties', $data);

        $specialty = Specialty::latest('id')->first();

        $response->assertRedirect(route('specialties.edit', $specialty));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_specialty()
    {
        $specialty = Specialty::factory()->create();

        $response = $this->get(route('specialties.show', $specialty));

        $response
            ->assertOk()
            ->assertViewIs('app.specialties.show')
            ->assertViewHas('specialty');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_specialty()
    {
        $specialty = Specialty::factory()->create();

        $response = $this->get(route('specialties.edit', $specialty));

        $response
            ->assertOk()
            ->assertViewIs('app.specialties.edit')
            ->assertViewHas('specialty');
    }

    /**
     * @test
     */
    public function it_updates_the_specialty()
    {
        $specialty = Specialty::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->put(route('specialties.update', $specialty), $data);

        $data['id'] = $specialty->id;

        $this->assertDatabaseHas('specialties', $data);

        $response->assertRedirect(route('specialties.edit', $specialty));
    }

    /**
     * @test
     */
    public function it_deletes_the_specialty()
    {
        $specialty = Specialty::factory()->create();

        $response = $this->delete(route('specialties.destroy', $specialty));

        $response->assertRedirect(route('specialties.index'));

        $this->assertDeleted($specialty);
    }
}
