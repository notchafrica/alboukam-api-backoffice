<?php

namespace App\Orchid\Screens\Parcel;

use App\Models\Parcel;
use App\Orchid\Layouts\Parcel\ParcelEditLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ParcelEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Parcel';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Details such as name, location';

    /**
     * @var Parcel
     */
    private $parcels;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Parcel $parcels): array
    {
        $this->parcels = $parcels;

        if (!$parcels->exists) {
            $this->name = 'Create Parcel';
        }

        return [
            'parcels' => $parcels
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
                ->canSee($this->parcels->exists),

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
            Layout::block(ParcelEditLayout::class)
                ->title(__('Profile Information'))
                ->description(__('Update information and email address.'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->parcels->exists)
                        ->method('save')
                ),
        ];
    }

    /**
     * @param Parcel    $parcels
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Parcel $parcels, Request $request)
    {

        $parcelsData = $request->get('parcels');
        $parcels
            ->fill($parcelsData)
            ->save();


        Toast::info(__('Parcel was saved.'));

        return redirect()->route('platform.systems.parcels');
    }
}
