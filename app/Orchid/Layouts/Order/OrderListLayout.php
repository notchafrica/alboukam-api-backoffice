<?php

namespace App\Orchid\Layouts\Order;

use App\Models\Order;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class OrderListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'orders';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('uid', 'ID'),
            TD::make('products', 'Products')->render(function (Order $order) {
                return $order->products()->count();
            }),
            TD::make('status', 'Status'),
            TD::make('created_at', 'Date'),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Order $deliver) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Manage'))
                                ->route('platform.systems.orders.manage', $deliver->id)
                                ->icon('bi.kanban-fill'),
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
