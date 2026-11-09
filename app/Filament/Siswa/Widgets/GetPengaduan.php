<?php

namespace App\Filament\Siswa\Widgets;

use App\Models\Pengaduan;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class GetPengaduan extends StatsOverviewWidget
{
    public string $search = '';

    protected string $view = 'filament.siswa.widgets.get-pengaduan';

    protected function getStats(): array
    {
        $counts = [];

        if (filled($this->search)) {
            $counts = Pengaduan::query()
                ->where(function (Builder $query): void {
                    $query
                        ->where('name', 'like', '%'.$this->search.'%')
                        ->orWhereHas('siswa', function (Builder $query): void {
                            $query->where('name', 'like', '%'.$this->search.'%');
                        });
                })
                ->selectRaw('status, COUNT(*) as aggregate')
                ->groupBy('status')
                ->pluck('aggregate', 'status')
                ->all();
        }

        return [
            Stat::make('Menunggu', $counts['menunggu'] ?? 0),
            Stat::make('Proses', $counts['proses'] ?? 0),
            Stat::make('Selesai', $counts['selesai'] ?? 0),
        ];
    }

    public function updatedSearch(): void
    {
        $this->cachedStats = null;
    }
}
