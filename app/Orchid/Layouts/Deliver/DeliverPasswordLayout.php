<?php

namespace App\Orchid\Layouts\Deliver;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Layouts\Rows;

class DeliverPasswordLayout extends Rows
{

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        /** @var User $user */
        $deliver = $this->query->get('deliver');

        //dd($deliver);
        $plaseholder = $deliver->exists
            ? __('Leave empty to keep current password')
            : __('Enter the password to be set');

        return [
            Password::make('deliver.password')
                ->placeholder($plaseholder)
                ->title(__('Password')),
        ];
    }
}
