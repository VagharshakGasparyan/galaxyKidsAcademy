@extends('admin_root.admin_root')
@section('title', 'Settings')
@section('content')
    <h1 style="text-align: center">Settings</h1>
    <div style="width: 1024px;margin: 0 auto 150px auto;">
        @if ($errors->any())
            <div style="color: red">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.settings.postUpdate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <table class="my_table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>View</th>
                    <th>Value</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Main Logo</td>
                    <td id="show_logo">
                        @if($settings['header_logo']->value1 ?? null)
                            <img src="{{asset('storage/' . $settings['header_logo']->value1)}}" alt="header logo" style="max-height: 50px;">
                        @endif
                    </td>
                    <td></td>
                    <td>
                        <input type="hidden" value="{{$settings['header_logo']->value1 ?? ''}}" name="old_header_logo">
                        <input id="main_logo_input" type="file" name="header_logo" accept="image/jpeg,image/png,image/icon" style="display: none;">
                        <button type="button" id="delete_main_logo_button">Delete</button>
                        <button id="change_main_logo_button" type="button">Change</button>
                    </td>
                </tr>
                <tr>
                    <td>Icon</td>
                    <td id="show_icon">
                        @if($settings['icon']->value1 ?? null)
                            <img src="{{asset('storage/' . $settings['icon']->value1)}}" alt="icon" style="max-height: 50px;">
                        @endif
                    </td>
                    <td></td>
                    <td>
                        <input type="hidden" value="{{$settings['icon']->value1 ?? ''}}" name="old_icon">
                        <input id="icon_input" type="file" name="icon" accept="image/jpeg,image/png,image/icon" style="display: none;">
                        <button type="button" id="delete_icon_button">Delete</button>
                        <button id="change_icon_button" type="button">Change</button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div style="margin-top: 25px;">
                <button type="submit">Save</button>
            </div>
        </form>
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
    </style>
@endpush
@push('head_js')

@endpush
@push('body_js')
    <script>
        window.addEventListener('load', ()=>{
            async function fileToBase64(file) {
                let b64 = await new Promise((resolve) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => resolve(reader.result);
                });
                return b64;
            }
            let change_main_logo_button = document.getElementById('change_main_logo_button');
            let delete_icon_button = document.getElementById('delete_icon_button');
            let change_icon_button = document.getElementById('change_icon_button');
            let delete_main_logo_button = document.getElementById('delete_main_logo_button');

            let show_logo = document.getElementById('show_logo');
            let show_icon = document.getElementById('show_icon');
            let main_logo_input = document.getElementById('main_logo_input');
            let icon_input = document.getElementById('icon_input');
            change_main_logo_button.addEventListener('click', ()=>{
                main_logo_input.click();
            });
            delete_main_logo_button.addEventListener('click', ()=>{
                show_logo.innerHTML = '';
                main_logo_input.value = null;
                document.querySelector('input[name="old_header_logo"]').value = null;
            });
            change_icon_button.addEventListener('click', ()=>{
                icon_input.click();
            });
            delete_icon_button.addEventListener('click', ()=>{
                show_icon.innerHTML = '';
                icon_input.value = null;
                document.querySelector('input[name="old_icon"]').value = null;
            });
            main_logo_input.addEventListener('input', async ()=>{
                let file = main_logo_input.files[0];
                if (file.type.startsWith('image')) {
                    let img = new Image;
                    img.style.maxHeight = '50px';
                    img.src = await fileToBase64(file);
                    show_logo.innerHTML = '';
                    show_logo.appendChild(img);
                }
            });
            icon_input.addEventListener('input', async ()=>{
                let file = icon_input.files[0];
                if (file.type.startsWith('image')) {
                    let img = new Image;
                    img.style.maxHeight = '50px';
                    img.src = await fileToBase64(file);
                    show_icon.innerHTML = '';
                    show_icon.appendChild(img);
                }
            });
        });

    </script>
@endpush
