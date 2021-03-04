<?php

namespace App\Orchid\Layouts\Restaurant;

use App\Models\Restaurant;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RestaurantListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'restaurants';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Name'),
            TD::make('city', 'City')->render(function (Restaurant  $restaurant) {
                return $restaurant->city->name;
            }),
            TD::make('phone', 'Phone'),
            TD::make('address', 'Address'),
            TD::make('created_at', 'Created'),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Restaurant $deliver) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Manage'))
                                ->route('platform.systems.restaurants.manage', $deliver->id)
                                ->icon('bi.kanban-fill'),
                            Link::make(__('Edit'))
                                ->route('platform.systems.restaurants.edit', $deliver->id)
                                ->icon('pencil'),
                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the item is deleted, all of its resources and data will be permanently deleted. Before deleting account, please download any data or information that you wish to retain.'))
                                ->parameters([
                                    'id' => $deliver->id,
                                ]),
                        ]);
                }),
        ];
    }
}
