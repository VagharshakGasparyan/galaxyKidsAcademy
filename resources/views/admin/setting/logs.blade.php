@extends('admin_root.admin_root')
@section('title', 'Logs')
@section('content')

    <div style="max-width: 1024px;">
        <div class="admin-content-title">
            <span></span>
            <h1 class="text-center">Logs</h1>
        </div>

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
                    <td>{{$log->getFilename()}}</td>
                    <td>{{ round($log->getSize() / 1024, 2) }} KB</td>
                    <td class="action-td">
                        <a class="btn btn-sm btn-secondary me-2" href="{{route('admin.logs.show', $log->getFilename())}}">Show</a>
                        <form class="d-inline-block" action="{{ route('admin.logs.delete', $log->getFilename()) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-light" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="mt-5">{{ $logs->appends(request()->query())->links('pagination.my_default') }}</div>
    </div>


@endsection
@push('css')
    <style>

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
