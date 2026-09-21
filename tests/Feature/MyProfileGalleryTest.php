<?php

namespace Tests\Feature;

use App\Filament\Pages\MyProfile;
use App\Models\Galeri;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Sales mengelola foto galerinya dari halaman "Profil Saya", karena menu Sales
 * dan Galeri hanya untuk admin. Kalau halaman ini rusak, sales tidak punya
 * jalan sama sekali untuk mengunggah foto.
 *
 * Repeater memberi state ber-key (bukan indeks 0,1,2...), jadi test di sini
 * selalu memakai key asli dari state — bukan indeks posisi.
 */
class MyProfileGalleryTest extends TestCase
{
    use RefreshDatabase;

    private function makeSalesWithGaleri(int $jumlah): array
    {
        $user = User::factory()->create(['role' => 'sales']);
        $sales = Sales::factory()->create(['user_id' => $user->id]);

        for ($i = 1; $i <= $jumlah; $i++) {
            Galeri::create([
                'sales_id' => $sales->id,
                'image_path' => "galeri/sales/foto-{$i}.jpg",
                'caption' => "Foto {$i}",
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }

        return [$user, $sales];
    }

    public function test_form_memuat_galeri_milik_sales(): void
    {
        [$user] = $this->makeSalesWithGaleri(3);

        $state = Livewire::actingAs($user)->test(MyProfile::class)->get('data');

        $this->assertCount(3, $state['galeris']);
    }

    public function test_sales_dapat_menambah_foto(): void
    {
        [$user, $sales] = $this->makeSalesWithGaleri(2);

        $component = Livewire::actingAs($user)->test(MyProfile::class);
        $galeris = $component->get('data.galeris');
        $galeris[] = ['image_path' => ['galeri/sales/baru.jpg'], 'caption' => 'Baru', 'is_active' => true];

        $component->set('data.galeris', $galeris)->call('save');

        $this->assertSame(3, $sales->fresh()->galeris()->count());
        $this->assertDatabaseHas('galeri', ['image_path' => 'galeri/sales/baru.jpg', 'sales_id' => $sales->id]);
    }

    public function test_sales_dapat_menghapus_foto(): void
    {
        [$user, $sales] = $this->makeSalesWithGaleri(3);

        $component = Livewire::actingAs($user)->test(MyProfile::class);
        $galeris = $component->get('data.galeris');
        array_pop($galeris);

        $component->set('data.galeris', $galeris)->call('save');

        $this->assertSame(2, $sales->fresh()->galeris()->count());
    }

    public function test_sales_dapat_menonaktifkan_foto(): void
    {
        [$user, $sales] = $this->makeSalesWithGaleri(2);

        $component = Livewire::actingAs($user)->test(MyProfile::class);
        $galeris = $component->get('data.galeris');
        $key = array_key_first($galeris);
        $galeris[$key]['is_active'] = false;

        $component->set('data.galeris', $galeris)->call('save');

        $this->assertSame(1, $sales->fresh()->galeris()->where('is_active', true)->count());
    }

    public function test_urutan_foto_mengikuti_urutan_form(): void
    {
        [$user, $sales] = $this->makeSalesWithGaleri(3);

        $component = Livewire::actingAs($user)->test(MyProfile::class);
        $galeris = array_reverse($component->get('data.galeris'), true);

        $component->set('data.galeris', $galeris)->call('save');

        $paths = $sales->fresh()->galeris()->orderBy('sort_order')->pluck('image_path')->all();

        $this->assertSame('galeri/sales/foto-3.jpg', $paths[0]);
        $this->assertSame('galeri/sales/foto-1.jpg', $paths[2]);
    }

    public function test_sales_tidak_dapat_menyunting_galeri_sales_lain(): void
    {
        [$userA, $salesA] = $this->makeSalesWithGaleri(2);
        [, $salesB] = $this->makeSalesWithGaleri(2);
        $jumlahB = $salesB->galeris()->count();

        $component = Livewire::actingAs($userA)->test(MyProfile::class);
        $galeris = $component->get('data.galeris');
        array_pop($galeris);
        $component->set('data.galeris', $galeris)->call('save');

        // Galeri sales B tidak boleh tersentuh.
        $this->assertSame($jumlahB, $salesB->fresh()->galeris()->count());
    }

    public function test_simpan_profil_tidak_mengubah_slug(): void
    {
        [$user, $sales] = $this->makeSalesWithGaleri(1);
        $slug = $sales->slug;

        $component = Livewire::actingAs($user)->test(MyProfile::class);
        $component->set('data.name', 'Nama Baru')->call('save');

        $sales->refresh();

        $this->assertSame($slug, $sales->slug);
        $this->assertSame('Nama Baru', $sales->name);
    }
}
