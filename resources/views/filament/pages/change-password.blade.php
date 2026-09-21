<x-filament-panels::page>
    <x-filament::section>
        <p class="mb-4 text-sm text-gray-600 dark:text-gray-300">
            Untuk keamanan, Anda wajib mengganti password default sebelum melanjutkan.
        </p>
        <form wire:submit="save">
            {{ $this->form }}

            <x-filament::button type="submit" class="mt-4">
                Simpan Password Baru
            </x-filament::button>
        </form>
    </x-filament::section>
</x-filament-panels::page>
