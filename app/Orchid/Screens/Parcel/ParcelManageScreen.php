<?php

namespace App\Orchid\Screens\Parcel;

use App\Models\Parcel;
use App\Orchid\Layouts\Parcel\ParcelMetric;
use App\Orchid\Layouts\Parcel\ParcelProductListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ParcelManageScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Parcel Manage';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = '';

    /**
     * @var Parcel
     */
    private $parcel;


    /**
     * Query data.
     *
     * @return array
     */
    public function query(Parcel $parcel): array
    {
        $this->parcel = $parcel;

        return [
            'parcel' => $parcel,
            'products' => $parcel->products,
            'metric' => [
                ['keyValue' => $parcel->products()->count(),],
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
            ParcelProductListLayout::class,
        ];
    }

    /**
     * @return array
     */
    public function asyncGetParcel(Parcel $parcel): array
    {
        return [
            'parcel' => $parcel,
        ];
    }
}
