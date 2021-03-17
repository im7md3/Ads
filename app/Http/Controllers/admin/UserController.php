<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::paginate(10);
        $roles=Role::all();
        return view('admin.users.index',compact(['users','roles']));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try{
            $user->update(['role_id'=>$request->role_id]);
            return redirect()->back()->with(['success' => 'تم تحديث دور المستخدم بنجاح']);

        }catch(\Exception $e){
            return redirect()->back()->with(['fails' => 'عذرا حذث مشكلة ما برجاء المحاولة لاحقا']);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try{
            $ads=$user->ads()->get();
            foreach($ads as $ad){
                foreach ($ad->images as $image) {
                    unlink($image->image);
                    $image->delete();
                }
                $ad->favorites()->detach();
                $ad->comments()->delete();
            }
            $user->ads()->delete();
            $user->favorites()->detach();
            $user->comments()->delete();
            if($user->avatar!='img/avatars/avatar.png'){
                unlink($user->avatar);
            }
            $user->delete();
            return redirect()->back()->with(['success' => 'تم حذف المستخدم بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->with(['fails' => 'عذرا حذث مشكلة ما برجاء المحاولة لاحقا']);
        }
    }
}
