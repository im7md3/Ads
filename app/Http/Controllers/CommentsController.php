<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        try{
            Comment::create([
                'content'=>$request->content,
                'ad_id' =>$request->ad_id,
                'user_id'=>auth()->id(),
                'parent_id'=>$request->parent_id
            ]);
            return redirect()->back()->with(['success' => 'لقد تم ارسال تعليقك بنجاح']);
        }catch(\exception $e){
            return redirect()->back()->with(['fails' => 'عذرا حذث مشكلة ما برجاء المحاولة لاحقا']);
        }
    }

    
    public function show(Comment $comment)
    {
        //
    }

    
    public function edit(Comment $comment)
    {
        //
    }

    
    public function update(Request $request, Comment $comment)
    {
        //
    }

    
    public function destroy(Comment $comment)
    {
        //
    }
}
