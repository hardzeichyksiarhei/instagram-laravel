<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\BillingRequest as StoreRequest;
use App\Http\Requests\BillingRequest as UpdateRequest;

/**
 * Class BillingCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BillingCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Billing');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/billing');
        $this->crud->setEntityNameStrings('billing', 'billings');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();

        $this->crud->removeButton('create');

        $this->crud->addColumns([
          [
            'type' => 'text',
            'name' => 'user.email',
            'label' => 'User Email'
          ], [
            'type' => 'string',
            'name' => 'amount',
            'label' => 'Amount'
          ], [
            'type' => 'text',
            'name' => 'payment_system',
            'label' => 'Payment System'
          ], [
            'type' => 'text',
            'name' => 'score',
            'label' => 'Score'
          ], [
            'type' => 'model_function',
            'name' => 'status',
            'label' => 'Status',
            'function_name' => 'getStatusLable'
          ], [
            'type' => 'text',
            'name' => 'created_at',
            'label' => 'Date'
          ]
        ]);

        $this->crud->removeAllFields();
        $this->crud->addField([
          'name' => 'status',
          'label' => "Status",
          'type' => 'select_from_array',
          'options' => [ 'process' => 'Ожидание', 'done' => 'Выполнено', 'cancel' => 'Отменена'],
          'allows_null' => false,
          'default' => 'process'
        ], 'update');

        // add asterisk for fields that are required in BillingRequest
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

        if ($this->crud->entry->status == 'cancel' && $this->crud->entry->is_cancel != 1) {

          $this->crud->entry->is_cancel = 1;

          $this->crud->entry->save();

          $user = $this->crud->entry->user;
          $user->addCredits($this->crud->entry->amount);
          $user->save();
        }

        if (($this->crud->entry->status == 'process' || $this->crud->entry->status == 'done') && $this->crud->entry->is_cancel == 1) {

          $this->crud->entry->is_cancel = 0;

          $this->crud->entry->save();

          $user = $this->crud->entry->user;

          if ($user->balans >= $this->crud->entry->amount) {
            $user->minusCredits($this->crud->entry->amount);
            $user->save();
          }
        }

        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
