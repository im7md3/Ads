<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $categories=Category::with('ads')->get();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            Category::create($request->all() + ['slug'=>$request->name]);
            return redirect()->back()->with(['success' => 'تم إضافة التصنيف بنجاح']);
        }catch(\Exception $e){
            return $e;
            return redirect()->back()->with(['fails' => 'عذرا حذث مشكلة ما برجاء المحاولة لاحقا']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try{
            $category->update($request->all() + ['slug'=>$request->name]);
            return redirect()->back()->with(['success' => 'تم تحديث اسم التصنيف بنجاح']);
        }catch(\Exception $e){
            return $e;
            return redirect()->back()->with(['fails' => 'عذرا حذث مشكلة ما برجاء المحاولة لاحقا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try{
            $ads=$category->ads()->get();
            foreach($ads as $ad){
                foreach ($ad->images as $image) {
                    unlink($image->image);
                    $image->delete();
                }
                $ad->favorites()->detach();
                $ad->comments()->delete();
            }
            $category->ads()->delete();
            $category->delete();
            return redirect()->back()->with(['success' => 'تم حذف التصنيف بنجاح']);
        }catch(\Exception $e){
            return $e;
            return redirect()->back()->with(['fails' => 'عذرا حذث مشكلة ما برجاء المحاولة لاحقا']);
        }
    }
}
