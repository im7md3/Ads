@extends('theme.default')

@section('heading')
تعديل بيانات الإعلان
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="card mb-4 col-md-8">
        <div class="card-header text-right">
            عدّل بيانات الإعلان      
        </div>
        <div class="card-body">
            <form action="{{ route('ad.update', $ad) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <input type="hidden" name="id" value="{{$ad->id}}">
                <div class="form-group row">
                    <label for="country_id" class="col-md-4 col-form-label text-md-right">حدد البلد</label>

                    <div class="col-md-6">
                        <select class="form-control" name="country_id" id="country_id">
                            @foreach ($countries as $country)
                                <option value="{{$country->id}}" @if ($ad->country_id == $country->id)
                                    selected
                                @endif>{{$country->name}}</option>
                            @endforeach
                        </select>

                        @error('country_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category_id" class="col-md-4 col-form-label text-md-right">حدد التصنيف</label>

                    <div class="col-md-6">
                        <select class="form-control" name="category_id" id="category_id">
                            @foreach ($cats as $cat)
                                <option value="{{$cat->id}}" @if ($ad->category_id == $cat->id)
                                    selected
                                @endif>{{$cat->name}}</option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">عنوان الإعلان</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $ad->title }}" autocomplete="title">

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="text" class="col-md-4 col-form-label text-md-right">تفاصيل الإعلان</label>

                    <div class="col-md-6">
                        <textarea id="text" type="text" class="form-control @error('text') is-invalid @enderror" name="text" autocomplete="text">{{ $ad->text }}</textarea>

                        @error('text')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="price" class="col-md-4 col-form-label text-md-right">السعر</label>

                    <div class="col-md-6">
                        <input id="price"  type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $ad->price }}" autocomplete="price">

                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="form-group row">
                    <label for="category" class="col-md-4 col-form-label text-md-right">اختار العملة</label>

                    <div class="col-md-6">
                        <select id="currency_id" class="form-control" name="currency_id">
                            @foreach($symbols as $sym)
                                <option value="{{ $sym->id }}" {{ $ad->currency_id == $sym->id ? "selected" : ""  }}>{{ $sym->symbol }}</option>
                            @endforeach
                        </select>

                        @error('currency_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="images[]" class="col-md-4 col-form-label text-md-right">أضف الصور</label>

                    <div class="col-md-6">
                        <input type="file" name="images[]" class="form-control" multiple>

                        @error('images[]')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary">تعديل الإعلان</button>

            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function readCoverImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
            $('#cover-image-thumb')
                .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection