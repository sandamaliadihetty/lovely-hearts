<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Requests\Shop\PaymentItemRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PaymentItemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PaymentItemCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Shop\PaymentItem::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/shop/payment-item');
        CRUD::setEntityNameStrings('payment item', 'payment items');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        $this->crud->addColumn([
            'label' => 'User', // Table column heading
            'type'      => 'select',
            'name'      => 'user_id', // the column that contains the ID of that connected entity;
            'entity'    => 'user', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "app\Models\User", // foreign key model
            'wrapper'   => [
                'href' => function ($crud, $column, $entry, $related_key) {
                    return backpack_url('user/'.$related_key.'/show');
                },
            ],
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('user', function ($q) use ($column, $searchTerm) {
                    $q->where('name','like','%'.$searchTerm);
                });
            }
        ]);

        $this->crud->addColumn([
            'label' => 'Payment', // Table column heading
            'type'      => 'select',
            'name'      => 'payment_id', // the column that contains the ID of that connected entity;
            'entity'    => 'payment', // the method that defines the relationship in your Model
            'attribute' => 'payment_no', // foreign key attribute that is shown to user
            'model'     => "app\Models\Shop\Payment", // foreign key model
            'wrapper'   => [
                'href' => function ($crud, $column, $entry, $related_key) {
                    return backpack_url('shop/payment/'.$related_key.'/show');
                },
            ],
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('payment', function ($q) use ($column, $searchTerm) {
                    $q->where('payment_no','like','%'.$searchTerm);
                });
            }
        ]);

        $this->crud->addColumn([
            'label' => 'Product', // Table column heading
            'type'      => 'select',
            'name'      => 'product_id', // the column that contains the ID of that connected entity;
            'entity'    => 'product', // the method that defines the relationship in your Model
            'attribute' => 'title', // foreign key attribute that is shown to user
            'model'     => "app\Models\Shop\Product", // foreign key model
            'wrapper'   => [
                'href' => function ($crud, $column, $entry, $related_key) {
                    return backpack_url('shop/product/'.$related_key.'/show');
                },
            ],
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhereHas('product', function ($q) use ($column, $searchTerm) {
                    $q->where('title','like','%'.$searchTerm);
                });
            }
        ]);



        CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PaymentItemRequest::class);

        CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
