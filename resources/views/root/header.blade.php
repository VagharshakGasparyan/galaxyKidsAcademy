@php
$mainMenu = \App\Models\MainMenu::whereNull('parent_id')->orderBy('order', 'asc')->get();
@endphp
<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }
    .dropdown a{
        display: block;
        padding: 10px;
        text-decoration: none;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding: 12px 16px;
        z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>
<header style="border: 1px solid black">
    <h1 style="text-align: center">Header</h1>
    @if(request()->route()->getName() == 'home')
        <div>Home</div>
    @endif
    <div style="display: flex;justify-content: center;">
        @foreach($mainMenu as $menuItem)
            @include('root.main_menu_item', ['item' => $menuItem])
        @endforeach
    </div>
</header>
