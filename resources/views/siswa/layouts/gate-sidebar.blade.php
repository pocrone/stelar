<nav class="bottom-navbar">
    <div class="container">
        <ul class="nav page-navigation" style="justify-content:center">
            <li class="nav-item pr-5">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item pt-1">
                <a href="{{ route('std_list_class') }}" class="nav-link">
                    <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                    <span class="menu-title">Kelas</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/buttons.html">Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/dropdowns.html">Materi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/typography.html">Lihat Tugas</a>
                        </li>
                    </ul>
                </div>
            </li>






        </ul>
    </div>
</nav>
