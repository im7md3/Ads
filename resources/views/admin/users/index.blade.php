@extends('theme.default')

@section('head')
    <link href="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('heading')
    عرض المستخدمين
@endsection

@section('content')
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table id="books-table" class="table table-stribed text-right" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>نوع المستخدم</th>
                        <th>تعديل الصلاحيات</th>
                        <th>حذف المستخدم</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->isAdmin() ? 'مدير' : 'مستخدم' }}</td>
                            <td>
                                <form class="ml-4 form-inline" method="POST" action="{{ route('user.update', $user) }}"
                                    style="display:inline-block">
                                    @method('patch')
                                    @csrf
                                    <select class="form-control form-control-sm" name="role_id">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @if ($role == $user->role) selected @endif>
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                        تعديل</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('user.destroy', $user) }}"
                                    style="display:inline-block">
                                    @method('delete')
                                    @csrf

                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('هل أنت متأكد؟')" @if ($user == auth()->user()) disabled @endif><i
                                            class="fa fa-trash"></i>
                                        حذف</button>

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
