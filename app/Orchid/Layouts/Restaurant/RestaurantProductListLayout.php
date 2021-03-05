<?php

namespace App\Orchid\Layouts\Restaurant;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RestaurantProductListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'products';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Name'),
            TD::make('price', 'Price'),
            TD::make('quantity', 'Quantity'),
        ];
    }
}
