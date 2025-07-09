@php
    use App\Models\MyConfig;
    $top_section_image = MyConfig::where('group_key', 'site')->where('key', 'top_section_image')->first();
@endphp
<div class="hero-section" style=" @if($top_section_image->value1 ?? null) background-image: url('{{asset('storage/' . $top_section_image->value1)}}'); @endif ">
    <div class="hero-content">
        <h1>{{__('top_section.text')}}</h1>
        <a href="{{route('contact_us')}}" class="btn">{{__('top_section.button_text')}}</a>
    </div>
</div>
