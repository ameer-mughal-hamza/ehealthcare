<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $display = [
            'title' => 'Add Category',
            'categories' => $categories
        ];

        return view('admin/category/index')->with($display);
    }

    public function show()
    {
        $display = [
            'title' => 'Add Category'
        ];
        return view('admin/category/show')->with($display);
    }

    public function add(Request $request)
    {
        $display = [
            'title' => 'Add Category'
        ];

        return view('admin/category/add')->with($display);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:26'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        return redirect()->route('category_index')->with([
            'title' => 'Category'
        ]);
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('admin/category/edit')->with([
            'title' => '',
            'category' => $category
        ]);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
