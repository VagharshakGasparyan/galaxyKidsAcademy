@extends('root.root')
@section('title', __('Gallery'))
@section('content')
    <h1 style="text-align: center">{{__('Gallery')}}</h1>
    <div style="width: 1024px;margin: 25px auto;">
        <div style="text-align: justify">
            Galaxy Kids Academy strives to provide an educational program to every child enrolled while offering a network of support to each family as a whole.

            Our teachers work in partnership with each family to identify individual goals and plans for the children.
            The curriculum we implement provides a comprehensive program for children and work toward development in the areas of communication,
            gross motor, fine motor, problem-solving, and personal-social.
        </div>
        <div style="display: flex;flex-wrap: wrap;">
            @foreach($photos as $photo)
                <div style="width: 250px;height: 250px;
                background-image: url('{{asset('storage/' . $photo->image)}}'); background-size: cover;margin: 5px;
                border: 2px solid #ddd;border-radius: 5px;"></div>
            @endforeach
        </div>

    </div>

@endsection
@push('body_js')
    <script>
        // console.log('URA');
    </script>
@endpush
