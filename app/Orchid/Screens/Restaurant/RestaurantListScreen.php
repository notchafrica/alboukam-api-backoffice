<?php

namespace App\Orchid\Screens\Restaurant;

use App\Models\Restaurant;
use App\Orchid\Layouts\Restaurant\RestaurantEditLayout;
use App\Orchid\Layouts\Restaurant\RestaurantListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class RestaurantListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Restaurant / Shop';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'All registered restaurants / shops';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'restaurants' => Restaurant::paginate()
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
                ->route('platform.systems.restaurants.create'),
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
            RestaurantListLayout::class,
            Layout::modal('oneAsyncModal', RestaurantEditLayout::class)
                ->async('asyncGetRestaurant'),
        ];
    }

    /**
     * @param Restaurant $restaurant
     *
     * @return array
     */
    public function asyncGetUser(Restaurant $restaurant): array
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
        Restaurant::findOrFail($request->get('id'))
            ->delete();

        Toast::info(__('Restaurant was removed'));
    }
}
