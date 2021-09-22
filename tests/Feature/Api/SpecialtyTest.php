<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Specialty;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpecialtyTest extends TestCase
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
    public function it_gets_specialties_list()
    {
        $specialties = Specialty::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.specialties.index'));

        $response->assertOk()->assertSee($specialties[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_specialty()
    {
        $data = Specialty::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.specialties.store'), $data);

        $this->assertDatabaseHas('specialties', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.specialties.update', $specialty),
            $data
        );

        $data['id'] = $specialty->id;

        $this->assertDatabaseHas('specialties', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_specialty()
    {
        $specialty = Specialty::factory()->create();

        $response = $this->deleteJson(
            route('api.specialties.destroy', $specialty)
        );

        $this->assertDeleted($specialty);

        $response->assertNoContent();
    }
}
