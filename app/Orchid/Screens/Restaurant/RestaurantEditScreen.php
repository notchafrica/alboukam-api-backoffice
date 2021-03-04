<?php

namespace App\Orchid\Screens\Restaurant;

use App\Models\Restaurant;
use App\Orchid\Layouts\Restaurant\RestaurantEditLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class RestaurantEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Restaurant';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Details such as name, location';

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

        if (!$restaurant->exists) {
            $this->name = 'Create Restaurant';
        }

        return [
            'restaurant' => $restaurant
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
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the item is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->restaurant->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
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
            Layout::block(RestaurantEditLayout::class)
                ->title(__('Profile Information'))
                ->description(__('Update information and email address.'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->restaurant->exists)
                        ->method('save')
                ),
        ];
    }

    /**
     * @param Restaurant    $restaurant
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Restaurant $restaurant, Request $request)
    {

        $restaurantData = $request->get('restaurant');
        $restaurant
            ->fill($restaurantData)
            ->save();


        Toast::info(__('Restaurant was saved.'));

        return redirect()->route('platform.systems.restaurants');
    }
}
