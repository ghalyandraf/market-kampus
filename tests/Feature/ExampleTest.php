<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_root_shows_role_selection_welcome(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Mau masuk sebagai siapa hari ini?')
            ->assertSee('/register?role=buyer', false)
            ->assertSee('/register?role=seller', false)
            ->assertSee('/register?role=driver', false);
    }
}
