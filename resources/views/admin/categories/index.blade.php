@extends('theme.default')

@section('head')
    <link href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('heading')
    عرض التصنيفات
@endsection

@section('content')
    <form action="{{route('category.store')}}" method="POST" class="d-flex w-50">
        @csrf
        <input type="text" name="name" class="form-control" placeholder="أضف صنفا جديدا" required>
        <button class="btn btn-outline-primary mr-2">أضف</button>
    </form>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table id="books-table" class="table table-stribed text-right" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>عدد الإعلانات</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->ads->count() }}</td>
                            <td>
                                <form class="d-flex" method="POST" action="{{route('category.update',$category)}}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="text" name="name" id="" class="form-control" value="{{$category->name}}">
                                    <button class="mr-2 btn btn-outline-info btn-sm">تعديل</button>
                                </form>
                                
                            </td>
                            <td>
                                <form method="POST" action="{{ route('category.destroy', $category) }}"
                                    style="display:inline-block">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('هل أنت متأكد؟')"><i class="fa fa-trash"></i> حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
