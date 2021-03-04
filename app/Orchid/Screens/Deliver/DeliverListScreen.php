<?php

namespace App\Orchid\Screens\Deliver;

use App\Models\Deliver;
use App\Orchid\Layouts\Deliver\DeliverEditLayout;
use App\Orchid\Layouts\Deliver\DeliverListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class DeliverListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Deliver';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'All registered delivers';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'delivers' => Deliver::paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.systems.delivers.create'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            DeliverListLayout::class,
            Layout::modal('oneAsyncModal', DeliverEditLayout::class)
                ->async('asyncGetDeliver'),
        ];
    }

    /**
     * @param Deliver $deliver
     *
     * @return array
     */
    public function asyncGetUser(Deliver $deliver): array
    {
        return [
            'deliver' => $deliver,
        ];
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request)
    {
        Deliver::findOrFail($request->get('id'))
            ->delete();

        Toast::info(__('Deliver was removed'));
    }
}
