<?php

namespace Tests\Feature;

use App\Filament\Pages\MyProfile;
use App\Filament\Resources\SalesDocuments\Pages\CreateSalesDocument;
use App\Filament\Resources\SalesDocuments\Pages\ListSalesDocuments;
use App\Filament\Resources\SalesDocuments\SalesDocumentResource;
use App\Filament\Resources\Sales\SalesResource;
use App\Models\Sales;
use App\Models\SalesDocument;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class SalesPanelTest extends TestCase
{
    use RefreshDatabase;

    private function makeSalesUser(): array
    {
        $user = User::factory()->create(['role' => 'sales']);
        $sales = Sales::factory()->create(['user_id' => $user->id]);

        return [$user, $sales];
    }

    public function test_sales_sees_own_profile_page(): void
    {
        [$user, $sales] = $this->makeSalesUser();

        $this->actingAs($user)
            ->get(MyProfile::getUrl())
            ->assertOk();

        Livewire::actingAs($user)
            ->test(MyProfile::class)
            ->assertSet('data.name', $sales->name);
    }

    public function test_sales_cannot_see_sales_resource(): void
    {
        [$user] = $this->makeSalesUser();

        $this->assertFalse(SalesResource::canViewAny());

        $this->actingAs($user)
            ->get(SalesResource::getUrl('index'))
            ->assertForbidden();
    }

    public function test_sales_sees_only_own_documents(): void
    {
        [$userA, $salesA] = $this->makeSalesUser();
        [$userB, $salesB] = $this->makeSalesUser();

        $docA = SalesDocument::create(['sales_id' => $salesA->id, 'file_path' => 'sales/documents/a.jpg', 'caption' => 'Milik A']);
        $docB = SalesDocument::create(['sales_id' => $salesB->id, 'file_path' => 'sales/documents/b.jpg', 'caption' => 'Milik B']);

        $this->actingAs($userA);

        $ids = SalesDocumentResource::getEloquentQuery()->pluck('id');

        $this->assertTrue($ids->contains($docA->id));
        $this->assertFalse($ids->contains($docB->id));

        Livewire::test(ListSalesDocuments::class)
            ->assertCanSeeTableRecords([$docA])
            ->assertCanNotSeeTableRecords([$docB]);
    }

    public function test_sales_cannot_attach_document_to_other_sales(): void
    {
        Storage::fake('public');

        [$userA, $salesA] = $this->makeSalesUser();
        [$userB, $salesB] = $this->makeSalesUser();

        $file = UploadedFile::fake()->image('foto.jpg');

        Livewire::actingAs($userA)
            ->test(CreateSalesDocument::class)
            ->set('data.sales_id', $salesB->id)
            ->set('data.file_path', $file)
            ->set('data.caption', 'Coba titip')
            ->call('create')
            ->assertHasNoFormErrors();

        $doc = SalesDocument::query()->latest('id')->first();

        $this->assertNotNull($doc);
        $this->assertSame($salesA->id, $doc->sales_id);
        $this->assertNotSame($salesB->id, $doc->sales_id);
    }

    public function test_sales_cannot_change_slug(): void
    {
        [$user, $sales] = $this->makeSalesUser();
        $originalSlug = $sales->slug;

        Livewire::actingAs($user)
            ->test(MyProfile::class)
            ->set('data.slug', 'slug-bajakan')
            ->set('data.is_active', false)
            ->set('data.sort_order', 999)
            ->call('save');

        $sales->refresh();

        $this->assertSame($originalSlug, $sales->slug);
        $this->assertTrue((bool) $sales->is_active);
        $this->assertNotSame(999, $sales->sort_order);
    }

    public function test_sales_can_upload_own_document(): void
    {
        Storage::fake('public');

        [$user, $sales] = $this->makeSalesUser();

        $file = UploadedFile::fake()->image('dokumentasi.jpg');

        Livewire::actingAs($user)
            ->test(CreateSalesDocument::class)
            ->set('data.file_path', $file)
            ->set('data.caption', 'Serah terima unit')
            ->call('create')
            ->assertHasNoFormErrors();

        $doc = SalesDocument::query()->first();

        $this->assertNotNull($doc);
        $this->assertSame($sales->id, $doc->sales_id);
        $this->assertSame('Serah terima unit', $doc->caption);
        Storage::disk('public')->assertExists($doc->file_path);
    }
}
