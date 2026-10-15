<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_home_card_displays_students_from_the_database(): void
    {
        Student::create([
            'name' => 'Andi',
            'nim' => '2023001',
            'major' => 'Sistem Informasi',
            'email' => 'andi@example.com',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Peserta Terbaru');
        $response->assertSee('Andi - Sistem Informasi');
    }
}
