<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function store(Request $request)
    {
        $Category = Category::create($request->all());

        return response()->json($Category, 201);
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());

        return response()->json($category, 200);
    }

    public function delete(Category $category)
    {
        $category->delete();

        return response()->json(null, 204);
    }
}
