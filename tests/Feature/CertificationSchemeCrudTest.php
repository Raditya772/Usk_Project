<?php

namespace Tests\Feature;

use App\Models\CertificationScheme;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CertificationSchemeCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create(['role' => 'admin']));
    }

    public function test_user_can_create_update_and_delete_a_scheme(): void
    {
        $this->post(route('certification-schemes.store'), [
            'code' => 'JWD-01',
            'name' => 'Junior Web Developer',
            'description' => 'Pengembangan web.',
        ])->assertRedirect(route('certification-schemes.index'));

        $scheme = CertificationScheme::firstOrFail();
        $this->assertDatabaseHas('certification_schemes', ['code' => 'JWD-01']);

        $this->put(route('certification-schemes.update', $scheme), [
            'code' => 'JWD-01',
            'name' => 'Junior Web Developer Updated',
            'description' => 'Deskripsi terbaru.',
        ])->assertRedirect(route('certification-schemes.index'));

        $this->assertDatabaseHas('certification_schemes', [
            'id' => $scheme->id,
            'name' => 'Junior Web Developer Updated',
        ]);

        $this->delete(route('certification-schemes.destroy', $scheme))
            ->assertRedirect(route('certification-schemes.index'));
        $this->assertDatabaseMissing('certification_schemes', ['id' => $scheme->id]);
    }

    public function test_scheme_in_use_cannot_be_deleted(): void
    {
        $scheme = CertificationScheme::create([
            'code' => 'JWD-01',
            'name' => 'Junior Web Developer',
        ]);
        Student::create([
            'name' => 'Andi',
            'nim' => '2023001',
            'major' => 'Sistem Informasi',
            'email' => 'andi@example.com',
            'certification_scheme_id' => $scheme->id,
        ]);

        $this->delete(route('certification-schemes.destroy', $scheme))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('certification_schemes', ['id' => $scheme->id]);
    }

    public function test_scheme_code_must_be_unique(): void
    {
        CertificationScheme::create(['code' => 'JWD-01', 'name' => 'Skema Pertama']);

        $this->post(route('certification-schemes.store'), [
            'code' => 'JWD-01',
            'name' => 'Skema Duplikat',
        ])->assertSessionHasErrors('code');
    }
}
