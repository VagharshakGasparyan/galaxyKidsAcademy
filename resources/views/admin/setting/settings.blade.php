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
                    <th class="action-td">Name</th>
                    <th>View</th>
                    <th>Value</th>
                    <th class="action-td">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="action-td">Header Logo</td>
                    <td id="show_header_logo">
                        @if($settings['header_logo']->value1 ?? null)
                            <img src="{{asset('storage/' . $settings['header_logo']->value1)}}" alt="header logo" style="max-height: 70px;border-radius: 5px;">
                        @endif
                    </td>
                    <td>{{$settings['header_logo']->value1 ?? '-'}}</td>
                    <td>
                        <input type="hidden" value="{{$settings['header_logo']->value1 ?? ''}}" name="old_header_logo">
                        <input id="header_logo_input" type="file" name="header_logo" accept="image/jpeg,image/png,image/icon" style="display: none;">
                        <button id="change_header_logo_button" class="btn btn-sm btn-secondary me-2" type="button">Change</button>
                        <button type="button" class="btn btn-sm btn-light" id="delete_header_logo_button">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td class="action-td">Icon</td>
                    <td id="show_icon">
                        @if($settings['icon']->value1 ?? null)
                            <img src="{{asset('storage/' . $settings['icon']->value1)}}" alt="icon" style="max-height: 70px;border-radius: 5px;">
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
                <tr>
                    <td class="action-td">Home top image</td>
                    <td id="show_home_top_image">
                        @if($settings['home_top_image']->value1 ?? null)
                            <img src="{{asset('storage/' . $settings['home_top_image']->value1)}}" alt="image" style="max-height: 70px;border-radius: 5px;">
                        @endif
                    </td>
                    <td>{{$settings['home_top_image']->value1 ?? '-'}}</td>
                    <td class="action-td">
                        <input type="hidden" value="{{$settings['home_top_image']->value1 ?? ''}}" name="old_home_top_image">
                        <input id="home_top_image_input" type="file" name="home_top_image" accept="image/jpeg,image/png,image/webp" style="display: none;">
                        <button id="change_home_top_image_button" class="btn btn-sm btn-secondary me-2" type="button">Change</button>
                        <button type="button" class="btn btn-sm btn-light" id="delete_home_top_image_button">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td class="action-td">Home middle image</td>
                    <td id="show_home_middle_image">
                        @if($settings['home_middle_image']->value1 ?? null)
                            <img src="{{asset('storage/' . $settings['home_middle_image']->value1)}}" alt="image" style="max-height: 70px;border-radius: 5px;">
                        @endif
                    </td>
                    <td>{{$settings['home_middle_image']->value1 ?? '-'}}</td>
                    <td class="action-td">
                        <input type="hidden" value="{{$settings['home_middle_image']->value1 ?? ''}}" name="old_home_middle_image">
                        <input id="home_middle_image_input" type="file" name="home_middle_image" accept="image/jpeg,image/png,image/webp" style="display: none;">
                        <button id="change_home_middle_image_button" class="btn btn-sm btn-secondary me-2" type="button">Change</button>
                        <button type="button" class="btn btn-sm btn-light" id="delete_home_middle_image_button">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td class="action-td">Home bottom image</td>
                    <td id="show_home_bottom_image">
                        @if($settings['home_bottom_image']->value1 ?? null)
                            <img src="{{asset('storage/' . $settings['home_bottom_image']->value1)}}" alt="image" style="max-height: 70px;border-radius: 5px;">
                        @endif
                    </td>
                    <td>{{$settings['home_bottom_image']->value1 ?? '-'}}</td>
                    <td class="action-td">
                        <input type="hidden" value="{{$settings['home_bottom_image']->value1 ?? ''}}" name="old_home_bottom_image">
                        <input id="home_bottom_image_input" type="file" name="home_bottom_image" accept="image/jpeg,image/png,image/webp" style="display: none;">
                        <button id="change_home_bottom_image_button" class="btn btn-sm btn-secondary me-2" type="button">Change</button>
                        <button type="button" class="btn btn-sm btn-light" id="delete_home_bottom_image_button">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td class="action-td">Top section image</td>
                    <td id="show_top_section_image">
                        @if($settings['top_section_image']->value1 ?? null)
                            <img src="{{asset('storage/' . $settings['top_section_image']->value1)}}" alt="image" style="max-height: 70px;border-radius: 5px;">
                        @endif
                    </td>
                    <td>{{$settings['top_section_image']->value1 ?? '-'}}</td>
                    <td class="action-td">
                        <input type="hidden" value="{{$settings['top_section_image']->value1 ?? ''}}" name="old_top_section_image">
                        <input id="top_section_image_input" type="file" name="top_section_image" accept="image/jpeg,image/png,image/webp" style="display: none;">
                        <button id="change_top_section_image_button" class="btn btn-sm btn-secondary me-2" type="button">Change</button>
                        <button type="button" class="btn btn-sm btn-light" id="delete_top_section_image_button">Delete</button>
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
            let settings = ['icon', 'header_logo', 'home_top_image', 'home_middle_image', 'home_bottom_image', 'top_section_image'];
            settings.forEach((setting)=>{
                let changeButton = document.getElementById('change_' + setting + '_button');
                let deleteButton = document.getElementById('delete_' + setting + '_button');
                let showContainer = document.getElementById('show_' + setting);
                let input = document.getElementById(setting + '_input');
                changeButton.addEventListener('click', ()=>{
                    input.click();
                });
                deleteButton.addEventListener('click', ()=>{
                    showContainer.innerHTML = '';
                    input.value = null;
                    document.querySelector('input[name="old_' + setting + '"]').value = null;
                });
                input.addEventListener('input', async ()=>{
                    let file = input.files[0];
                    if (file.type.startsWith('image')) {
                        let img = new Image;
                        img.style.maxHeight = '70px';
                        img.src = await fileToBase64(file);
                        showContainer.innerHTML = '';
                        showContainer.appendChild(img);
                    }
                });
            });

        });

    </script>
@endpush
