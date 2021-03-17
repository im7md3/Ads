@extends('layouts.app')

@section('title', __('titles.myAds_title'))

@section('content')

    <div class="col-lg-8">
        <p>
        <h2>إعلاناتي </h2>
        </p>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>التاريخ</th>
                    <th>عنوان الإعلان</th>
                    <th>السعر</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userAds as $ad)
                    <tr>
                        <td>{{ $ad->created_at }}</td>
                        <td><a href="{{route('ads.show',$ad->id)}}">{{ $ad->title }}</a></td>
                        <td>{{ $ad->price }}{{$ad->currency->symbol}}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('ads.edit', $ad) }}" role="button"><i
                                        class="glyphicon glyphicon-remove-sign"></i>تعديل</a>
                                <form method="POST" action="{{ route('ads.destroy', $ad) }}"
                                    onsubmit="return confirm('هل تريد فعلاً حذف السجل')">
                                    @csrf
                                    <input name="_method" type="hidden" value="delete">
                                    <button type="submit" class="btn btn-sm btn-outline-danger mr-1">حذف<i
                                            class="glyphicon glyphicon-remove"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
