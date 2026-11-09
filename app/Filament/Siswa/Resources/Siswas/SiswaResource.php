<?php

namespace App\Filament\Siswa\Resources\Siswas;

use App\Filament\Siswa\Resources\Siswas\Pages\ListSiswas;
use App\Models\Siswa;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('kelas')
                    ->searchable(),
                TextColumn::make('nis')
                    ->searchable(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSiswas::route('/'),
        ];
    }
}
