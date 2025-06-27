@extends('admin_root.admin_root')
@section('title', 'Photos')
@section('content')
    <div style="max-width: 1280px;">
        <div class="admin-content-title">
            <span></span>
            <h1 class="text-center">Photos</h1>
        </div>
        <fieldset class="my-filters mt-3">
            <legend>Filters</legend>
            <div class="row">
                <div class="mb-3 col-md-12 col-lg-6 col-xl-4">
                    <label for="filter_title" class="form-label">Title</label>
                    <div class="position-relative">
                        <input type="text" name="filter_title" class="form-control" placeholder="Title" id="filter_title" value="{{$filter_title}}">
                        <button type="button" class="btn btn-close input-close"></button>
                    </div>
                </div>
                <div class="mb-3 col-md-12 col-lg-6 col-xl-4">
                    <label for="filter_description" class="form-label">Description</label>
                    <div class="position-relative">
                        <input type="text" name="filter_description" class="form-control" placeholder="Description" id="filter_description" value="{{$filter_description}}">
                        <button type="button" class="btn btn-close input-close"></button>
                    </div>
                </div>
                <div class="form-check mb-3 col-md-12 col-lg-6 col-xl-4">
                    <label for="filter_enabled" class="form-label">Enabled</label>
                    <select name="filter_enabled" class="form-select" id="filter_enabled">
                        <option value="" >-</option>
                        <option value="1" @if($filter_enabled == '1') selected @endif>Yes</option>
                        <option value="0" @if($filter_enabled == '0') selected @endif>No</option>
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
                    <th>Enabled</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th class="action-td">Created</th>
                    <th class="action-td">Updated</th>
                    <th class="action-td">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($photos as $item)
            <tr>
                <td class="action-td">{{$item->id}}</td>
                <td>{{$item->enabled ? 'Yes' : 'No'}}</td>
                <td>
                    @if($item->image)
                        <img alt="image" src="{{asset('storage/'.$item->image)}}" style="max-width: 100px;border-radius: 5px;">
                    @endif
                </td>
                <td>
                    @foreach($item->title as $local => $title)
                    <div style="display: flex;">
                        <div style="padding: 5px;display: flex;align-items: center;background-color: var(--c);color: var(--bg1);">{{$local}}</div>
                        <div style="flex: 1;border: 1px solid var(--c);padding: 0 5px;white-space: pre-wrap">{{$title}}</div>
                    </div>
                    @endforeach
                </td>
                <td>
                    @foreach($item->description as $local => $description)
                        <div style="display: flex;">
                            <div style="padding: 5px;display: flex;align-items: center;background-color: var(--c);color: var(--bg1);">{{$local}}</div>
                            <div style="flex: 1;border: 1px solid var(--c);padding: 0 5px;white-space: pre-wrap">{{$description}}</div>
                        </div>
                    @endforeach
                </td>
                <td class="action-td">{{$item->created_at}}</td>
                <td class="action-td">{{$item->updated_at}}</td>
                <td class="action-td">
                    <a class="btn btn-sm btn-secondary me-2" href="{{route('admin.photos.update', $item->id)}}">Edit</a>
                    <a class="btn btn-sm btn-secondary me-2" href="{{route('admin.photos.show', $item->id)}}">Show</a>
                    <form class="d-inline-block" action="{{ route('admin.photos.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-light" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div>{{ $photos->appends(request()->query())->links('pagination.my_default') }}</div>

        <div class="mt-5"><a class="btn btn-primary" href="{{route('admin.photos.create')}}">Create Photo</a></div>
    </div>

@endsection
@push('css')
    <style>

    </style>
@endpush
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{
            let filter_title = document.getElementById('filter_title');
            let filter_description = document.getElementById('filter_description');
            let filter_enabled = document.getElementById('filter_enabled');
            let filter_btn = document.getElementById('filter_btn');
            let filter_reset_btn = document.getElementById('filter_reset_btn');
            filter_btn.addEventListener('click', ()=>{
                const url = new URL(window.location.href);
                url.searchParams.set('title', filter_title.value);
                url.searchParams.set('description', filter_description.value);
                url.searchParams.set('enabled', filter_enabled.value);
                window.location.href = url.toString();
            });
            filter_reset_btn.addEventListener('click', ()=>{
                const url = new URL(window.location.href);
                url.searchParams.delete('title');
                url.searchParams.delete('description');
                url.searchParams.delete('enabled');
                filter_title.value = '';
                filter_description.value = '';
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
        });
    </script>
@endpush
