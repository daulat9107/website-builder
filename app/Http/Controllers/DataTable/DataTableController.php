<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Arr;

abstract class DataTableController extends Controller
{
    /**
     * If an entity is allowed to be created.
     *
     * @var boolean
     */
    protected $allowCreation = true;

    /**
     * If an entity is allowed to be Updated.
     *
     * @var boolean
     */
    protected $allowUpdation = true;

    /**
     * Allow deletion.
     *
     * @var boolean
     */
    protected $allowDeletion = true;

    /**
     * Allow search.
     *
     * @var boolean
     */
    protected $allowSearch = true;

    /**
     * Allow drag.
     *
     * @var boolean
     */
    protected $allowDraging = true;

    /**
     * The entity builder.
     *
     * @var Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * Get the columns that are allowed to be displayed.
     *
     * @return array
     */
    public function getDisplayableColumns()
    {
        return array_diff(
            $this->getDatabaseColumnNames(), $this->builder->getModel()->getHidden()
        );
    }

    /**
     * Get the columns that are allowed to be created.
     *
     * @return array
     */

    public function getCreateableColumns()
    {
        return array_intersect($this->getDatabaseColumnNames(), $this->getDisplayableColumns());
    }

    /**
     * Get the columns that are allowed to be updated.
     *
     * @return array
     */
    public function getUpdatableColumns()
    {
        return array_intersect($this->getDatabaseColumnNames(), $this->getDisplayableColumns());
    }

    public function getCustomColumnsNames()
    {
        return [];
    }
    public function hideDisplaybleColumn()
    {
        return [];
    }
    public function fieldType()
    {
        return [];
    }

    public function orderBy($request)
    {
        return [$request->sort_key,$request->sort_value];
    }
    /**
     * Create the controller, check builder method and assign
     * to the builder property.
     *
     * @return void
     */
    public function __construct()
    {
        if (!method_exists($this, 'builder')) {
            throw new Exception('No entity builder method defined.');
        }

        if (!($this->builder = $this->builder()) instanceof Builder) {
            throw new Exception("Entity builder not instance of Builder.");
        }
    }

    /**
     * Get records to be used for output.
     *
     * @param  Request $request
     * @return Illuminate\Support\Collection
     */
    public function getRecords(Request $request)
    {
        $builder = $this->builder;
        if ($this->hasSearchQuery($request)) {
            $builder = $this->buildSearch($builder, $request);
        }
        $builder->where('group_id',$request->group_id);
        try {
            return $builder->limit($request->limit)->orderBy(...$this->orderBy($request))->get($this->getDisplayableColumns());
        } catch (QueryException $e) {
            return [];
        }
    }

    /**
     * Show a list of entities.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json([
            'data' => [
                'table' => ucfirst($this->builder->getModel()->getTable()),
                'records' => $this->getRecords($request),
                'updatable' => $this->getUpdatableColumns(),
                'formData' => collect(array_values($this->formData($request)))->chunk(3),
                'displayable' => array_values($this->getDisplayableColumns()),
                'hideColumns' => array_values($this->hideDisplaybleColumn()),
                'column_map' => $this->getCustomColumnsNames(),
                'field_type' => $this->fieldType(),
                'allow' => [
                    'creation'  => $this->allowCreation,
                    'updation'  => $this->allowUpdation,
                    'deletion'  => $this->allowDeletion,
                    'search'    => $this->allowSearch,
                    'drag'      => $this->allowDraging
                ]
            ]
        ]);
    }

    /**
     * Create an entity.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->allowCreation) {
            return;
        }

        $this->builder->create(
            array_merge(
                ['user_id'=>$request->user()->id,'group_id' => $request->group_id], 
                $request->only($this->getUpdatableColumns())
            )
        );
    }

    /**
     * Update an entity.
     *
     * @param  integer  $id
     * @param  Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $this->builder->find($id)->update(
            array_merge(
                ['user_id'=>$request->user()->id,'group_id' => $request->group_id], 
                $request->only($this->getUpdatableColumns())
            )
        );
    }

    /**
     * Delete an entity.
     *
     * @param  integer  $id
     * @param  Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($ids, Request $request)
    {
        if (!$this->allowDeletion) {
            return;
        }

        $this->builder->whereIn('id', explode(',', $ids))->delete();
    }

    /**
     * Get the database column names for the entity.
     *
     * @return array
     */
    protected function getDatabaseColumnNames()
    {
        return Schema::getColumnListing($this->builder->getModel()->getTable());
    }

    /**
     * If the request has the columns required to search.
     *
     * @param  Request $request
     * @return boolean
     */
    protected function hasSearchQuery(Request $request)
    {
        return count(array_filter($request->only(['column', 'operator', 'value']))) === 3;
    }

    /**
     * Resolve the given operator to perform a query.
     *
     * @param  string $operator
     * @return string
     */
    protected function resolveQueryParts($operator, $value)
    {
        return Arr::get([
            'equals' => [
                'operator' => '=',
                'value' => $value
            ],
            'contains' => [
                'operator' => 'LIKE',
                'value' => "%{$value}%"
            ],
            'starts_with' => [
                'operator' => 'LIKE',
                'value' => "{$value}%"
            ],
            'ends_with' => [
                'operator' => 'LIKE',
                'value' => "%{$value}"
            ],
            'greater_than' => [
                'operator' => '>',
                'value' => $value
            ],
            'less_than' => [
                'operator' => '<',
                'value' => $value
            ],
            'greater_than_or_equal_to' => [
                'operator' => '>=',
                'value' => $value
            ],
            'less_than_or_equal_to' => [
                'operator' => '<=',
                'value' => $value
            ],
        ], $operator);
    }

    /**
     * Build the search.
     *
     * @param  Builder $builder
     * @param  Request $request
     *
     * @return Builder
     */
    protected function buildSearch(Builder $builder, Request $request)
    {
        $queryParts = $this->resolveQueryParts($request->operator, $request->value);
        $column_depth = explode('.',$request->column);

       if(count($column_depth)>1){
            return $builder->whereHas($column_depth[0], function($query) use ($request,$queryParts,$column_depth) {
                $query->where($column_depth[1], $queryParts['operator'], $queryParts['value']);
            }); 
        }else{
            return $builder->where(
                $request->column,
                $queryParts['operator'],
                $queryParts['value']
            );
        }
    }


    /**
     * Overwrite this data it's dummy data for reffrence only
     */
    public function formData(Request $request) 
    {
        return [
            'item_id' => [
                'label'       => 'Item',
                'name'        => 'item',
                'type'        => 'select',
                'placeholder' => 'Item...',
                'data'        => [
                    [
                        'value' => 1,
                        'label' => 'Item 1',
                    ],
                    [
                        'value' => 2,
                        'label' => 'Item 2',
                    ],
                ]
            ],
            'name'   => [
                'label'       => 'Name',
                'name'        => 'name',
                'type'        => 'text',
                'placeholder' => 'Name...',
                'data'        => []
            ],
            'email'  => [
                'label'       => 'Email',
                'name'        => 'email',
                'type'        => 'email',
                'placeholder' => 'Email...',
                'data'        => []
            ],
            'description'  => [
                'label'       => 'Description',
                'name'        => 'description',
                'type'        => 'textarea',
                'placeholder' => 'Description...',
                'data'        => []
            ],
            'account_no'  => [
                'label'       => 'Account No',
                'name'        => 'account_no',
                'type'        => 'number',
                'placeholder' => 'Account No...',
                'data'        => []
            ],
        ];
    }
}
