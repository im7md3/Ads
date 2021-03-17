<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Category;
use App\Country;
use App\Favorite;
use App\Http\Requests\AdsRequest;
use App\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Auth;

class AdsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit']);
    }

    public function index()
    {
        $userAds = Ad::where('user_id', auth()->id())->get();
        return view('ads.userAds', compact('userAds'));
    }


    public function create()
    {
        return view('ads.create');
    }


    public function store(AdsRequest $request)
    {
        try {
            $ad = Ad::create($request->all() + ['slug' => $request->title, 'user_id' => auth()->id()]);
            foreach ($request->images as $image) {
                $file_path = adsImageUpload($image);
                Image::create([
                    'image' => $file_path,
                    'ad_id' => $ad->id
                ]);
            }
            return redirect()->route('ads.index')->with(['success' => 'تم اضافة الاعلان بنجاح']);
        } catch (\Exception $e) {
            return $e;
            return redirect()->back()->with(['fails' => 'عذرا حذث مشكلة ما برجاء المحاولة لاحقا']);
        }
    }


    public function show($id)
    {
        $favorited = false;
        $ad = Ad::with(['images', 'comments'])->find($id);
        if (Auth::check()) {
            if (auth()->user()->isFavorites($ad)) {
                $favorited = true;
            }
        }
        return view('ads.show', compact('ad', 'favorited'));
    }


    public function edit(Ad $ad)
    {
        if (\Gate::allows('edit-ad', $ad)) {
            return view('ads.edit', compact('ad'));
        } else {
            return redirect()->back();
        }
    }


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
            
            $ad->update($request->all() + ['slug' => $request->title]);
            return redirect()->route('ads.index')->with(['success' => 'تم تعديل الاعلان بنجاح']);
        } catch (\Exception $e) {
            return $e;
            return redirect()->back()->with(['fails' => 'عذرا حذث مشكلة ما برجاء المحاولة لاحقا']);
        }
    }


    public function destroy(Ad $ad)
    {
        try {
            foreach ($ad->images as $image) {
                unlink($image->image);
                $image->delete();
            }
            $likes=$ad->favorites()->detach();
            
            $ad->comments()->delete();
            $ad->delete();
            return redirect()->route('ads.index')->with(['success' => 'تم حذف الاعلان بنجاح']);
        } catch (\Exception $e) {
            return $e;
            return redirect()->back()->with(['fails' => 'عذرا حذث مشكلة ما برجاء المحاولة لاحقا']);
        }
    }

    public function result(Request $request)
    {
        $ads = Ad::filter($request);
        return view('ads.showResults', compact('ads'));
    }

    public function commonAds()
    {

        $ads = Ad::with('images')->whereIn(
            'id',
            Favorite::select('ad_id')->groupBy('ad_id')->orderByRaw('COUNT(*) DESC')->limit(8)->get()
        )->get();
        return view('index', compact('ads'));
    }
}
