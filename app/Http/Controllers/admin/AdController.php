<?php

namespace App\Http\Controllers\admin;

use App\Ad;
use App\Category;
use App\Country;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdsRequest;
use App\Image;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $ads = Ad::paginate(10);
        return view('admin.ads.index', compact('ads'));
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
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        $countries=Country::all();
        $cats=Category::all();
        $symbols=Currency::all();
        return view('admin.ads.edit',compact(['ad','countries','cats','symbols']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(AdsRequest $request, Ad $ad)
    {
        try {
            if($request->has('images')){
                foreach ($ad->images as $image) {
                    unlink($image->image);
                    $image->delete();
                }
                foreach ($request->images as $image) {
                    $file_path = adsImageUpload($image);
                    Image::create([
                        'image' => $file_path,
                        'ad_id' => $ad->id
                    ]);
                }
            }
            
            $ad->update($request->all());
            return redirect()->route('ads.show',$ad)->with(['success' => 'تم تعديل الاعلان بنجاح']);
        } catch (\Exception $e) {
            return $e;
            return redirect()->back()->with(['fails' => 'عذرا حذث مشكلة ما برجاء المحاولة لاحقا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        try {
            foreach ($ad->images as $image) {
                unlink($image->image);
                $image->delete();
            }
            $ad->favorites()->detach($ad->id);
            $ad->comments()->delete();
            $ad->delete();
            return redirect()->back()->with(['success' => 'تم حذف الاعلان بنجاح']);
        } catch (\Exception $e) {
            return $e;
            return redirect()->back()->with(['fails' => 'عذرا حذث مشكلة ما برجاء المحاولة لاحقا']);
        }
    }
}
