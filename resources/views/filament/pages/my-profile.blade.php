<x-filament-panels::page>
    @if ($this->form->getModel())
        <form wire:submit="save">
            {{ $this->form }}

            <x-filament::button type="submit" class="mt-4">
                Simpan
            </x-filament::button>
        </form>
    @else
        <x-filament::section>
            <p>Belum ada data sales yang terhubung dengan akun Anda. Silakan hubungi admin.</p>
        </x-filament::section>
    @endif
</x-filament-panels::page>
