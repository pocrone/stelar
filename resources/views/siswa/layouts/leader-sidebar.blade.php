<nav class="bottom-navbar">
    <div class="container">
        <ul class="nav page-navigation" style="justify-content:center">
            <li class="nav-item pr-5">
                <a class="nav-link" href="{{ route('leaderdashboard') }}">
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
                            <a class="nav-link" href="{{ route('mailconcept') }}">Konsep Surat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('autograph') }}">Data TTD</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item pr-3">
                <a class="nav-link" href="{{ route('inbox') }}">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Surat Masuk</span>
                </a>
            </li>
            <li class="nav-item pr-3">
                <a class="nav-link" href="{{ route('mail_correct') }}">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Koreksi Surat Keluar</span>
                </a>
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
                            <a class="nav-link" href="{{ route('inbox_retention') }}">Surat Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('outbox_retention') }}">Surat Keluar</a>
                        </li>

                    </ul>
                </div>
            </li>

        </ul>
    </div>
</nav>
