@extends('admin_root.admin_root')
@section('title', 'Update Deal')
@section('content')
    <form id="form_update_page" style="max-width: 768px;" method="post" action="{{route('admin.deals.postUpdate', $deal->id)}}">
        <div class="admin-content-title">
            <a href="{{route('admin.deals')}}" class="btn btn-outline-light"><i class="fa fa-arrow-left me-2"></i>Deals</a>
            <h1 class="text-center">Update Deal</h1>
        </div>
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name *</label>
            <input type="text" name="first_name" class="form-control" placeholder="First Name" id="first_name" value="{{old('first_name', $deal->first_name)}}" required>
            @error('first_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name *</label>
            <input type="text" name="last_name" class="form-control" placeholder="Last Name" id="first_name" value="{{old('last_name', $deal->last_name)}}" required>
            @error('last_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" name="email" class="form-control" placeholder="Email" id="first_name" value="{{old('email', $deal->email)}}" required>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone number *</label>
            <input type="tel" name="phone_number" class="form-control" placeholder="Phone number" id="phone_number" value="{{old('phone_number', $deal->phone_number)}}" required>
            @error('phone_number')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="comments" class="form-label">Comments *</label>
            <textarea rows="5" name="comments" class="form-control" placeholder="Comments" id="comments" required>{{old('comments', $deal->comments)}}</textarea>
            @error('comments')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" id="status">
                @foreach($statuses as $statusKey => $statusName)
                    <option value="{{$statusKey}}" @if(old('status', $deal->status) == $statusKey) selected @endif>{{$statusName}}</option>
                @endforeach
            </select>
            @error('status')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>




        <div class="mt-5">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

@endsection
@push('head_js')

@endpush
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{

        });
    </script>
@endpush
