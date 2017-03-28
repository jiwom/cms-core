<?php

namespace Yajra\CMS\DataTables;

use Yajra\CMS\Entities\Article;
use Yajra\Datatables\Services\DataTable;

class TagsDataTable extends DataTable
{
    /**
     * Build DataTable api response.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'administrator.tags.datatables.action');
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $articles = Tag::select('articles.*', 'categories.title as category_title')
                           ->join('categories', 'categories.id', '=', 'articles.category_id');

        return $this->applyScopes($articles);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '134px', 'className' => 'text-center'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'id'               => ['name' => 'articles.id', 'width' => '20px'],
            'title'            => ['name' => 'articles.title'],
            'alias'            => ['name' => 'articles.alias', 'visible' => false],
            'categories.title' => ['title' => 'Category', 'visible' => false, 'data' => 'category_title'],
            'published'        => [
                'name'  => 'articles.published',
                'width' => '20px',
                'title' => '<i class="fa fa-check-circle" data-toggle="tooltip" data-title="Published"></i>',
            ],
            'authenticated'    => [
                'name'  => 'articles.authenticated',
                'width' => '20px',
                'title' => '<i class="fa fa-key" data-toggle="tooltip" data-title="Authentication Required"></i>',
            ],
            'order'            => [
                'name'  => 'articles.order',
                'width' => '20px',
                'title' => '<i class="fa fa-list" data-toggle="tooltip" data-title="Sort/Order"></i>',
            ],
            'hits'             => [
                'name'  => 'articles.hits',
                'width' => '20px',
                'title' => '<i class="fa fa-eye" data-toggle="tooltip" data-title="Hits"></i>',
            ],
            'created_at'       => ['name' => 'articles.created_at', 'width' => '100px'],
            'updated_at'       => ['name' => 'articles.updated_at', 'width' => '100px'],
        ];
    }

    /**
     * @return array
     */
    protected function getBuilderParameters()
    {
        return [
            'stateSave' => true,
            'buttons'   => [
                [
                    'extend' => 'create',
                    'text'   => '<i class="fa fa-plus"></i>&nbsp;&nbsp;New Article',
                ],
                'export',
                'print',
                'reset',
                'reload',
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'articles';
    }
}
