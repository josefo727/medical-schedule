<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Doctor;

use App\Models\Specialty;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DoctorTest extends TestCase
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
    public function it_gets_doctors_list()
    {
        $doctors = Doctor::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.doctors.index'));

        $response->assertOk()->assertSee($doctors[0]->document_nro);
    }

    /**
     * @test
     */
    public function it_stores_the_doctor()
    {
        $data = Doctor::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.doctors.store'), $data);

        $this->assertDatabaseHas('doctors', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_doctor()
    {
        $doctor = Doctor::factory()->create();

        $specialty = Specialty::factory()->create();

        $data = [
            'document_nro' => $this->faker->text(255),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'specialty_id' => $specialty->id,
        ];

        $response = $this->putJson(route('api.doctors.update', $doctor), $data);

        $data['id'] = $doctor->id;

        $this->assertDatabaseHas('doctors', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_doctor()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->deleteJson(route('api.doctors.destroy', $doctor));

        $this->assertDeleted($doctor);

        $response->assertNoContent();
    }
}
