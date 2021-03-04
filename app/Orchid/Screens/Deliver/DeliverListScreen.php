<?php

namespace App\Orchid\Screens\Deliver;

use Orchid\Screen\Screen;

class DeliverListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'DeliverListScreen';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'DeliverListScreen';

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
