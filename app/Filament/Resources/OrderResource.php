<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('customer_id')
                            ->relationship('customer', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name ?? "Khách hàng #{$record->id}")
                            ->searchable()
                            ->required(),
                        Forms\Components\DateTimePicker::make('orderDate')
                            ->required()
                            ->default(now()),
                        Forms\Components\TextInput::make('totalAmount')
                            ->numeric()
                            ->required()
                            ->prefix('VND'),
                        Forms\Components\Select::make('payment_method_id')
                            ->relationship('paymentMethod', 'methodName')
                            ->required(),
                        Forms\Components\Select::make('status_id')
                            ->relationship('status', 'statusName')
                            ->required(),
                        Forms\Components\TextInput::make('shippingAddress')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('couponCode')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('trackingInfo')
                            ->maxLength(100),
                    ])->columns(2),

                Forms\Components\Section::make('Chi tiết đơn hàng')
                    ->schema([
                        Forms\Components\Repeater::make('details')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('phone_id')
                                    ->relationship('phone', 'name')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('price', \App\Models\Phone::find($state)?->price ?? 0)),
                                Forms\Components\TextInput::make('quantity')
                                    ->numeric()
                                    ->required()
                                    ->default(1),
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->required()
                                    ->prefix('VND'),
                            ])->columns(3)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Mã ĐH')->sortable(),
                Tables\Columns\TextColumn::make('customer.user.name')
                    ->label('Khách hàng')
                    ->searchable(),
                Tables\Columns\TextColumn::make('totalAmount')
                    ->label('Tổng tiền')
                    ->money('VND')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status.statusName')
                    ->label('Trạng thái')
                    ->sortable(),
                Tables\Columns\TextColumn::make('orderDate')
                    ->label('Ngày đặt')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->relationship('status', 'statusName')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }    
}
