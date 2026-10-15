<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\CertificationScheme;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Login');
        $response->assertSee(route('register'), false);
    }

    public function test_registration_page_is_accessible(): void
    {
        $this->get('/register')
            ->assertOk()
            ->assertSee('Registrasi');
    }

    public function test_guest_can_register_and_is_authenticated(): void
    {
        $this->post('/register', [
            'name' => 'New User',
            'email' => 'new@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ])->assertRedirect('/dashboard');

        $user = User::where('email', 'new@example.com')->firstOrFail();

        $this->assertAuthenticatedAs($user);
        $this->assertTrue(Hash::check('password123', $user->password));
        $this->assertSame('user', $user->role);
    }

    public function test_registered_user_gets_a_separate_dashboard_without_admin_access(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $scheme = CertificationScheme::create([
            'code' => 'JWD-01',
            'name' => 'Junior Web Developer',
            'description' => 'Skema pengembangan web tingkat junior.',
        ]);
        $student = Student::create([
            'name' => 'Andi Peserta',
            'nim' => '2026001',
            'major' => 'Teknik Informatika',
            'email' => 'andi@example.com',
            'certification_scheme_id' => $scheme->id,
        ]);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Dashboard User')
            ->assertSee('Andi Peserta')
            ->assertSee('Junior Web Developer')
            ->assertSee(route('students.index'), false);

        $this->get('/students')
            ->assertOk()
            ->assertSee('Andi Peserta')
            ->assertDontSee('Tambah Peserta')
            ->assertDontSee('Edit')
            ->assertDontSee('Hapus');
        $this->get(route('students.show', $student))
            ->assertOk()
            ->assertSee('Andi Peserta')
            ->assertDontSee('Ubah Data');
        $this->get('/students/create')->assertForbidden();
        $this->post('/students')->assertForbidden();
        $this->get('/certification-schemes')->assertForbidden();
    }

    public function test_admin_can_access_management_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Panel Administrator');

        $this->get('/students')->assertOk();
    }

    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/logout')
            ->assertRedirect('/');

        $this->assertGuest();
    }

    public function test_guest_cannot_access_management_pages(): void
    {
        $this->get('/students')->assertRedirect('/login');
        $this->get('/certification-schemes')->assertRedirect('/login');
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_login_rejects_invalid_credentials(): void
    {
        $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }
}
