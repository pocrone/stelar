<nav class="bottom-navbar">
    <div class="container">
        <ul class="nav page-navigation" style="justify-content:center">
            <li class="nav-item pr-5">
                <a class="nav-link" href="{{ route('archivist_dashboard') }}">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="#" class="nav-link">
                    <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                    <span class="menu-title">Master Data</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('inbox_archivist') }}">Surat Masuk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('outbox_data_arc') }}">Surat Keluar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('secretary_classification') }}">Buat Klasifikasi
                                Surat</a>
                        </li>


                    </ul>
                </div>
            </li>


            <li class="d-flex nav-item pr-3">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Daftar Retensi</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('inbox_retention_arc') }}">Surat Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('outbox_retention_arc') }}">Surat Keluar</a>
                        </li>

                    </ul>
                </div>
            </li>

        </ul>
    </div>
</nav>
