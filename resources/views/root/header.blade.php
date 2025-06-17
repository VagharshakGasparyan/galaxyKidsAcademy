<header style="border: 1px solid black">
    <h1 style="text-align: center">Header</h1>
    @if(request()->route()->getName() == 'home')
        <div>Home</div>
    @endif
</header>
