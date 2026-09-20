<?php

namespace Tests\Feature;

use App\Filament\Pages\MyProfile;
use App\Filament\Resources\Sales\SalesResource;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class SalesAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_any_sales(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->assertTrue(Gate::forUser($admin)->allows('viewAny', Sales::class));
        $this->actingAs($admin);
        $this->assertTrue(SalesResource::canViewAny());
    }

    public function test_sales_cannot_view_sales_list(): void
    {
        $salesUser = User::factory()->create(['role' => 'sales']);
        Sales::factory()->create(['user_id' => $salesUser->id]);

        $this->assertFalse(Gate::forUser($salesUser)->allows('viewAny', Sales::class));

        $this->actingAs($salesUser);
        $this->assertFalse(SalesResource::canViewAny());
        $this->assertFalse(SalesResource::shouldRegisterNavigation());
    }

    public function test_sales_can_view_own_record(): void
    {
        $salesUser = User::factory()->create(['role' => 'sales']);
        $own = Sales::factory()->create(['user_id' => $salesUser->id]);

        $this->assertTrue(Gate::forUser($salesUser)->allows('view', $own));
    }

    public function test_sales_cannot_view_other_record(): void
    {
        $salesUser = User::factory()->create(['role' => 'sales']);
        Sales::factory()->create(['user_id' => $salesUser->id]);

        $other = Sales::factory()->create(['user_id' => User::factory()->create(['role' => 'sales'])->id]);

        $this->assertFalse(Gate::forUser($salesUser)->allows('view', $other));
        $this->assertFalse(Gate::forUser($salesUser)->allows('update', $other));
    }

    public function test_sales_cannot_delete_record(): void
    {
        $salesUser = User::factory()->create(['role' => 'sales']);
        $own = Sales::factory()->create(['user_id' => $salesUser->id]);

        $this->assertFalse(Gate::forUser($salesUser)->allows('delete', $own));
        $this->assertFalse(Gate::forUser($salesUser)->allows('restore', $own));
        $this->assertFalse(Gate::forUser($salesUser)->allows('forceDelete', $own));
    }

    public function test_sales_cannot_update_slug_via_my_profile(): void
    {
        $salesUser = User::factory()->create(['role' => 'sales']);
        $sales = Sales::factory()->create(['user_id' => $salesUser->id]);
        $originalSlug = $sales->slug;

        $this->actingAs($salesUser);

        \Livewire\Livewire::test(MyProfile::class)
            ->set('data.name', 'Nama Baru')
            ->set('data.slug', 'slug-bajakan')
            ->call('save');

        $sales->refresh();

        $this->assertSame($originalSlug, $sales->slug);
        $this->assertSame('Nama Baru', $sales->name);
        $this->assertTrue($sales->is_active);
    }

    public function test_inactive_sales_not_listed_publicly(): void
    {
        $active = Sales::factory()->create(['is_active' => true]);
        $inactive = Sales::factory()->create(['is_active' => false]);

        $ids = Sales::query()->where('is_active', true)->pluck('id');

        $this->assertTrue($ids->contains($active->id));
        $this->assertFalse($ids->contains($inactive->id));
    }
}
