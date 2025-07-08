@extends('admin_root.admin_root')
@section('title', 'Pages')
@section('content')
    <div>
        <div class="admin-content-title">
            <span></span>
            <h1 class="text-center">Pages</h1>
        </div>
        <fieldset class="my-filters mt-3">
            <legend>Filters</legend>
            <div class="row">
                <div class="mb-3 col-md-12 col-lg-6 col-xl-4">
                    <label for="filter_name" class="form-label">Name</label>
                    <div class="position-relative">
                        <input type="text" name="filter_name" class="form-control" placeholder="Name" id="filter_name" value="{{$name}}">
                        <button type="button" class="btn btn-close input-close"></button>
                    </div>
                </div>
                <div class="mb-3 col-md-12 col-lg-6 col-xl-4">
                    <label for="filter_slug" class="form-label">Slug</label>
                    <div class="position-relative">
                        <input type="text" name="filter_slug" class="form-control" placeholder="Slug" id="filter_slug" value="{{$slug}}">
                        <button type="button" class="btn btn-close input-close"></button>
                    </div>
                </div>
                <div class="form-check mb-3 col-md-12 col-lg-6 col-xl-4">
                    <label for="filter_enabled" class="form-label">Enabled</label>
                    <select name="filter_enabled" class="form-select" id="filter_enabled">
                        <option value="" >-</option>
                        <option value="1" @if($enabled == '1') selected @endif>Yes</option>
                        <option value="0" @if($enabled == '0') selected @endif>No</option>
                    </select>
                </div>


                <div class="mb-3 col-12">
                    <button type="button" class="btn btn-sm btn-primary me-2" id="filter_btn">Find by filters</button>
                    <button type="button" class="btn btn-sm btn-secondary" id="filter_reset_btn">Reset filters</button>
                </div>
            </div>
        </fieldset>
        <table class="my_table mt-3">
            <thead>
                <tr>
                    <th class="action-td">ID</th>
                    <th>Name</th>
                    <th>Enabled</th>
                    <th>Type</th>
                    <th>Image</th>
                    <th>Images</th>
                    <th>Big Title</th>
                    <th>Medium Title</th>
                    <th>Small Title</th>
                    <th>Content</th>
                    <th>Slug</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th class="action-td sticky-column">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
            <tr>
                <td class="action-td">{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->enabled ? 'Yes' : 'No'}}</td>
                <td>{{$item->type}}</td>
                <td>
                    @if($item->image)
                        <img alt="image" src="{{asset('storage/'.$item->image)}}" style="max-width: 100px;border-radius: 5px;">
                    @endif
                </td>
                <td style="min-width: 200px;">
                    <div class="row">
                        @foreach($item->images as $image)
                            <div class="col-4 p-2">
                                <img alt="image" src="{{asset('storage/' . $image)}}" style="width: 50px;border-radius: 5px;">
                            </div>
                        @endforeach
                    </div>

                </td>
                <td>
                    @foreach($item->big_title as $local => $big_title)
                    <div class="by-locales">
                        <div>{{$local}}</div>
                        <div>{{$big_title}}</div>
                    </div>
                    @endforeach
                </td>
                <td>
                    @foreach($item->medium_title as $local => $medium_title)
                        <div class="by-locales">
                            <div>{{$local}}</div>
                            <div>{{$medium_title}}</div>
                        </div>
                    @endforeach
                </td>
                <td>
                    @foreach($item->small_title as $local => $small_title)
                        <div class="by-locales">
                            <div>{{$local}}</div>
                            <div>{{$small_title}}</div>
                        </div>
                    @endforeach
                </td>
                <td>
                    @foreach($item->content as $local => $content)
                        <div class="by-locales">
                            <div>{{$local}}</div>
                            <div>{!! $content !!}</div>
                        </div>
                    @endforeach
                </td>
                <td>{{$item->slug}}</td>
                <td style="white-space: nowrap">{{$item->created_at}}</td>
                <td style="white-space: nowrap">{{$item->updated_at}}</td>
                <td class="action-td sticky-column">
                    <a class="btn btn-sm btn-secondary me-2" href="{{route('admin.pages.update', $item->id)}}">Edit</a>
                    <a class="btn btn-sm btn-secondary me-2" href="{{route('admin.pages.show', $item->id)}}">Show</a>
                    <a class="btn btn-sm btn-secondary me-2" href="{{route('page', ['slug' => $item->slug])}}" target="_blank">Open Page</a>
                    <form class="d-inline-block" action="{{ route('admin.pages.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-light" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-5">{{ $items->appends(request()->query())->links('pagination.my_default') }}</div>

        <div class="mt-5"><a class="btn btn-primary" href="{{route('admin.pages.create')}}">Create Page</a></div>
    </div>

@endsection
@push('css')
    <style>

    </style>
@endpush
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{
            let filter_name = document.getElementById('filter_name');
            let filter_slug = document.getElementById('filter_slug');
            let filter_enabled = document.getElementById('filter_enabled');
            let filter_btn = document.getElementById('filter_btn');
            let filter_reset_btn = document.getElementById('filter_reset_btn');
            filter_btn.addEventListener('click', ()=>{
                const url = new URL(window.location.href);
                filter_name.value ? url.searchParams.set('name', filter_name.value) : url.searchParams.delete('name');
                filter_slug.value ? url.searchParams.set('slug', filter_slug.value) : url.searchParams.delete('slug');
                filter_enabled.value ? url.searchParams.set('enabled', filter_enabled.value) : url.searchParams.delete('enabled');
                window.location.href = url.toString();
            });
            filter_reset_btn.addEventListener('click', ()=>{
                const url = new URL(window.location.href);
                url.searchParams.delete('name');
                url.searchParams.delete('slug');
                url.searchParams.delete('enabled');
                filter_name.value = '';
                filter_slug.value = '';
                filter_enabled.value = '';
                window.location.href = url.toString();
            });
            document.querySelectorAll('.input-close').forEach((btn)=>{
                btn.addEventListener('click', ()=>{
                    let inp = btn.parentElement.querySelector('input');
                    if(inp){
                        inp.value = '';
                    }
                });
            });
            //--------------------------------------------------------------
        });
    </script>
@endpush
