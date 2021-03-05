<?php

namespace App\Orchid\Screens\Parcel;

use App\Models\Parcel;
use App\Orchid\Layouts\Parcel\ParcelListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ParcelListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Parcel';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'All registered parcels';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'parcels' => Parcel::paginate()
        ];
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
        return [
            ParcelListLayout::class
        ];
    }

    /**
     * @param Parcel $restaurant
     *
     * @return array
     */
    public function asyncGetUser(Parcel $restaurant): array
    {
        return [
            'restaurant' => $restaurant,
        ];
    }
    /**
     * @param Request $request
     */
    public function remove(Request $request)
    {
        Parcel::findOrFail($request->get('id'))
            ->delete();

        Toast::info(__('Parcel was removed'));
    }
}
