<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // ======================
    // LIST CATEGORY
    // ======================

    public function index()
    {
        $categories = DB::table('categories')
                        ->orderBy('id','DESC')
                        ->get();

        return view('admin.category.index', compact('categories'));
    }

    // ======================
    // CREATE
    // ======================

    public function create()
    {
        return view('admin.category.create');
    }

    // ======================
    // STORE
    // ======================

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ]);

        DB::table('categories')->insert([
            'category_name' => $request->category_name,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('category.index')
            ->with('success','Category added successfully.');
    }

    // ======================
    // EDIT
    // ======================

    public function edit($id)
    {
        $category = DB::table('categories')->find($id);

        return view('admin.category.edit', compact('category'));
    }

    // ======================
    // UPDATE
    // ======================

    public function update(Request $request,$id)
    {

        DB::table('categories')
            ->where('id',$id)
            ->update([
                'category_name'=>$request->category_name,
                'updated_at'=>now()
            ]);

        return redirect()->route('category.index')
            ->with('success','Category updated.');

    }

    // ======================
    // DELETE
    // ======================

    public function destroy($id)
    {

        DB::table('categories')
            ->where('id',$id)
            ->delete();

        return redirect()->route('category.index')
            ->with('success','Category deleted.');

    }
}