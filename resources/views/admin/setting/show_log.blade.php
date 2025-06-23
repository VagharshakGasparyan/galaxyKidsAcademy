@extends('admin_root.admin_root')
@section('title', 'Show Log')
@section('content')
    <div class="admin-content-title">
        <a href="{{route('admin.logs')}}" class="btn btn-outline-light"><i class="fa fa-arrow-left me-2"></i>Logs</a>
        <h1 class="text-center">Log</h1>
    </div>
    <div class="accordion accordion-flush" id="accordionFlushLogs">
        @foreach($arrLog as $indexLog => $logItem)
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading-{{$indexLog}}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{$indexLog}}" aria-expanded="false" aria-controls="flush-collapseOne">
                        <div class="log-item">{{$logItem}}</div>
                    </button>
                </h2>
                <div id="flush-collapse-{{$indexLog}}" class="accordion-collapse collapse" aria-labelledby="flush-heading-{{$indexLog}}" data-bs-parent="#accordionFlushLogs">
                    <div class="accordion-body">{{$logItem}}</div>
                </div>
            </div>
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
