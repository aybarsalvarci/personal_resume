<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                {{-- Auth kullanıyorsan: auth()->user()->name --}}
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">İÇERİK YÖNETİMİ</li>

                <li class="nav-item">
                    <a href="{{ route('admin.projects.index') }}"
                       class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Projeler</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.blogs.index') }}"
                       class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-pen-nib"></i>
                        <p>Blog Yazıları</p>
                    </a>
                </li>

                <li class="nav-header">İLETİŞİM & AYARLAR</li>

                <li class="nav-item">
                    <a href="{{ route('admin.contacts.index') }}"
                       class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Gelen Mesajlar</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.homepage.index') }}"
                       class="nav-link {{ request()->routeIs('admin.homepage.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Anasayfa Düzeni</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}"
                       class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>Genel Ayarlar</p>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <a href="#" class="nav-link text-danger"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Çıkış Yap</p>
                    </a>
                </li>

                <form action="{{route('admin.logout')}}" class="d-none" id="logout-form" method="POST">
                    @csrf
                </form>
            </ul>
        </nav>
    </div>
</aside>
