@extends('siswa.layouts.master')

@section('title', 'Arsiparis | Lihat Surat')

@section('navbar')
    @include('siswa.layouts.archivist-sidebar')
@stop
<style>
    @page {
        margin: 40px;
        margin-top: 20px;
    }

    .text-center {
        text-align: center;
    }

    .bold {
        font-weight: bold;
    }

    .small {
        font-size: small;
    }

    .border {
        border: 1px solid black
    }

    .p-1 {
        padding: 3px;
    }

    .top {
        vertical-align: top;
    }

    div>p {
        text-align: justify;
        text-indent: 0px;
        line-height: 1.5em;
        margin-top: 1px;
        margin: 8px;
        margin-left: 0px;
        padding-left: 0px;

    }

    ul {
        margin-bottom: 0px;
        padding-left: 0px;
        padding-inline-start: 0px;
    }

    ul>li {
        list-style-position: inside;
        list-style-type: none
    }

    ol {
        margin-bottom: 0px;
        list-style-position: inside;
        padding-left: 10px;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <label class='badge badge-secondary'>Koreksi Surat</label>
                    <hr>
                    @if (!empty($status_koreksi))
                        <p>Revisi Selesai</p>
                    @else
                        <p>Masih Perlu Revisi</p>
                    @endif
                    <button type="submit" data-toggle="modal" data-target="#addKoreksi"
                        class="btn btn-sm bg-success text-center text-white btn-block ">
                        Lihat Riwayat Revisi Surat
                    </button>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <label class='badge badge-secondary'>Klasifikasi</label>

                    <hr>
                    @if (!empty($mail->class))
                        {{ $mail->class }} - {{ $mail->sub_class }}
                    @else
                        <p> Klasifikasi Belum Diatur</p>
                    @endif
                    <button data-toggle="modal" data-target="#set_klasifikasi"
                        class="btn btn-sm bg-warning text-center text-white mt-2 btn-block mt-4">
                        Atur Klasifikasi Surat
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <label class='badge badge-secondary'>Status TTD Surat</label>
                    <hr>
                    @if ($mail->autograph_status == 1)
                        <p>Sudah TTD oleh :</p>
                        <p>Pimpinan - {{ $ttd->name }}</p>
                    @else
                        <p>Belum Disetujui</p>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <label class='badge badge-secondary'>Lampiran Surat</label>
                    <hr>
                    @if ($mail->file != 'default.png')
                        <center>
                            <h3>Preview</h3>
                        </center>
                        <a href="{{ asset('storage/outbox/' . $mail->file) }}" target="_blank"
                            class="btn btn-lg bg-light btn-block ">
                            <i class="fa fa-file fa-4x pull-center text-info">
                            </i>
                        </a>
                        <a href="{{ asset('storage/outbox/' . $mail->file) }}" download
                            class=" btn-sm
                    bg-primary text-center text-white mt-2 btn-block ">
                            Download Surat
                        </a>
                        <hr>
                        <form action="{{ route('file_outbox', $mail->outboxID) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" id="">
                            <button type="submit"
                                class="btn btn-sm bg-primary text-center text-white mb-5 mt-2 btn-block ">
                                Perbarui File
                            </button>
                        </form>
                    @else
                        <center>
                            <h4>File Belum Diupload</h4>
                        </center>
                        <button disabled class="btn btn-lg bg-light btn-block ">
                            <i class="fa fa-file fa-4x pull-center text-info">
                            </i>
                        </button>
                        <form action="{{ route('file_outbox', $mail->outboxID) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" id="">
                            <button type="submit"
                                class="btn btn-sm bg-primary text-center text-white mt-2 mb-5 btn-block ">
                                Upload File
                            </button>
                        </form>
                    @endif

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <label class='badge badge-secondary'>Lokasi Penyimpanan</label>
                    <hr>
                    @if ($mail->save_location == null)
                        <p>Belum Diatur</p>
                    @else
                        {{ $mail->save_location }}
                    @endif
                    <button data-toggle="modal" data-target="#set_lokasi"
                        class="btn btn-sm bg-success text-center text-white mt-2 btn-block ">
                        Atur Lokasi Penyimpanan
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <label class='badge badge-secondary'>Retensi Surat</label>
                    <hr>
                    @if (empty($mail->active_year))
                        <p>Belum Diatur</p>
                    @else
                        <table class="table table-responsive">
                            <tr>
                                <td width=30%>Retensi Tahun Aktif Surat</td>
                                <td width=70% class="text-wrap">{{ $mail->active_year }}</td>
                            </tr>

                            <tr>
                                <td max-width=30%> Retensi Tahun Inaktif Surat</td>
                                <td width=70% class="text-wrap">{{ $mail->inactive_year }}</td>
                            </tr>
                            <tr>
                                <td width=30%>Status Retensi</td>
                                <td width=70% class="text-wrap">
                                    @if ($mail->status_retention == 1)
                                        {{ 'Ditinjau Kembali' }}
                                    @elseif ($mail->status_retention == 2)
                                        {{ 'Permanen' }}
                                    @else
                                        {{ 'Musnah' }}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    @endif
                    <button data-toggle="modal" data-target="#set_retensi"
                        class="btn btn-sm bg-info text-center text-white mt-2 btn-block ">
                        Atur Retensi
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <form action="{{ route('arc_delete_outbox', $mail->outboxID) }}" method="POST">
                @csrf
                <a href="{{ route('exportPDF', $mail->outboxID) }}" target="_blank"
                    class="btn btn-primary btn-sm mb-3 mr-3">Cetak
                    Surat</a>
                <a href="{{ route('arc_edit_mail', $mail->outboxID) }}" class="btn btn-success btn-sm mb-3 mr-3">Edit
                    Surat</a>

                <button type="submit" class="btn btn-danger btn-sm mb-3 mr-3">Delete Surat</button>
            </form>

            <div class="card">
                <div class="card-body">


                    <table>
                        <tr>
                            @if (!empty($mail->logo))
                                <td width="205px"> <img width="100px"
                                        src="{{ asset('storage/logo_outbox/' . $mail->logo) }}" alt="">
                                </td>
                            @else
                                <td width="205px"> </td>
                            @endif
                            <td>
                                <table>
                                    <tr>
                                        <td class="text-center">
                                            <h3 style="margin:0px">
                                                <?= $mail->main_institution ?>
                                            </h3>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="text-center bold">
                                            <h2 style="margin:0px">
                                                <?= $mail->name_institution ?></h2>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class=" text-center "><?= $mail->address_institution ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center small"> Telp : <?= $mail->phone_institution ?> | Email :
                                            <?= $mail->email_institution ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                    </table>

                    <hr style="border: 2px solid black;">
                    <table style="width:100%;padding-top:10px">
                        <tr>
                            <td style="font-size: 12pt">Nomor &nbsp;&nbsp;&nbsp;&nbsp;: <?= $mail->outboxmail_number ?></td>
                            <td style="text-align: right;padding-right:0px">Tanggal : <?= tgl_indo($mail->mail_date) ?>
                            </td>


                        </tr>
                        <tr>
                            <td>Lampiran : <?= $mail->attachment ?></td>
                        </tr>
                        <tr>
                            <td>Perihal &nbsp;&nbsp;&nbsp; : <?= $mail->mail_about ?></td>
                        </tr>
                    </table>


                    <table style="width:100%;padding-top:30px;margin-top:40px">

                        <tr>
                            <td>
                                <?= $mail->mail_recevier ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?= $mail->mail_destination ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?= $mail->city_destination ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-top :30px"><?= $mail->preambule ?></td>
                        </tr>
                    </table>



                    <div style="margin-top:10px;margin-left:0px;margin-right:0px;margin-bottom:100px;">
                        <?= $mail->mail_detail ?>
                    </div>


                    <table style="width:100%;margin-top:50px">

                        <tr>
                            <td style="text-align: left;padding-left:470px"><?= $mail->closing_sentence ?></td>
                        </tr>
                        @if ($mail->autograph_status == 1)
                            <tr>
                                <td style="text-align: left;padding-left:470px;">
                                    <img width="100" src="{{ asset('storage/autograph/' . $ttd->autograph) }}"
                                        alt="">
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td style="text-align: left;padding-left:470px;padding-top:80px"></td>
                            </tr>
                        @endif


                        <tr>
                            <td style="text-align: left;padding-left:470px;">
                                <?= $mail->officer ?> </td>
                        </tr>


                        <tr>
                            <td style="text-align: left;padding-left:470px">
                                <?= $mail->mail_officer ?> </td>
                        </tr>

                    </table>
                    <div style="margin-top:10px;margin-left:0px;margin-right:0px;margin-bottom:100px;">
                        Tembusan :
                        <?= $mail->notation ?>
                    </div>

                    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->
                    <?php
                    function tgl_indo($tanggal)
                    {
                        # code...
                    
                        $bulan = [
                            1 => 'Januari',
                            'Februari',
                            'Maret',
                            'April',
                            'Mei',
                            'Juni',
                            'Juli',
                            'Agustus',
                            'September',
                            'Oktober',
                            'November',
                            'Desember',
                        ];
                        $pecahkan = explode('-', $tanggal);
                    
                        // variabel pecahkan 0 = tanggal
                        // variabel pecahkan 1 = bulan
                        // variabel pecahkan 2 = tahun
                    
                        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addKoreksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Riwayat Koreksi Surat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <table class="table table-responsive">
                            <thead>
                                <th width=20px>No</th>
                                <th>Tanggal</th>
                                <th>Instruksi</th>
                                <th>Status Koreksi</th>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($data_koreksi as $data)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $data->date }}</td>
                                        <td>{{ $data->isi_koreksi }}</td>
                                        <td>
                                            @if ($data->status_koreksi == 0)
                                                Masih perlu Revisi
                                            @else
                                                Disetujui
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $no++; ?>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <hr>


                </div>
                <div class="modal-footer">


                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="set_klasifikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">

        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atur Klasifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('set_class_archivist_out', $mail->outboxID) }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group ">
                            <label for="exampleFormControlSelect1" class="col-sm-4 col-form-label">Klasifikasi
                                Utama</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="exampleFormControlSelect1" name="class" required>
                                    <option value="">Pilih Klasifikasi </option>
                                    @foreach ($classification as $row)
                                        <option value="{{ $row->id }}">{{ $row->class }} - {{ $row->sub_class }}

                                        </option>
                                    @endforeach


                                </select>
                            </div>
                        </div>


                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="set_retensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">

        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atur Retensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('set_retention_archivist_out', $mail->outboxID) }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group ">
                            <label for="exampleFormControlSelect1" class="col-sm-4 col-form-label">Tahun Aktif
                            </label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="active_year" id="">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="exampleFormControlSelect1" class="col-sm-4 col-form-label">Tahun Inaktif
                            </label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="inactive_year" id="">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="exampleFormControlSelect1" class="col-sm-4 col-form-label">Status Retensi
                            </label>
                            <div class="col-sm-10">
                                <select class="form-control" id="exampleFormControlSelect1" name="status_retention"
                                    required>
                                    <option value="">Pilih Klasifikasi </option>
                                    <option value="1">Ditinjau Kembali </option>
                                    <option value="2">Permanen </option>
                                    <option value="3">Musnah </option>
                                </select>
                            </div>
                        </div>


                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="set_lokasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">

        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atur Lokasi Penyimpanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('set_location_archivist_out', $mail->outboxID) }}" method="post">
                        {{ csrf_field() }}

                        <div class="col-sm-10">
                            <div class="form-group ">
                                <label for="exampleFormControlSelect1" class="col-sm-4 col-form-label">Lokasi
                                    Penyimpanan
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="mail_location" id="">
                                </div>
                            </div>
                        </div>



                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('jquery')
