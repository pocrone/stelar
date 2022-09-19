<nav class="bottom-navbar">
    <div class="container">
        <ul class="nav page-navigation" style="justify-content:center">
            <li class="nav-item pr-5">
                <a class="nav-link" href="{{ route('secretary_dashboard') }}">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('std_list_class') }}" class="nav-link">
                    <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                    <span class="menu-title">Master Data</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('secretary_classification') }}">Buat Klasifikasi
                                Surat</a>
                        </li>


                    </ul>
                </div>
            </li>
            <li class="nav-item pr-3">
                <a class="nav-link" href="{{ route('inbox_secretary') }}">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Surat Masuk</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('std_list_class') }}" class="nav-link">
                    <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                    <span class="menu-title">Olah Surat Keluar</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('data_concept') }}">Baca Konsep</a>
                        </li>
                    </ul>
                    <ul class="submenu-item">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('outbox_data') }}">Daftar Surat Keluar</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="d-flex nav-item pr-3">
                <a class="nav-link" href="#">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Daftar Retensi</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('inbox_retention_sec') }}">Surat Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('outbox_retention_sec') }}">Surat Keluar</a>
                        </li>

                    </ul>
                </div>
            </li>

        </ul>
    </div>
</nav>
