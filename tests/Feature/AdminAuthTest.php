<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('admin.login'));
        $response->assertStatus(200);
        $response->assertSee('RIYA FASHION');
        $response->assertSee('Admin Management Portal');
    }

    public function test_unauthenticated_user_cannot_access_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_authenticate_with_valid_credentials(): void
    {
        $admin = User::create([
            'name' => 'Pintu Kukadiya',
            'email' => 'admin@riyafashion.com',
            'password' => Hash::make('SecretPass123!'),
            'is_admin' => true,
        ]);

        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@riyafashion.com',
            'password' => 'SecretPass123!',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_cannot_authenticate_with_invalid_password(): void
    {
        User::create([
            'name' => 'Pintu Kukadiya',
            'email' => 'admin@riyafashion.com',
            'password' => Hash::make('SecretPass123!'),
            'is_admin' => true,
        ]);

        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@riyafashion.com',
            'password' => 'WrongPassword',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    public function test_admin_can_logout_successfully(): void
    {
        $admin = User::create([
            'name' => 'Pintu Kukadiya',
            'email' => 'admin@riyafashion.com',
            'password' => Hash::make('SecretPass123!'),
            'is_admin' => true,
        ]);

        $this->actingAs($admin);

        $response = $this->post(route('admin.logout'));

        $this->assertGuest();
        $response->assertRedirect(route('admin.login'));
    }
}
