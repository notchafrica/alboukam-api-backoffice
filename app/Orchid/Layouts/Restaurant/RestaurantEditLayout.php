<?php

namespace App\Orchid\Layouts\Restaurant;

use App\Models\City;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class RestaurantEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Input::make('restaurant.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),
            TextArea::make('restaurant.bio')
                ->title(__('Bio'))
                ->placeholder(__('Bio')),
            Select::make('restaurant.city_id')
                ->fromModel(City::class, 'name', 'id')
                ->required()
                ->title(__('City'))
                ->placeholder(__('City')),
            Input::make('restaurant.email')
                ->type('email')
                ->title(__('Email'))
                ->placeholder(__('Email')),
            Input::make('restaurant.phone')
                ->type('phone')
                ->required()
                ->mask([
                    'mask' => '999 999 999',
                    'numericInput' => true
                ])
                ->title(__('Phone'))
                ->placeholder(__('Phone')),
            Input::make('restaurant.address')
                ->type('text')
                ->title(__('Address'))
                ->placeholder(__('Address')),
        ];
    }
}
