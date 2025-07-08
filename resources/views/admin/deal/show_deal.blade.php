@extends('admin_root.admin_root')
@section('title', 'Show Deal')
@section('content')
    <div style="max-width: 768px;">
        <div class="admin-content-title">
            <a href="{{route('admin.pages')}}" class="btn btn-outline-light"><i class="fa fa-arrow-left me-2"></i>Pages</a>
            <h1 class="text-center">Show Page</h1>
        </div>

        <table class="my_table mt-3">
            <thead></thead>
            <tbody>
            <tr>
                <td class="action-td">ID</td>
                <td>{{$deal->id}}</td>
            </tr>
            <tr>
                <td class="action-td">First Name</td>
                <td>{{$deal->first_name}}</td>
            </tr>
            <tr>
                <td class="action-td">Last Name</td>
                <td>{{$deal->last_name}}</td>
            </tr>
            <tr>
                <td class="action-td">Email</td>
                <td>{{$deal->email}}</td>
            </tr>

            <tr>
                <td class="action-td">Phone number</td>
                <td>{{$deal->phone_number}}</td>
            </tr>
            <tr>
                <td class="action-td">Comments</td>
                <td style="white-space: pre-line">{{$deal->comments}}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>{{$deal->status}}</td>
            </tr>
            <tr>
                <td class="action-td">Created</td>
                <td>{{$deal->created_at}}</td>
            </tr>
            <tr>
                <td class="action-td">Updated</td>
                <td>{{$deal->updated_at}}</td>
            </tr>
            </tbody>
        </table>

        <div class="mt-5">
            <a href="{{route('admin.deals.update', $deal->id)}}" class="btn btn-secondary">Edit</a>
        </div>
    </div>

@endsection
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{

        })
    </script>
@endpush
