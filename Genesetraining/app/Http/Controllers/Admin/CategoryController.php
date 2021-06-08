<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories =category::latest()->get();
        return view('admin.category.index' , ['categories' => $categories]);
    }

    
    public function create()
    {
        $categories=category::all();
        return view('admin.category.create' , ['categories' => $categories]);
    }
    

    
    public function store(Request $request)
    {
        // return "hello";
        $validated = $request->validate([
            'category_name' => 'required|max:255',
            'category_desc' => 'required|max:255',
            // 'slug' => 'required|unique:categories',
            
         ]);
         $slug = strtolower( str_replace(' ', '-', $request->input('category_name')) );
        //  return $slug;

          $categories = Category::whereSlug($slug)->get();
           if( $categories->count() > 0 ){
           return redirect()->back()->withErrors(['Slug must be unique']);
          }
        
         $category = new category();
         $category->category_name = $request->input('category_name');
         $category->category_desc = $request->input('category_desc');
        $category->parent_id = $request->input('parent_id');
         $category->slug = $slug;
         $category->save();
         return redirect('/admin/category');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit(category $category)
    {
        $categories=category::all();
        return view('admin.category.edit' ,compact('categories'));
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        $category = category::find($id);
        $category->delete($id);
        return redirect('/admin/category');
    }
}
