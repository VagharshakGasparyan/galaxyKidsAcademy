@extends('admin_root.admin_root')
@section('title', 'Show Log')
@section('content')
    <h1 style="text-align: center">Show Log</h1>
    <div style="width: 1024px;margin: 0 auto 150px auto;">
{{--        @dump($log->getSize())--}}
        <div style="margin-bottom: 25px;">{{$name}}, {{round($size / 1024, 2)}} KB</div>
{{--        <div style="white-space: pre-wrap">{{$log}}</div>--}}
        @foreach($arrLog as $logItem)
            <div class="log-item" style="margin-top: 20px; ">{{$logItem}}</div>
        @endforeach
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
        .log-item{
            white-space: pre-wrap;
            text-overflow: ellipsis;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
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
