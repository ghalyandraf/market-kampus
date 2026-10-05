<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterCampusNameTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_accepts_custom_campus_name(): void
    {
        $role = Role::create(['name' => 'buyer']);

        $response = $this->post('/register', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.test',
            'password' => 'secret123',
            'role_id' => $role->id,
            'campus_name' => 'Kampus Buatan Sendiri',
            'phone' => '081234567890',
        ]);

        $response->assertRedirect('/buyer/dashboard');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'budi@example.test',
            'campus_name' => 'Kampus Buatan Sendiri',
        ]);
    }

    public function test_seller_register_creates_campus_from_custom_name(): void
    {
        $role = Role::create(['name' => 'seller']);

        $response = $this->post('/register', [
            'name' => 'Sari Seller',
            'email' => 'sari@example.test',
            'password' => 'secret123',
            'role_id' => $role->id,
            'campus_name' => 'Kampus Seller Bebas',
            'phone' => '081234567891',
        ]);

        $response->assertRedirect('/seller/dashboard');
        $this->assertDatabaseHas('users', [
            'email' => 'sari@example.test',
            'campus_name' => 'Kampus Seller Bebas',
        ]);
        $this->assertDatabaseHas('campuses', ['name' => 'Kampus Seller Bebas']);
        $this->assertDatabaseHas('sellers', ['name' => 'Sari Seller UMKM']);
    }

    public function test_register_page_locks_role_from_welcome_choice(): void
    {
        Role::create(['name' => 'buyer']);
        $seller = Role::create(['name' => 'seller']);
        Role::create(['name' => 'driver']);

        $response = $this->get('/register?role=seller');

        $response
            ->assertOk()
            ->assertSee('Seller')
            ->assertSee('Dipilih dari halaman awal')
            ->assertSee('name="role_id"', false)
            ->assertSee('value="'.$seller->id.'"', false)
            ->assertDontSee('<select id="role_id"', false);
    }
}
