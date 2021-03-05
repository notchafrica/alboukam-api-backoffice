<?php

namespace App\Orchid\Screens\Restaurant;

use App\Models\Restaurant;
use App\Orchid\Layouts\Restaurant\RestaurantMetric;
use App\Orchid\Layouts\Restaurant\RestaurantProductListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class RestaurantManageScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Restaurant Manage';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = '';

    /**
     * @var Restaurant
     */
    private $restaurant;


    /**
     * Query data.
     *
     * @return array
     */
    public function query(Restaurant $restaurant): array
    {
        $this->restaurant = $restaurant;

        return [
            'restaurant' => $restaurant,
            'products' => $restaurant->products,
            'metric' => [
                ['keyValue' => $restaurant->products()->count(),],
                ['keyValue' => 15151,],
            ]
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
            ModalToggle::make('Add product')->icon('plus')
                ->modal('createModal')->method('saveProduct'),
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
            RestaurantMetric::class,
            RestaurantProductListLayout::class,
            Layout::modal('createModal', [
                Layout::rows([
                    Picture::make('avatar')->required()->storage(config('filesystems.default'))->title('avatar'),
                    Input::make('name')->required()->title('Name')->placeholder('Name')->type('text'),
                    Input::make('price')->required()->title('Price (XAF)')->placeholder('Price')->type('number'),
                    Input::make('quantity')->required()->title('Quantity')->placeholder('Quantity')->type('number'),
                    TextArea::make('details')->required()->title('Details')->placeholder('Details')
                ]),
            ])->title('Create new product')->applyButton('Create')
                ->closeButton('Close'),
        ];
    }

    /**
     * @return array
     */
    public function asyncGetRestaurant(Restaurant $restaurant): array
    {
        return [
            'restaurant' => $restaurant,
        ];
    }

    public function saveProduct(Restaurant $restaurant, Request $request)
    {

        $restaurant->products()->create([
            'avatar' => $request->get('avatar'),
            'name' => $request->get('name'),
            'details' => $request->get('details'),
            'price' => $request->get('price'),
            'quantity' => $request->get('quantity'),
        ]);

        Toast::info(__('Product was saved'));
    }
}
