<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class WorkCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WorkCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Work::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/work');
        CRUD::setEntityNameStrings('work', 'works');

        $this->crud->setColumns([
            [
                'name' => 'name',
            ],
            [
                'name' => 'studio',
            ],
            [
                'name' => 'location_city',
            ],
            [
                'name' => 'date_design_start',
                'type' => 'text',
            ],
            [
                'name' => 'reg_number',
            ],
        ]);

        $this->crud->denyAccess('delete');
        $this->crud->denyAccess('update');
        $this->crud->denyAccess('create');
    }

}
