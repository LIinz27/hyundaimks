<x-filament-widgets::widget>
    <div class="grid gap-6 md:grid-cols-2">
        <x-filament::section>
            <x-slot name="heading">Dokumen Terbaru Saya</x-slot>

            @if ($dokumenTerbaru->isEmpty())
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Belum ada dokumen. Tambahkan lewat menu Dokumentasi.
                </p>
            @else
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($dokumenTerbaru as $dokumen)
                        <li class="flex items-center justify-between py-2">
                            <span class="text-sm font-medium">{{ $dokumen->caption }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $dokumen->created_at?->translatedFormat('d M Y') }}
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

                <x-filament::button tag="a" :href="$dokumentasiUrl" color="gray">
                    Kelola Dokumentasi
                </x-filament::button>
            </div>
        </x-filament::section>
    </div>
</x-filament-widgets::widget>
