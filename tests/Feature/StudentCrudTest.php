<?php

namespace Tests\Feature;

use App\Models\CertificationScheme;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create(['role' => 'admin']));
    }

    private function createScheme(): CertificationScheme
    {
        return CertificationScheme::create([
            'code' => 'JWD-01',
            'name' => 'Junior Web Developer',
            'description' => 'Skema pengembangan web tingkat junior.',
        ]);
    }

    public function test_students_index_page_is_accessible(): void
    {
        $response = $this->get('/students');

        $response->assertStatus(200);
        $response->assertSee('Data Peserta');
    }

    public function test_user_can_create_a_student(): void
    {
        $scheme = $this->createScheme();
        $response = $this->post('/students', [
            'name' => 'Andi',
            'nim' => '2023001',
            'major' => 'Sistem Informasi',
            'email' => 'andi@example.com',
            'certification_scheme_id' => $scheme->id,
        ]);

        $response->assertRedirect('/students');
        $this->assertDatabaseHas('students', [
            'name' => 'Andi',
            'nim' => '2023001',
            'certification_scheme_id' => $scheme->id,
        ]);
    }

    public function test_student_requires_a_valid_certification_scheme(): void
    {
        $this->post('/students', [
            'name' => 'Andi',
            'nim' => '2023001',
            'major' => 'Sistem Informasi',
            'email' => 'andi@example.com',
        ])->assertSessionHasErrors('certification_scheme_id');

        $this->assertDatabaseCount('students', 0);
    }

    public function test_student_detail_shows_its_certification_scheme(): void
    {
        $scheme = $this->createScheme();
        $student = Student::create([
            'name' => 'Andi',
            'nim' => '2023001',
            'major' => 'Sistem Informasi',
            'email' => 'andi@example.com',
            'certification_scheme_id' => $scheme->id,
        ]);

        $this->get(route('students.show', $student))
            ->assertOk()
            ->assertSee('Junior Web Developer');
    }

    public function test_user_can_update_and_delete_a_student(): void
    {
        $scheme = $this->createScheme();
        $student = Student::create([
            'name' => 'Andi',
            'nim' => '2023001',
            'major' => 'Sistem Informasi',
            'email' => 'andi@example.com',
            'certification_scheme_id' => $scheme->id,
        ]);

        $this->put(route('students.update', $student), [
            'name' => 'Andi Updated',
            'nim' => '2023001',
            'major' => 'Teknik Informatika',
            'email' => 'andi@example.com',
            'certification_scheme_id' => $scheme->id,
        ])->assertRedirect(route('students.index'));

        $this->assertDatabaseHas('students', ['id' => $student->id, 'name' => 'Andi Updated']);

        $this->delete(route('students.destroy', $student))->assertRedirect(route('students.index'));
        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    public function test_students_can_be_searched(): void
    {
        $scheme = $this->createScheme();
        $this->post('/students', [
            'name' => 'Andi',
            'nim' => '2023001',
            'major' => 'Sistem Informasi',
            'email' => 'andi@example.com',
            'certification_scheme_id' => $scheme->id,
        ]);

        $this->post('/students', [
            'name' => 'Budi',
            'nim' => '2023002',
            'major' => 'Teknik Informatika',
            'email' => 'budi@example.com',
            'certification_scheme_id' => $scheme->id,
        ]);

        $response = $this->get('/students?search=Andi');

        $response->assertStatus(200);
        $response->assertSee('Andi');
        $response->assertDontSee('Budi');
    }
}
