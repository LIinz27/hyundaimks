<x-filament-widgets::widget>
    <div class="grid gap-6 md:grid-cols-2">
        <x-filament::section>
            <x-slot name="heading">Foto Galeri Saya</x-slot>

            @if ($fotoTerbaru->isEmpty())
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Belum ada foto galeri. Tambahkan lewat tab Galeri di halaman Sales.
                </p>
            @else
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($fotoTerbaru as $foto)
                        <li class="flex items-center justify-between py-2">
                            <span class="text-sm font-medium">
                                {{ $foto->caption ?: 'Tanpa keterangan' }}
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $foto->is_active ? 'Tampil' : 'Disembunyikan' }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">Pintasan</x-slot>

            <div class="flex flex-col gap-3">
                <x-filament::button tag="a" :href="$profilUrl" color="primary">
                    Profil Saya
                </x-filament::button>
            </div>
        </x-filament::section>
    </div>
</x-filament-widgets::widget>
