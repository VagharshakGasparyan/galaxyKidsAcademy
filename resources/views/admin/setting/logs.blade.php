@extends('admin_root.admin_root')
@section('title', 'Logs')
@section('content')
    <h1 style="text-align: center">Logs</h1>
    <div style="width: 1024px;margin: 0 auto 150px auto;">
        <table class="my_table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Size</th>
                <th class="action-td">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{$log}}</td>
                    <td>15MB</td>
                    <td class="action-td">
                        <button type="button">Show</button>
                        <button type="button">Delete</button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>


@endsection
@push('css')
    <style>
        .my_table{
            border-collapse: collapse;
            width: 100%;
        }
        .my_table td, .my_table th{
            border: 2px solid #aaa;
        }
        .action-td{
            width: 0;
            white-space: nowrap;
            /*max-width: max-content;*/
        }
    </style>
@endpush
@push('head_js')

@endpush
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{

        });

    </script>
@endpush
