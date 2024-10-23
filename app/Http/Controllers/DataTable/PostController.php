<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Controllers\DataTable\DataTableController;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends DataTableController
{
    
    public function builder()
    {
        return Post::query();
    }
    public function getDisplayableColumns()
    {
        return ['id','uuid','title','body','slug','teaser','published'];
    }
    public function hideDisplaybleColumn()
    {
        return ['id','uuid'];
    }
    public function getUpdatableColumns()
    {
        return ['title','body','slug','published'];
    }
    public function formData(Request $request) 
    {
        $data = [

            'title'   => [
                'label'       => 'Title',
                'name'        => 'name',
                'type'        => 'text',
                'placeholder' => 'Post Title...',
                'data'        => []
            ], 
            'body'  => [
                'label'       => 'Body',
                'name'        => 'body',
                'type'        => 'textarea',
                'placeholder' => 'Post Body...',
                'data'        => []
            ],
            'slug'  => [
                'label'       => 'Slug',
                'name'        => 'slug',
                'type'        => 'text',
                'placeholder' => 'Post slug...',
                'data'        => []
            ],
            'published'  => [
                'label'       => 'Published',
                'name'        => 'published',
                'type'        => 'checkbox',
                'placeholder' => 'Post Published...',
                'data'        => []
            ]
        ];
        
        return $data;
    }  
    public function getRecords(Request $request)
    {
        $builder = $this->builder;
        if ($this->hasSearchQuery($request)) {
            $builder = $this->buildSearch($builder, $request);
        }
        try {
            return $builder->limit($request->limit)->orderBy(...$this->orderBy($request))->get($this->getDisplayableColumns());
        } catch (QueryException $e) {
            return [];
        }
    }  
}