@extends('admin_root.admin_root')
@section('title', 'Dashboard')
@section('content')

    <div style="max-width: 768px;">
        <div class="admin-content-title">
            <a href="{{route('admin.photos')}}" class="btn btn-outline-light"><i class="fa fa-arrow-left me-2"></i>Photos</a>
            <h1 class="text-center">Show Photo</h1>
        </div>
        <div style="display: flex; justify-content: flex-end;align-items: center;">
            <div style="margin-right: 10px;">Choose language </div>
            <select class="form-select" style="width: unset" name="lang">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <option value="{{$localeCode}}" @if($localeCode == $lang) selected @endif>{{$properties['name']}}</option>
                @endforeach
            </select>
        </div>
        <hr style="width: 100%">

        <table class="my_table">
            <thead></thead>
            <tbody>
            <tr>
                <th class="action-td">ID</th>
                <td>{{$photo->id}}</td>
            </tr>
            <tr>
                <th class="action-td">Title</th>
                <td>{{$photo->title[$lang] ?? ''}}</td>
            </tr>
            <tr>
                <th class="action-td">Description</th>
                <td>{{$photo->description[$lang] ?? ''}}</td>
            </tr>
            <tr>
                <th class="action-td">Image</th>
                <td>
                    @if($photo->image)
                        <img src="{{asset('storage/' . $photo->image)}}" alt="image" style="max-width: 100%; border-radius: 5px;">
                    @endif
                </td>
            </tr>
            <tr>
                <th class="action-td">Created</th>
                <td>{{$photo->created_at}}</td>
            </tr>
            <tr>
                <th class="action-td">Updated</th>
                <td>{{$photo->updated_at}}</td>
            </tr>

            </tbody>
        </table>

        <div class="mt-5">
            <a href="{{route('admin.photos.update', $photo->id)}}" class="btn btn-secondary">Edit</a>
        </div>
    </div>

@endsection
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{
            let select_lang = document.querySelector('select[name="lang"]');
            select_lang.addEventListener('input', ()=>{
                // alert(select_lang.value);
                const url = new URL(window.location.href);
                url.searchParams.set('lang', select_lang.value);
                // Go to the new URL (without reloading the page)
                //history.pushState({}, '', url);
                // Or with reloading:
                window.location.href = url.toString();
            });
        })
    </script>
@endpush
