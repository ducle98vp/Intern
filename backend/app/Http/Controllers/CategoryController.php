<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $category_resource = CategoryResource::collection($categories);

        return $category_resource;
    }
}
