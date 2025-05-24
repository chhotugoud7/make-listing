<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('category_id')
                //     ->required()
                //     ->numeric(),
                // Forms\Components\TextInput::make('subcategory_id')
                //     ->numeric()
                //     ->default(null),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('subcategory_id')
                    ->label('Subcategory')
                    ->relationship('subcategory', 'name')
                    ->searchable()
                    ->preload()
                    ->default(null),

                Forms\Components\TextInput::make('location')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->default(null)
                    ->prefix('$'),
                Forms\Components\TextInput::make('contact_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tags')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Toggle::make('is_featured')
                    ->required(),
                // Forms\Components\TextInput::make('admin_status')
                //     ->required(),
                // Forms\Components\TextInput::make('status')
                //     ->required(),

                Forms\Components\Select::make('admin_status')
                        ->label('Admin Status')
                        ->options([
                            'pending' => 'Pending',
                            'approved' => 'Approved',
                            'rejected' => 'Rejected',
                        ])
                        ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'expired' => 'Expired',
                    ])
                    ->required(),

                
                Forms\Components\TextInput::make('latitude')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('longitude')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('category_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('subcategory_id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('subcategory.name')
                    ->label('Subcategory')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tags')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                // Tables\Columns\TextColumn::make('admin_status'),
                // Tables\Columns\TextColumn::make('status'),
                Tables\Columns\BadgeColumn::make('admin_status')
                ->label('Admin Status')
                ->formatStateUsing(fn (string $state) => match ($state) {
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                    default => ucfirst($state),
                })
                ->colors([
                    'pending' => 'warning',
                    'approved' => 'success',
                    'rejected' => 'danger',
                ]),


                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'expired' => 'Expired',
                        default => ucfirst($state),
                    })
                    ->colors([
                        'active' => 'success',
                        'inactive' => 'secondary',
                        'expired' => 'danger',
                    ]),

                
                Tables\Columns\TextColumn::make('latitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
