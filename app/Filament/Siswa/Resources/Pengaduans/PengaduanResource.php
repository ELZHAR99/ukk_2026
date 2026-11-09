<?php

namespace App\Filament\Siswa\Resources\Pengaduans;

use App\Filament\Siswa\Resources\Pengaduans\Pages\CreatePengaduan;
use App\Filament\Siswa\Resources\Pengaduans\Pages\ListPengaduans;
use App\Models\Pengaduan;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PengaduanResource extends Resource
{
    protected static ?string $model = Pengaduan::class;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('tempat')
                    ->required(),
                DateTimePicker::make('kapan')
                    ->label('Kapan')
                    ->required(),
                TextInput::make('deskripsi')
                    ->required(),
                Select::make('siswa_id')
                    ->label('Siswa')
                    ->relationship('siswa', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('tempat')
                    ->searchable(),
                TextColumn::make('kapan')
                    ->label('Kapan')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('deskripsi')
                    ->searchable(),
                TextColumn::make('siswa.name')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'proses' => 'Proses',
                        'selesai' => 'Selesai',
                    ])
                    ->searchable(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPengaduans::route('/'),
            'create' => CreatePengaduan::route('/create'),
        ];
    }
}
