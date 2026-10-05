<?php

namespace Tests\Feature;

use App\Models\Campus;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductPhotoTest extends TestCase
{
    use RefreshDatabase;

    public function test_seller_can_upload_product_photo(): void
    {
        Storage::fake('public');
        $role = Role::create(['name' => 'seller']);
        $user = User::factory()->create([
            'role_id' => $role->id,
            'campus_name' => 'Kampus Foto',
            'is_verified' => true,
        ]);
        $campus = Campus::create(['name' => 'Kampus Foto']);
        $seller = Seller::create([
            'user_id' => $user->id,
            'campus_id' => $campus->id,
            'name' => 'Warung Foto',
        ]);
        $category = Category::create(['name' => 'Makanan']);

        $response = $this->actingAs($user)->post(route('seller.products.store'), [
            'category_id' => $category->id,
            'name' => 'Nasi Ceria',
            'description' => 'Menu kampus',
            'price' => 12000,
            'stock' => 7,
            'image' => UploadedFile::fake()->image('nasi.jpg', 640, 420),
        ]);

        $product = Product::where('seller_id', $seller->id)->first();

        $response->assertRedirect(route('seller.products.index'));
        $this->assertNotNull($product);
        $this->assertSame('Nasi Ceria', $product->name);
        $this->assertNotNull($product->image);
        Storage::disk('public')->assertExists($product->image);
    }
}
