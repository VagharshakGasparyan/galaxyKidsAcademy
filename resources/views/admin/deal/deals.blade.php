@extends('admin_root.admin_root')
@section('title', 'Deals')
@section('content')
    <div>
        <div class="admin-content-title">
            <span></span>
            <h1 class="text-center">Deals</h1>
        </div>
        <fieldset class="my-filters mt-3">
            <legend>Filters</legend>
            <div class="row">
                <div class="mb-3 col-md-12 col-lg-6 col-xl-4">
                    <label for="filter_first_name" class="form-label">First Name</label>
                    <div class="position-relative">
                        <input type="text" name="filter_first_name" class="form-control" placeholder="First Name" id="filter_first_name" value="{{$first_name}}">
                        <button type="button" class="btn btn-close input-close"></button>
                    </div>
                </div>
                <div class="mb-3 col-md-12 col-lg-6 col-xl-4">
                    <label for="filter_last_name" class="form-label">Last Name</label>
                    <div class="position-relative">
                        <input type="text" name="filter_last_name" class="form-control" placeholder="Last Name" id="filter_last_name" value="{{$last_name}}">
                        <button type="button" class="btn btn-close input-close"></button>
                    </div>
                </div>
                <div class="form-check mb-3 col-md-12 col-lg-6 col-xl-4">
                    <label for="filter_status" class="form-label">Status</label>
                    <select name="filter_status" class="form-select" id="filter_status">
                        <option value="" >-</option>
                        @foreach($statuses as $statusKey => $statusName)
                            <option value="{{$statusKey}}" @if($status == $statusKey) selected @endif>{{$statusName}}</option>
                        @endforeach
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
                <th class="action-td">First Name</th>
                <th class="action-td">Last Name</th>
                <th class="action-td">Email</th>
                <th class="action-td">Phone number</th>
                <th>Comments</th>
                <th>Status</th>
                <th class="action-td">Created</th>
                <th class="action-td">Updated</th>
                <th class="action-td sticky-column">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($deals as $item)
                <tr>
                    <td class="action-td">{{$item->id}}</td>
                    <td class="action-td">{{$item->first_name}}</td>
                    <td class="action-td">{{$item->last_name}}</td>
                    <td class="action-td">{{$item->email}}</td>
                    <td class="action-td">{{$item->phone_number}}</td>
                    <td style="white-space: pre-line">{{$item->comments}}</td>
                    <td>{{$item->status}}</td>
                    <td class="action-td">{{$item->created_at}}</td>
                    <td class="action-td">{{$item->updated_at}}</td>
                    <td class="action-td sticky-column">
                        <a class="btn btn-sm btn-secondary me-2" href="{{route('admin.deals.update', $item->id)}}">Edit</a>
                        <a class="btn btn-sm btn-secondary me-2" href="{{route('admin.deals.show', $item->id)}}">Show</a>
                        <form class="d-inline-block" action="{{ route('admin.deals.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-light" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-5">{{ $deals->appends(request()->query())->links('pagination.my_default') }}</div>
    </div>

@endsection
@push('css')
    <style>

    </style>
@endpush
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{
            let filter_first_name = document.getElementById('filter_first_name');
            let filter_last_name = document.getElementById('filter_last_name');
            let filter_status = document.getElementById('filter_status');
            let filter_btn = document.getElementById('filter_btn');
            let filter_reset_btn = document.getElementById('filter_reset_btn');
            filter_btn.addEventListener('click', ()=>{
                const url = new URL(window.location.href);
                filter_first_name.value ? url.searchParams.set('first_name', filter_first_name.value) : url.searchParams.delete('first_name');
                filter_last_name.value ? url.searchParams.set('last_name', filter_last_name.value) : url.searchParams.delete('last_name');
                filter_status.value ? url.searchParams.set('status', filter_status.value) : url.searchParams.delete('status');
                window.location.href = url.toString();
            });
            filter_reset_btn.addEventListener('click', ()=>{
                const url = new URL(window.location.href);
                url.searchParams.delete('first_name');
                url.searchParams.delete('last_name');
                url.searchParams.delete('status');
                filter_first_name.value = '';
                filter_last_name.value = '';
                filter_status.value = '';
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
