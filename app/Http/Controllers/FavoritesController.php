<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Favorite;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {
        //
    }

    public function fav(Request $request,Ad $ad)
    {
        try{
            if(auth()->user()->isFavorites($ad)>0){ 
                auth()->user()->favorites()->detach($ad->id);
            }else{ 
                auth()->user()->favorites()->attach($ad->id);
            } 
            
        }catch(\Exception $e){
            return $e;
            return redirect()->back()->with(['fails' => 'عذرا حذث مشكلة ما برجاء المحاولة لاحقا']);
        }
        
        
    }
    public function myfav(){
        $userFav=auth()->user()->favorites()->get();
        return view('user.userFavorites',compact('userFav'));
    }
}
