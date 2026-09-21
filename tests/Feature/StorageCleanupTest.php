<?php

namespace Tests\Feature;

use App\Models\Galeri;
use App\Models\Sales;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StorageCleanupTest extends TestCase
{
    use RefreshDatabase;

    public function test_gallery_file_deleted_when_row_deleted(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('galeri/sales/foto.jpg', 'data');
        $foto = Galeri::create([
            'sales_id' => Sales::factory()->create()->id,
            'image_path' => 'galeri/sales/foto.jpg',
        ]);

        $foto->delete();

        Storage::disk('public')->assertMissing('galeri/sales/foto.jpg');
    }

    public function test_photo_kept_on_soft_delete_and_removed_on_force_delete(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('sales/photos/p.jpg', 'data');
        $sales = Sales::factory()->create(['photo_path' => 'sales/photos/p.jpg']);

        $sales->delete();
        Storage::disk('public')->assertExists('sales/photos/p.jpg');

        $sales->forceDelete();
        Storage::disk('public')->assertMissing('sales/photos/p.jpg');
    }

    public function test_old_photo_deleted_when_replaced(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('sales/photos/old.jpg', 'data');
        Storage::disk('public')->put('sales/photos/new.jpg', 'data');
        $sales = Sales::factory()->create(['photo_path' => 'sales/photos/old.jpg']);

        $sales->update(['photo_path' => 'sales/photos/new.jpg']);

        Storage::disk('public')->assertMissing('sales/photos/old.jpg');
        Storage::disk('public')->assertExists('sales/photos/new.jpg');
    }

    public function test_deleting_sales_removes_its_gallery_rows_and_files(): void
    {
        // Regresi: foreign key ON DELETE CASCADE menghapus baris galeri di level
        // database SEBELUM event forceDeleted berjalan, sehingga file foto
        // terlantar di disk. Pembersihan harus dilakukan di forceDeleting.
        $sales = Sales::factory()->create();

        Storage::disk('public')->put('galeri/sales/x1.jpg', 'x');
        Storage::disk('public')->put('galeri/sales/x2.jpg', 'x');

        $sales->galeris()->create(['image_path' => 'galeri/sales/x1.jpg']);
        $sales->galeris()->create(['image_path' => 'galeri/sales/x2.jpg']);

        $this->assertSame(2, $sales->galeris()->count());

        $sales->forceDelete();

        $this->assertSame(0, Galeri::where('sales_id', $sales->id)->count());
        $this->assertFalse(Storage::disk('public')->exists('galeri/sales/x1.jpg'));
        $this->assertFalse(Storage::disk('public')->exists('galeri/sales/x2.jpg'));
    }
}
