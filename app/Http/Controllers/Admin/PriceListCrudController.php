<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PriceListRequest as StoreRequest;
use App\Http\Requests\PriceListRequest as UpdateRequest;

/**
 * Class PriceListCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PriceListCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\PriceList');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/price-list');
        $this->crud->setEntityNameStrings('price', 'price lists');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        $this->crud->modifyField('locale', [
            'label' => "Locale",
            'type' => 'select_from_array',
            'options' => ['ru' => 'RU', 'en' => 'EN'],
            'allows_null' => false,
            'default' => 'ru'
        ]);

        $this->crud->addField([  // Select
          'label' => "Cheat Category",
          'type' => 'select',
          'name' => 'cheat_category_id', // the db column for the foreign key
          'entity' => 'cheatCategory', // the method that defines the relationship in your Model
          'attribute' => 'name', // foreign key attribute that is shown to user
          'model' => "App\Models\CheatCategory"
        ])->beforeField('cheat_id');

        $this->crud->modifyColumn('cheat_category_id', [
          'type' => 'string',
          'name' => 'cheat_category.name',
          'label' => 'Cheat category'
        ]);

        $this->crud->addColumns([
          [
            'type' => 'number',
            'name' => 'cheat_id',
            'label' => 'ID'
          ], [
            'type' => 'string',
            'name' => 'name',
            'label' => 'Вид накрутки'
          ], [
            'type' => 'text',
            'name' => 'desc',
            'label' => 'Описание'
          ], [
            'type' => 'string',
            'name' => 'min',
            'label' => 'Мин.'
          ], [
            'type' => 'string',
            'name' => 'max',
            'label' => 'Макс.'
          ], [
            'type' => 'string',
            'name' => 'min_price',
            'label' => 'Стоимость мин.'
          ], [
            'type' => 'string',
            'name' => 'max_price',
            'label' => 'Стоимость за 1000'
          ], [
            'type' => 'string',
            'name' => 'locale',
            'label' => 'Язык'
          ]
        ]);

        // add asterisk for fields that are required in PriceListRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
