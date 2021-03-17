@extends('theme.default')

@section('head')
<link href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('heading')
عرض الكتب
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <table id="books-table" class="table table-stribed text-right" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>محتوى الإعلان</th>
                    <th>السعر</th>
                    <th>الناشر</th>
                    <th>التصنيف</th>
                    <th>الدولة</th>
                    <th>خيارات</th>
                </tr>
            </thead>

            <tbody>
                @foreach($ads as $index=>$ad)
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td><a href="{{ route('ads.show', $ad) }}">{{ $ad->title }}</a></td>
                        <td>{{Str::limit($ad->text, 30, '...')  }}</td>
                        <td>{{ $ad->price }}{{$ad->currency->symbol}}</td>
                        <td>{{ $ad->user->name }}</td>
                        <td>{{ $ad->category != null ? $ad->category->name : '' }}</td>
                        <td>{{$ad->country->name}}</td>
                        <td class="d-flex flex-column align-items-center justify-content-center">
                            <a class="mb-2 btn btn-info btn-sm" href=" {{ route('ad.edit', $ad) }} "><i class="fa fa-edit"></i> تعديل</a> 
                            <form class="d-inline-block" method="POST" action="{{ route('ad.destroy', $ad) }}  ">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')"><i class="fa fa-trash"></i> حذف</button> 
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$ads->links()}}
    </div>
</div>
@endsection

@section('script')
<!-- Page level plugins -->
<script src="{{ asset('theme/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#books-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
            }
        });
    });
</script>
@endsection