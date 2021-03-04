<?php

namespace App\Orchid\Layouts\Deliver;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class DeliverEditLayout extends Rows
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
            Input::make('deliver.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Input::make('deliver.email')
                ->type('email')
                ->title(__('Email'))
                ->placeholder(__('Email')),
            Input::make('deliver.phone')
                ->type('phone')
                ->required()
                ->mask([
                    'mask' => '999 999 999',
                    'numericInput' => true
                ])
                ->title(__('Phone'))
                ->placeholder(__('Phone')),
        ];
    }
}
