<aside class="admin-sidebar">
    <a href="{{route('admin.dashboard')}}" class="admin-sidebar-item @if(request()->route()->getName() == 'admin.dashboard') active @endif"><i class="fa fa-home me-2"></i>Dashboard</a>
    <a href="{{route('admin.pages')}}" class="admin-sidebar-item @if(str_starts_with(request()->route()->getName(), 'admin.pages')) active @endif"><i class="fa fa-files-o me-2"></i>Pages</a>
    <a href="{{route('admin.photos')}}" class="admin-sidebar-item @if(str_starts_with(request()->route()->getName(), 'admin.photos')) active @endif"><i class="fa fa-photo me-2"></i>Photos</a>
    <a href="{{route('admin.main_menu')}}" class="admin-sidebar-item @if(str_starts_with(request()->route()->getName(), 'admin.main_menu')) active @endif"><i class="fa fa-ellipsis-h me-2"></i>Main Menu</a>
    <a href="{{route('admin.settings')}}" class="admin-sidebar-item @if(str_starts_with(request()->route()->getName(), 'admin.settings')) active @endif"><i class="fa fa-gears me-2"></i>Settings</a>
    <a href="{{route('admin.translations')}}" class="admin-sidebar-item @if(str_starts_with(request()->route()->getName(), 'admin.translations')) active @endif"><i class="fa fa-flag me-2"></i>Translations</a>
    <a href="{{route('admin.users')}}" class="admin-sidebar-item @if(str_starts_with(request()->route()->getName(), 'admin.users')) active @endif"><i class="fa fa-user me-2"></i>Users</a>
    <a href="{{route('admin.logs')}}" class="admin-sidebar-item @if(str_starts_with(request()->route()->getName(), 'admin.logs')) active @endif"><i class="fa fa-list-alt me-2"></i>Logs</a>

</aside>
<script>
    fSetSidebar();
    function fSetSidebar() {
        let admin_header_bar = document.getElementById('admin_header_bar');
        let admin_sidebar = document.querySelector('.admin-sidebar');
        if (admin_header_bar && admin_sidebar){
            let sidebar_open = localStorage.getItem('sidebar_open') ?? '1';
            if(sidebar_open === '1'){
                admin_sidebar.classList.remove('admin-sidebar-hide');
            }else{
                admin_sidebar.classList.add('admin-sidebar-hide');
            }
            setTimeout(()=>{
                admin_sidebar.style.transition = 'margin-left 300ms, margin-right 300ms';//transition: margin-left 300ms;
            }, 100);
            admin_header_bar.addEventListener('click', ()=>{
                let sidebar_open = localStorage.getItem('sidebar_open') ?? '1';
                // admin_sidebar.classList.toggle('admin-sidebar-hide');
                if(sidebar_open === '1'){
                    admin_sidebar.classList.add('admin-sidebar-hide');
                    localStorage.setItem('sidebar_open', '0');
                }else{
                    admin_sidebar.classList.remove('admin-sidebar-hide');
                    localStorage.setItem('sidebar_open', '1');
                }
            });
        }
    }
</script>
