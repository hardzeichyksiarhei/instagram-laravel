<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    CRUD::resource('user', 'UserCrudController');
    CRUD::resource('price-list', 'PriceListCrudController');
    CRUD::resource('cheat-category', 'CheatCategoryCrudController');
    CRUD::resource('billing', 'BillingCrudController');
    CRUD::resource('setting', 'SettingCrudController');
    CRUD::resource('service', 'ServiceCrudController');
    CRUD::resource('order', 'OrderCrudController');
}); // this should be the absolute last line of this file