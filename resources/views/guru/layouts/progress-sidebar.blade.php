<nav class="bottom-navbar">
    <div class="container">

        <ul class="nav page-navigation" style="justify-content:center">
            <li class="nav-item pr-5">
                <!-- Example single danger button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-danger btn-lg dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                        Kelompok {{ $group->groupname }}
                    </button>
                    <div class="dropdown-menu">
                        @foreach ($group_list as $row)
                            <a class="dropdown-item"
                                href="{{ route('progress', ['group_id' => $row->id]) }}">{{ $row->groupname }}</a>
                        @endforeach


                    </div>
                </div>
            </li>
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
                            <a class="nav-link"
                                href="{{ route('leader_mail_correct', ['group_id' => $group_id]) }}">Koreksi
                                Surat Keluar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('leader_inbox_retention', ['group_id' => $group_id]) }}">Retensi
                                Surat
                                Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('leader_outbox_retention', ['group_id' => $group_id]) }}">Retensi
                                Surat
                                Keluar</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item pt-1">
                <a href="#" class="nav-link">
                    <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                    <span class="menu-title">Sekretaris</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul class="submenu-item">

                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('data_concept_progress', ['group_id' => $group_id]) }}">Konsep
                                Surat </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('inbox_secretary_progress', ['group_id' => $group_id]) }}">Surat
                                Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('sec_outbox_progress', ['group_id' => $group_id]) }}">Surat
                                Keluar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('inbox_retention_sec_progress', ['group_id' => $group_id]) }}">Retensi
                                Surat
                                Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('outbox_retention_sec_progress', ['group_id' => $group_id]) }}">Retensi
                                Surat
                                Keluar</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item pt-1">
                <a href="#" class="nav-link">
                    <i class="mdi mdi-monitor-dashboard menu-icon"></i>
                    <span class="menu-title">Arsiparis</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('secretary_classification_progress', ['group_id' => $group_id]) }}">Klasifikasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('inbox_archive_progress', ['group_id' => $group_id]) }}">Surat
                                Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('arc_outbox_progress', ['group_id' => $group_id]) }}">Surat
                                Keluar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('inbox_retensi_archive', ['group_id' => $group_id]) }}">Retensi
                                Surat
                                Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('outbox_retensi_archive', ['group_id' => $group_id]) }}">Retensi
                                Surat
                                Keluar</a>
                        </li>

                    </ul>
                </div>
            </li>






        </ul>


    </div>
</nav>
