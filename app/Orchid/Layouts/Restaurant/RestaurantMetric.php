<?php

namespace App\Orchid\Layouts\Restaurant;

use Orchid\Screen\Layouts\Metric;

class RestaurantMetric extends Metric
{
    /**
     * @var string
     */
    protected $title = 'Restaurant Insight';

    /**
     * Get the labels available for the metric.
     *
     * @return array
     */
    protected $labels = [
        'Total products',
        "Total orders"
    ];

    /**
     * The name of the key to fetch it from the query.
     *
     * @var string
     */
    protected $target = 'metric';
}
