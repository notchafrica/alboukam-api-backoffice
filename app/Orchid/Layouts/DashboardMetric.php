<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Metric;

class DashboardMetric extends Metric
{
    /**
     * @var string
     */
    protected $title = 'Platform Metric';

    /**
     * Get the labels available for the metric.
     *
     * @return array
     */
    protected $labels = [
        'Total Users',
        'Total Delivers',
        'Total Restaurants / Shops',
        'Total Parcels',
        'Total Orders',
    ];

    /**
     * The name of the key to fetch it from the query.
     *
     * @var string
     */
    protected $target = 'metric';
}
