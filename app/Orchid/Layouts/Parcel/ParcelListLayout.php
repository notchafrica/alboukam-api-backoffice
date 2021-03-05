<?php

namespace App\Orchid\Layouts\Parcel;

use App\Models\Parcel;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ParcelListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'parcels';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('uid', 'ID'),
            TD::make('title', 'Title'),
            TD::make('type', 'Type'),
            TD::make('from', 'From'),
            TD::make('to', 'To'),
            TD::make('details', 'Details'),
            TD::make('status', 'Status'),
            TD::make('weight', 'Weight'),
            TD::make('length', 'Length'),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Parcel $deliver) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            /*
                            Link::make(__('Manage'))
                                ->route('platform.systems.parcels.manage', $deliver->id)
                                ->icon('bi.kanban-fill'), */
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
