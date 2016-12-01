<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation

use Backpack\PermissionManager\app\Http\Requests\UserStoreCrudRequest as StoreRequest;
use Backpack\PermissionManager\app\Http\Requests\UserUpdateCrudRequest as UpdateRequest;

class UserCrudController extends \Backpack\PermissionManager\app\Http\Controllers\UserCrudController
{

	public function setUp() {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("App\User");
        $this->crud->setRoute("admin/user");
        $this->crud->setEntityNameStrings('user', 'users');

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/

        //删除默认的行
        $this->crud->removeColumn('name');
        $this->crud->removeColumn('email');
        $this->crud->removeColumn('roles');
        $this->crud->removeColumn('permissions');

        $this->crud->addColumn
        (
            [
                'name' => 'id', // The db column name
                'label' => "ID" // Table column heading
            ]
        );
        $this->crud->addColumn
        (
            [
                'name' => 'name', // The db column name
                'label' => "User Name" // Table column heading
            ]
        );
        $this->crud->addColumn
        (
            [
                'name' => 'email', // The db column name
                'label' => "E-mail" // Table column heading
            ]
        );
        $this->crud->addColumn
        (
            [
                // 1-n relationship
                'label' => "Team Name", // Table column heading
                'type' => "select",
                'name' => 'tm_team_id', // the column that contains the ID of that connected entity;
                'entity' => 'team', // the method that defines the relationship in your Model
                'attribute' => "team_name", // foreign key attribute that is shown to user
                'model' => "App\Team", // foreign key model
            ]
        );
        $this->crud->addColumn([ // n-n relationship (with pivot table)
            'label'     => trans('backpack::permissionmanager.roles'), // Table column heading
            'type'      => 'select_multiple',
            'name'      => 'roles', // the method that defines the relationship in your Model
            'entity'    => 'roles', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "Backpack\PermissionManager\app\Models\Roles", // foreign key model
        ]);

        $this->crud->addColumn([ // n-n relationship (with pivot table)
            'label'     => trans('backpack::permissionmanager.extra_permissions'), // Table column heading
            'type'      => 'select_multiple',
            'name'      => 'permissions', // the method that defines the relationship in your Model
            'entity'    => 'permissions', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "Backpack\PermissionManager\app\Models\Permission", // foreign key model
        ]);


        $options = array
        (
            [
                'name' => 'name',
                'label' => "User Name" ,
                'type' => 'text'
            ],
            [
                'name' => 'email',
                'label' => "E-mail" ,
                'type' => 'email'
            ],
            [
                // 1-n relationship
                'label' => "Team Name", // Table column heading
                'type' => "select2",
                'name' => 'tm_team_id', // the column that contains the ID of that connected entity;
                'entity' => 'team', // the method that defines the relationship in your Model
                'attribute' => "team_name", // foreign key attribute that is shown to user
                'model' => "App\Team", // foreign key model
            ],
            [
                'name'  => 'password',
                'label' => trans('backpack::permissionmanager.password'),
                'type'  => 'password',
            ],
            [
                'name'  => 'password_confirmation',
                'label' => trans('backpack::permissionmanager.password_confirmation'),
                'type'  => 'password',
            ],
            [
                // two interconnected entities
                'label'             => trans('backpack::permissionmanager.user_role_permission'),
                'field_unique_name' => 'user_role_permission',
                'type'              => 'checklist_dependency',
                'name'              => 'roles_and_permissions', // the methods that defines the relationship in your Model
                'subfields'         => [
                    'primary' => [
                        'label'            => trans('backpack::permissionmanager.roles'),
                        'name'             => 'roles', // the method that defines the relationship in your Model
                        'entity'           => 'roles', // the method that defines the relationship in your Model
                        'entity_secondary' => 'permissions', // the method that defines the relationship in your Model
                        'attribute'        => 'name', // foreign key attribute that is shown to user
                        'model'            => "Backpack\PermissionManager\app\Models\Role", // foreign key model
                        'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
                        'number_columns'   => 3, //can be 1,2,3,4,6
                    ],
                    'secondary' => [
                        'label'          => ucfirst(trans('backpack::permissionmanager.permission_singular')),
                        'name'           => 'permissions', // the method that defines the relationship in your Model
                        'entity'         => 'permissions', // the method that defines the relationship in your Model
                        'entity_primary' => 'roles', // the method that defines the relationship in your Model
                        'attribute'      => 'name', // foreign key attribute that is shown to user
                        'model'          => "Backpack\PermissionManager\app\Models\Permission", // foreign key model
                        'pivot'          => true, // on create&update, do you need to add/delete pivot table entries?]
                        'number_columns' => 3, //can be 1,2,3,4,6
                    ],
                ],
            ],
        );
        $this->crud->addFields($options, 'update/create/both');

		//$this->crud->setFromDb();

		// ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);
        
        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();
        
        
        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

	public function store(StoreRequest $request)
	{
		return parent::storeCrud();
	}

	public function update(UpdateRequest $request)
	{
		return parent::updateCrud();
	}
}
