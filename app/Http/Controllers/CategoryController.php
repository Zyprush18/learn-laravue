<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::latest()->get();
        // dd($category);
        return Inertia::render('category/Index', ['category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $validate = $request->validated();

            Category::create($validate);

            return redirect(route('category.index'))->with(['message'=>'successfully added a new product category']);

        } catch (\Throwable $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        try {
            $validate = $request->validated();
            Category::where('id', $id)->update($validate);
            return to_route('category.index')->with(['message' => 'successfully update a product category']);
        } catch (\Throwable $th) {
            dd($th);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Category::where('id', $id)->delete();
            return to_route('category.index')->with(['message' => 'successfully delete a product category']);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
