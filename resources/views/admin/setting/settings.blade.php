@extends('admin_root.admin_root')
@section('title', 'Settings')
@section('content')
    <div style="max-width: 1024px;">
        <div class="admin-content-title">
            <span></span>
            <h1 class="text-center">Settings</h1>
        </div>
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
                    <th class="action-td">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Main Logo</td>
                    <td id="show_logo">
                        @if($settings['header_logo']->value1 ?? null)
                            <img src="{{asset('storage/' . $settings['header_logo']->value1)}}" alt="header logo" style="max-height: 50px;border-radius: 5px;">
                        @endif
                    </td>
                    <td>{{$settings['header_logo']->value1 ?? '-'}}</td>
                    <td>
                        <input type="hidden" value="{{$settings['header_logo']->value1 ?? ''}}" name="old_header_logo">
                        <input id="main_logo_input" type="file" name="header_logo" accept="image/jpeg,image/png,image/icon" style="display: none;">
                        <button id="change_main_logo_button" class="btn btn-sm btn-secondary me-2" type="button">Change</button>
                        <button type="button" class="btn btn-sm btn-light" id="delete_main_logo_button">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Icon</td>
                    <td id="show_icon">
                        @if($settings['icon']->value1 ?? null)
                            <img src="{{asset('storage/' . $settings['icon']->value1)}}" alt="icon" style="max-height: 50px;border-radius: 5px;">
                        @endif
                    </td>
                    <td>{{$settings['icon']->value1 ?? '-'}}</td>
                    <td class="action-td">
                        <input type="hidden" value="{{$settings['icon']->value1 ?? ''}}" name="old_icon">
                        <input id="icon_input" type="file" name="icon" accept="image/jpeg,image/png,image/icon" style="display: none;">
                        <button id="change_icon_button" class="btn btn-sm btn-secondary me-2" type="button">Change</button>
                        <button type="button" class="btn btn-sm btn-light" id="delete_icon_button">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div style="margin-top: 25px;">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
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
