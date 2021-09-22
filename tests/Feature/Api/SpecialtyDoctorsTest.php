<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Specialty;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpecialtyDoctorsTest extends TestCase
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
    public function it_gets_specialty_doctors()
    {
        $specialty = Specialty::factory()->create();
        $doctors = Doctor::factory()
            ->count(2)
            ->create([
                'specialty_id' => $specialty->id,
            ]);

        $response = $this->getJson(
            route('api.specialties.doctors.index', $specialty)
        );

        $response->assertOk()->assertSee($doctors[0]->document_nro);
    }

    /**
     * @test
     */
    public function it_stores_the_specialty_doctors()
    {
        $specialty = Specialty::factory()->create();
        $data = Doctor::factory()
            ->make([
                'specialty_id' => $specialty->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.specialties.doctors.store', $specialty),
            $data
        );

        $this->assertDatabaseHas('doctors', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $doctor = Doctor::latest('id')->first();

        $this->assertEquals($specialty->id, $doctor->specialty_id);
    }
}
