<?php

namespace Tests\Feature;

use App\Models\Sales;
use App\Models\SalesDocument;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StorageCleanupTest extends TestCase
{
    use RefreshDatabase;

    public function test_document_file_deleted_when_document_deleted(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('sales/documents/doc.jpg', 'data');
        $doc = SalesDocument::create([
            'sales_id' => Sales::factory()->create()->id,
            'file_path' => 'sales/documents/doc.jpg',
        ]);

        $doc->delete();

        Storage::disk('public')->assertMissing('sales/documents/doc.jpg');
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
}
