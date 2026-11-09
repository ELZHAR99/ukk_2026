<x-filament-widgets::widget class="fi-wi-stats-overview">
    <div class="mb-4">
        <x-filament::input.wrapper inline-prefix>
            <x-filament::input
                type="search"
                maxlength="1000"
                placeholder="Cari nama siswa atau pengaduan..."
                wire:model.live.debounce.500ms="search"
                aria-label="Cari nama siswa atau pengaduan"
            />
        </x-filament::input.wrapper>
    </div>

    {{ $this->content }}
</x-filament-widgets::widget>
