<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Requests\Admin\Main\StoreRequest;
use App\Http\Requests\Admin\Main\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends BaseController
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        Category::create($data);

        return redirect()->route('admin.category.index');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        $category->update($data);

        return redirect()->route('admin.category.show', $category);
    }

    public function delete(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index');
    }
}
