<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Models\Deliver;
use App\Models\Order;
use App\Models\Parcel;
use App\Models\Restaurant;
use App\Models\User;
use App\Orchid\Layouts\DashboardChart;
use App\Orchid\Layouts\DashboardMetric;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Get Started';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Welcome to your dashboard.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'metric' => [
                ['keyValue' => User::whereId(!auth()->id())->count(),],
                ['keyValue' => Deliver::get()->count(),],
                ['keyValue' => Restaurant::get()->count(),],
                ['keyValue' => Parcel::get()->count(),],
                ['keyValue' => Order::get()->count(),],
            ],
            'charts' => [
                Order::countByDays()->toChart('Orders'),
                Parcel::countByDays()->toChart('Parcels'),
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
            Link::make('Website')
                ->href('http://facebook.com/notchpay')
                ->icon('globe-alt'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::view('platform::partials.welcome'),
            DashboardMetric::class,
            DashboardChart::class
        ];
    }
}
