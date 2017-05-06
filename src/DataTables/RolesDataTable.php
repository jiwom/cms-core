<?php

namespace Yajra\CMS\DataTables;

use Yajra\Acl\Models\Role;
use Yajra\Datatables\Services\DataTable;

class RolesDataTable extends DataTable
{
    /**
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this
            ->builder()
            ->columns([
                'id',
                'name',
                'slug',
                'system'      => ['class' => 'text-center', 'width' => '30px', 'title' => 'Sys'],
                'users'       => ['orderable' => false, 'searchable' => false, 'class' => 'text-center'],
                'permissions' => ['orderable' => false, 'searchable' => false, 'class' => 'text-center'],
                'created_at',
                'updated_at',
            ])
            ->addAction(['width' => '60px'])
            ->parameters([
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    [
                        'extend' => 'create',
                        'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;' . trans('cms::role.datatable.buttons.create'),
                    ],
                    'export',
                    'print',
                    'reset',
                    'reload',
                ],
            ]);
    }

    /**
     * Build DataTable api response.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    protected function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('system', function (Role $role) {
                return dt_check($role->system);
            })
            ->addColumn('users', function (Role $role) {
                return view('administrator.roles.datatables.users', compact('role'))->render();
            })
            ->addColumn('permissions', function (Role $role) {
                return view('administrator.roles.datatables.permissions', compact('role'))->render();
            })
            ->addColumn('action', 'administrator.roles.datatables.action')
            ->rawColumns(['system', 'users', 'permissions', 'action']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->applyScopes(Role::query());
    }
}
