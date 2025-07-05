@extends('admin_root.admin_root')
@section('title', 'Translations')
@section('content')
    <div>
        <div class="admin-content-title">
            <span></span>
            <h1 class="text-center">Translations</h1>
        </div>

        <div style="display: flex; justify-content: flex-end;align-items: center;">
            <div style="margin-right: 10px;">Choose language </div>
            <select class="form-select" style="width: unset" name="lang">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <option value="{{$localeCode}}" @if($localeCode == $lang) selected @endif>{{$properties['name']}}</option>
                @endforeach
            </select>
        </div>
        <fieldset class="my-filters mt-3">
            <legend>Filters</legend>
            <div class="row">
                <div class="mb-3 col-md-12 col-lg-6">
                    <label for="filter_key" class="form-label">Key</label>
                    <div class="position-relative">
                        <input type="text" name="Key" class="form-control" placeholder="Key" id="filter_key" value="{{$req_key}}">
                        <button type="button" class="btn btn-close input-close"></button>
                    </div>
                </div>
                <div class="mb-3 col-md-12 col-lg-6">
                    <label for="filter_val" class="form-label">Translation</label>
                    <div class="position-relative">
                        <input type="text" name="Key" class="form-control" placeholder="Translation" id="filter_val" value="{{$req_val}}">
                        <button type="button" class="btn btn-close input-close"></button>
                    </div>

                </div>
                <div class="mb-3 col-12">
                    <button type="button" class="btn btn-sm btn-primary me-2" id="filter_btn">Find by filters</button>
                    <button type="button" class="btn btn-sm btn-secondary" id="filter_reset_btn">Reset filters</button>
                </div>
            </div>
        </fieldset>



        @if ($errors->any())
            <div style="color: red">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="my_table mt-5">
            <thead>
            <tr>
                <th class="action-td">Key</th>
                <th>Translation</th>
                <th class="action-td">Actions</th>
            </tr>
            </thead>
            <tbody>
            @php
            $row_index = 0;
            @endphp
            @foreach($translations as $tr_key => $translation)
            <tr>
                <td class="action-td" data-key="{{$row_index}}">{{$tr_key}}</td>
{{--                <td>--}}
{{--                    <input type="text" class="td-input" data-value="{{$row_index}}" data-tr-key="{{$tr_key}}" data-default="{{$translation}}" value="{{$translation}}">--}}
{{--                </td>--}}
                <td style="white-space: pre-wrap" class="td-input" contenteditable="true" data-value="{{$row_index}}" data-tr-key="{{$tr_key}}" data-default="{{$translation}}">{{$translation}}</td>
                <td class="action-td">
                    <button type="button" data-reset="{{$row_index}}" class="btn btn-sm btn-secondary me-2">Reset</button>
                    <button type="button" data-save="{{$row_index}}" class="btn btn-sm btn-primary">Save</button>
                </td>
            </tr>
            @php
                $row_index ++;
            @endphp
            @endforeach
            </tbody>
        </table>

        <div class="mt-5">
            <button class="btn btn-secondary me-2" id="bulk_reset_btn">Bulk Reset</button>
            <button class="btn btn-primary" id="bulk_save_btn">Bulk Save</button>
        </div>
        <hr style="width: 100%">
        <form class="mt-3" action="{{route('admin.translations.put_keys')}}" method="post">
            @csrf
            <button class="btn btn-secondary me-2" id="find_all_keys_btn">Find and put all translations keys from code</button>
            <div>Hint: need, if added to code new translations.</div>
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
            let lang = "{{$lang}}";
            let select_lang = document.querySelector('select[name="lang"]');
            select_lang.addEventListener('input', ()=>{
                // alert(select_lang.value);
                const url = new URL(window.location.href);
                url.searchParams.set('lang', select_lang.value);
                // Go to the new URL (without reloading the page)
                //history.pushState({}, '', url);
                // Or with reloading:
                window.location.href = url.toString();
            });
            let filter_key = document.getElementById('filter_key');
            let filter_val = document.getElementById('filter_val');
            let filter_btn = document.getElementById('filter_btn');
            let filter_reset_btn = document.getElementById('filter_reset_btn');
            filter_btn.addEventListener('click', ()=>{
                const url = new URL(window.location.href);
                url.searchParams.set('key', filter_key.value);
                url.searchParams.set('val', filter_val.value);
                window.location.href = url.toString();
            });
            filter_reset_btn.addEventListener('click', ()=>{
                const url = new URL(window.location.href);
                url.searchParams.delete('key');
                url.searchParams.delete('val');
                filter_key.value = '';
                filter_val.value = '';
                window.location.href = url.toString();
            });
            document.querySelectorAll('.input-close').forEach((btn)=>{
                btn.addEventListener('click', ()=>{
                    let inp = btn.parentElement.querySelector('input');
                    if(inp){
                        inp.value = '';
                    }
                });
            });
            //--------------------------------------------------------------
            let resets = document.querySelectorAll('[data-reset]');
            resets.forEach((reset)=>{
                let row_index = reset.getAttribute('data-reset');
                reset.addEventListener('click', ()=>{
                    let inp = document.querySelector('[data-value="' + row_index + '"]');
                    if(inp){
                        // inp.value = inp.getAttribute('data-default');
                        inp.innerText = inp.getAttribute('data-default');
                    }
                });
            });
            //--------------------------------------------------------------
            let saves = document.querySelectorAll('[data-save]');
            saves.forEach((save_item)=>{
                let row_index = save_item.getAttribute('data-save');
                save_item.addEventListener('click', ()=>{
                    let inp = document.querySelector('[data-value="' + row_index + '"]');
                    if(inp){
                        let key = inp.getAttribute('data-tr-key');
                        // let val = inp.value;
                        let val = inp.innerText;
                        fSaveTranslation(key, val);
                    }
                });
            });
            function fSaveTranslation(key, val) {
                let csrf = "{{ csrf_token() }}";
                let fd = new FormData();
                fd.append('key', key);
                fd.append('val', val);
                fd.append('lang', lang);
                let aj = new XMLHttpRequest();
                aj.open('post', '{{route('admin.translations.save')}}');
                aj.setRequestHeader('X-CSRF-TOKEN', csrf);
                aj.send(fd);
                aj.onreadystatechange = function () {
                    if(this.readyState === 4 && this.status === 200){
                        // let data = this.responseText;
                        // let newJsonData = JSON.parse(data);
                        window.location.reload();
                    }
                };
            }
            //--------------------------------------------------------------
            let bulk_save_btn = document.getElementById('bulk_save_btn');
            bulk_save_btn.addEventListener('click', ()=>{
                let data = {};
                document.querySelectorAll('[data-value]').forEach((inp)=>{
                    let key = inp.getAttribute('data-tr-key');
                    // let val = inp.value;
                    let val = inp.innerText;
                    data[key] = val;
                });
                fBulkSaveTranslations(data);
            });
            function fBulkSaveTranslations(data) {
                let csrf = "{{ csrf_token() }}";
                let fd = new FormData();
                fd.append('data', JSON.stringify(data));
                fd.append('lang', lang);
                let aj = new XMLHttpRequest();
                aj.open('post', '{{route('admin.translations.bulk_save')}}');
                aj.setRequestHeader('X-CSRF-TOKEN', csrf);
                aj.send(fd);
                aj.onreadystatechange = function () {
                    if(this.readyState === 4 && this.status === 200){
                        // let data = this.responseText;
                        // let newJsonData = JSON.parse(data);
                        window.location.reload();
                    }
                };
            }
            //--------------------------------------------------------------
            let bulk_reset_btn = document.getElementById('bulk_reset_btn');
            bulk_reset_btn.addEventListener('click', ()=>{
                document.querySelectorAll('[data-value]').forEach((inp)=>{
                    // inp.value = inp.getAttribute('data-default');
                    inp.innerText = inp.getAttribute('data-default');
                });
            });
            //--------------------------------------------------------------
        });

    </script>
@endpush
