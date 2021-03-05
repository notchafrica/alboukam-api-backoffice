<?php

declare(strict_types=1);

use App\Orchid\Screens\Deliver\DeliverEditScreen;
use App\Orchid\Screens\Deliver\DeliverListScreen;
use App\Orchid\Screens\Order\OrderListScreen;
use App\Orchid\Screens\Parcel\ParcelListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Restaurant\RestaurantEditScreen;
use App\Orchid\Screens\Restaurant\RestaurantListScreen;
use App\Orchid\Screens\Restaurant\RestaurantManageScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/dashboard', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{users}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Edit'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Delivers > Deliver
Route::screen('delivers', DeliverListScreen::class)
    ->name('platform.systems.delivers')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.index')
            ->push(__('Delivers'), route('platform.systems.delivers'));
    });

// Platform > System > Delivers
Route::screen('delivers/{delivers}/edit', DeliverEditScreen::class)
    ->name('platform.systems.delivers.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.delivers')
            ->push(__('Edit'), route('platform.systems.delivers.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('delivers/create', DeliverEditScreen::class)
    ->name('platform.systems.delivers.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.delivers')
            ->push(__('Create'), route('platform.systems.delivers.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });


// Platform > System > Delivers > Deliver
Route::screen('restaurants', RestaurantListScreen::class)
    ->name('platform.systems.restaurants')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.index')
            ->push(__('Restaurants'), route('platform.systems.restaurants'));
    });

// Platform > System > Delivers
Route::screen('restaurants/{restaurants}/edit', RestaurantEditScreen::class)
    ->name('platform.systems.restaurants.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.restaurants')
            ->push(__('Edit'), route('platform.systems.restaurants.edit', $user));
    });

// Platform > System > Delivers
Route::screen('restaurants/{restaurants}/manage', RestaurantManageScreen::class)
    ->name('platform.systems.restaurants.manage')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.restaurants')
            ->push(__('Manage'), route('platform.systems.restaurants.manage', $user));
    });

// Platform > System > Users > Create
Route::screen('restaurants/create', RestaurantEditScreen::class)
    ->name('platform.systems.restaurants.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.restaurants')
            ->push(__('Create'), route('platform.systems.restaurants.create'));
    });

// Platform > System > Delivers > Deliver
Route::screen('parcels', ParcelListScreen::class)
    ->name('platform.systems.parcels')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.index')
            ->push(__('Parcels'), route('platform.systems.parcels'));
    });

// Platform > System > Delivers
Route::screen('parcels/{parcels}/manage', RestaurantManageScreen::class)
    ->name('platform.systems.parcels.manage')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.parcels')
            ->push(__('Manage'), route('platform.systems.parcels.manage', $user));
    });


// Platform > System > Delivers > Deliver
Route::screen('orders', OrderListScreen::class)
    ->name('platform.systems.orders')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.index')
            ->push(__('Parcels'), route('platform.systems.orders'));
    });

Route::screen('orders/{orders}/manage', RestaurantManageScreen::class)
    ->name('platform.systems.orders.manage')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.orders')
            ->push(__('Manage'), route('platform.systems.orders.manage', $user));
    });
