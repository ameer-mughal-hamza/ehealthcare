<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use MongoDB\Driver\Session;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::all();
       dd($medicines);
        $display = [
            'title' => 'Add Medicine',
            'medicines' => $medicines
        ];

        return view('admin/medicine/index')->with($display);
    }

    public function show()
    {
        $display = [
            'title' => 'Add Medicine'
        ];
        return view('admin/medicine/show')->with($display);
    }

    public function add(Request $request)
    {
        $display = [
            'title' => 'Add Medicine'
        ];

        $category = new Medicine();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        return view('admin/medicine/add')->with($display);
    }

    public function create()
    {

    }

    public function edit($slug)
    {
        $medicine = Medicine::where('slug', $slug)->first();
        return view('admin/medicine/edit')->with([
            'title' => '',
            'medicine' => $medicine
        ]);
    }

    public function update($slug, Request $request)
    {
        $medicine = Medicine::where('slug', $slug)->first();
        $medicine->name = $request->input('name');
        $medicine->description = $request->input('description');
        $medicine->save();

        session()->flash('update', 'Medicine updated successfully.');
        return view('admin/medicine/edit')->with([
            'title' => '',
            'medicine' => $medicine,
            'message' => 'Medicine updated successfully.'
        ]);
    }

    public function delete()
    {

    }
}
