<?php

namespace App\Orchid\Screens\Order;

use Orchid\Screen\Screen;

class OrderListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'OrderListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'OrderListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [];
    }
}
