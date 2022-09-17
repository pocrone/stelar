<nav class="bottom-navbar">
    <div class="container">
        <ul class="nav page-navigation bg-info" style="justify-content:center">
            <li class="nav-item pr-5">
                <a class="nav-link" href="#">
                    <span>Progress Kelompok: {{ $group->groupname }}</span>
                </a>
            </li>


        </ul>
        <ul class="nav page-navigation" style="justify-content:center">
            <li class="nav-item pr-5">
                <a class="nav-link" href="{{ route('progress', ['group_id' => $group_id]) }}">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Data Kelompok</span>
                </a>
            </li>
            <li class="nav-item pt-1">
                <a href="#" class="nav-link">
                    <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                    <span class="menu-title">Pimpinan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('leader_concept', ['group_id' => $group_id]) }}">Konsep
                                Surat </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('leader_inbox', ['group_id' => $group_id]) }}">Surat
                                Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/typography.html">Lihat Tugas</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item pr-5">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Sekretaris</span>
                </a>
            </li>
            <li class="nav-item pr-5">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="mdi mdi-compass-outline menu-icon"></i>
                    <span class="menu-title">Arsiparis</span>
                </a>
            </li>
            {{-- <li class="nav-item pt-1">
                <a href="#" class="nav-link">
                    <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                    <span class="menu-title">Materi</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/buttons.html">Buat </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/dropdowns.html">Materi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/ui-features/typography.html">Lihat Tugas</a>
                        </li>
                    </ul>
                </div>
            </li> --}}






        </ul>

    </div>
</nav>
