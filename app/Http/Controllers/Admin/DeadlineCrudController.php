<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DeadlineRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DeadlineCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DeadlineCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Deadline::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/deadline');
        CRUD::setEntityNameStrings('deadline', 'deadlines');

        $this->crud->setColumns([
            [
                'name' => 'title',
                'type' => 'publication',
            ],
            [
                'name' => 'deadline_at',
                'type' => 'datetime',
            ],
            [
                'name' => 'published',
                'type' => 'published_at',
            ],
            [
                'name' => 'updated_at',
                'type' => 'datetime',
            ],
        ]);

        $this->crud->addFields([
            [
                'name' => 'title',
                'type' => 'text',
                'hint' => 'Keep lowercased ("in on week {title}")',
            ],
            [
                'name' => 'url',
                'type' => 'url',
            ],
            [
                'name' => 'deadline_at',
                'type' => 'datetime_picker',
                'datetime_picker_options' => [
                    'language' => 'sk',
                    'showClear' => true,
                    'stepping' => 30,
                ],
                'wrapper'   => [
                    'class' => 'col-sm-8 col-md-6 form-group',
                ],
            ],
            [
                'name' => 'published_at',
                'type' => 'datetime_picker',
                'datetime_picker_options' => [
                    'language' => 'sk',
                    'showClear' => true,
                    'stepping' => 30,
                ],
                'wrapper'   => [
                    'class' => 'col-sm-8 col-md-6 form-group',
                ],
            ],
        ]);
    }

}
