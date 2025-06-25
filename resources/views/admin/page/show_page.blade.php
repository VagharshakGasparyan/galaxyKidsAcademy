@extends('admin_root.admin_root')
@section('title', 'Dashboard')
@section('content')
    <div style="max-width: 768px;">
        <div class="admin-content-title">
            <a href="{{route('admin.pages')}}" class="btn btn-outline-light"><i class="fa fa-arrow-left me-2"></i>Pages</a>
            <h1 class="text-center">Show Page</h1>
        </div>
        <div style="display: flex; justify-content: flex-end;align-items: center;">
            <div style="margin-right: 10px;">Choose language </div>
            <select class="form-select" style="width: unset" name="lang">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <option value="{{$localeCode}}" @if($localeCode == $lang) selected @endif>{{$properties['name']}}</option>
                @endforeach
            </select>
        </div>

        <table class="my_table mt-3">
            <thead></thead>
            <tbody>
            <tr>
                <td class="action-td">ID</td>
                <td>{{$page->id}}</td>
            </tr>
            <tr>
                <td class="action-td">Enabled</td>
                <td>{{$page->enabled ? 'Yes' : 'No'}}</td>
            </tr>
            <tr>
                <td class="action-td">Name</td>
                <td>{{$page->name}}</td>
            </tr>
            <tr>
                <td class="action-td">Slug</td>
                <td>{{$page->slug}}</td>
            </tr>

            <tr>
                <td class="action-td">Big title</td>
                <td><h1>{{$page->big_title[$lang] ?? ''}}</h1></td>
            </tr>
            <tr>
                <td class="action-td">Medium title</td>
                <td><h2>{{$page->medium_title[$lang] ?? ''}}</h2></td>
            </tr>
            <tr>
                <td>Small title</td>
                <td><h3>{{$page->small_title[$lang] ?? ''}}</h3></td>
            </tr>
            <tr>
                <td class="action-td">Content</td>
                <td>
                    <div style="white-space: pre-wrap">{!! $page->content[$lang] ?? '' !!}</div>
                </td>
            </tr>
            <tr>
                <td class="action-td">Image</td>
                <td>
                    @if($page->image)
                        <img src="{{asset('storage/' . $page->image)}}" alt="image" style="max-width: 100%">
                    @endif
                </td>
            </tr>
            <tr>
                <td class="action-td">Images</td>
                <td>
                    <div class="row align-items-center">
                        @foreach($page->images ?? [] as $imageItem)
                            <div class="col-lg-4 col-md-6 col-sm-12 position-relative" style="padding: 15px;">
                                <img src="{{asset('storage/' . $imageItem)}}" alt="imageItem"
                                     style="width: 100%;border-radius: 5px;">
                            </div>
                        @endforeach
                    </div>
                </td>
            </tr>
            <tr>
                <td class="action-td">Created</td>
                <td>{{$page->created_at}}</td>
            </tr>
            <tr>
                <td class="action-td">Updated</td>
                <td>{{$page->updated_at}}</td>
            </tr>
            </tbody>
        </table>

        <div class="mt-5">
            <a href="{{route('admin.pages.update', $page->id)}}" class="btn btn-secondary">Edit</a>
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
