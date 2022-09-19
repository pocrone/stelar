@extends('guru.layouts.master')

@section('title', 'Sekretaris - Detail Surat Masuk')

@section('navbar')
    @include('guru.layouts.progress-sidebar')
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">Detail Surat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Disposisi Surat</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-md-3">
                                    @if ($data->file != null)
                                        <center>
                                            <h3>Preview</h3>
                                        </center>
                                        <a href="{{ asset('storage/inbox/' . $data->file) }}" target="_blank"
                                            class="btn btn-lg bg-light btn-block ">
                                            <i class="fa fa-file fa-4x pull-center text-info">
                                            </i>
                                        </a>
                                        <a href="{{ asset('storage/inbox/' . $data->file) }}" download
                                            class=" btn-sm
                                        bg-primary text-center text-white mt-2 btn-block ">
                                            Download Surat
                                        </a>
                                        <hr>
                                    @else
                                        <center>
                                            <h4>File Belum Diupload</h4>
                                        </center>
                                        <button disabled class="btn btn-lg bg-light btn-block ">
                                            <i class="fa fa-file fa-4x pull-center text-info">
                                            </i>
                                        </button>
                                        <form action="#" method="post">
                                            @csrf
                                            <input type="file" name="file" id="">
                                            <button type="submit"
                                                class="btn btn-sm bg-primary text-center text-white mt-2 btn-block ">
                                                Upload File
                                            </button>
                                        </form>
                                    @endif

                                </div>
                                <div class="col-md-9">
                                    <table class="table table-responsive">
                                        <tr>
                                            <td width=30%>No Surat</td>
                                            <td width=70% class="text-wrap">{{ $data->mail_number }}</td>
                                        </tr>

                                        <tr>
                                            <td max-width=30%> Penyimpanan</td>
                                            <td width=70% class="text-wrap">{{ $data->mail_location }}</td>
                                        </tr>
                                        <tr>
                                            <td width=30%>Tanggal Surat</td>
                                            <td width=70% class="text-wrap">{{ $data->date }}</td>
                                        </tr>
                                        <tr>
                                            <td width=30%>Pengirim</td>
                                            <td width=70% class="text-wrap">{{ $data->sender }}</td>
                                        </tr>
                                        <tr>
                                            <td width=30%>Sifat Surat</td>
                                            <td width=70% class="text-wrap">{{ $data->mail_attribute }}</td>
                                        </tr>
                                        <tr>
                                            <td width=30%>Perihal</td>
                                            <td width=70% class="text-wrap">{{ $data->mail_about }}</td>
                                        </tr>
                                        <tr>
                                            <td width=30%>Isi Ringkas</td>
                                            <td width=70% class="text-wrap">{{ $data->mail_summary }}</td>
                                        </tr>
                                        <tr>
                                            <td width=30%>Status</td>
                                            <td width=70% class="text-wrap">
                                                @if ($data->status == 0)
                                                    {{ 'Closed' }}
                                                @else
                                                    {{ 'Open' }}
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td width=30%>Klasifikasi</td>
                                            <td width=70% class="text-wrap">{{ $data->class }} -
                                                {{ $data->sub_class }}
                                            </td>
                                        </tr>


                                    </table>
                                </div>

                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="container-fluid mt-100 mb-100">
                                <div id="ui-view">
                                    <div>
                                        <div class="card">

                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <i class="ti-email fa-lg text-primary "></i> <strong> No. Surat :
                                                            {{ $data->mail_number }}</strong>


                                                        @if ($data->disposition_status == 0)
                                                            <button disabled="disabled"
                                                                class="float-right ml-4 btn btn-xs btn-success">Status :
                                                                Masih
                                                                berlangsung
                                                            </button>
                                                        @else
                                                            <button disabled="disabled"
                                                                class="float-right ml-4 btn btn-xs btn-danger">Status :
                                                                Closed
                                                            </button>'
                                                        @endif

                                                    </div>


                                                </div>

                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-4">
                                                    <div class="col-sm-3">

                                                        <div><strong>Tgl. Surat</strong></div>
                                                        <div class="mb-2">{{ $data->date }}</div>
                                                        <div><strong>Sifat Surat</strong></div>
                                                        <div>{{ $data->mail_attribute }}</div>

                                                    </div>

                                                    <div class="col-sm-6    ">

                                                        <div><strong>Pengirim</strong></div>
                                                        <div class="mb-2">{{ $data->sender }}</div>

                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div><strong>Perihal</strong></div>
                                                        <div class="text-justify">{{ $data->mail_about }}</div>

                                                    </div>

                                                </div>

                                                <div class="row mb-2">

                                                    <div class="col-12">
                                                        <div> <strong>Isi Ringkas Surat</strong></div>
                                                        <p class="text-wrap">
                                                            {{ $data->mail_summary }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="table-responsive-sm">
                                                    <table class="table table-bordered dispos_datatable"
                                                        style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th width=10% class="center">No.</th>
                                                                <th width=10% class="text-wrap">Tanggal</th>
                                                                <th width=10% class="text-wrap">Dari</th>
                                                                <th>Instruksi / Informasi</th>
                                                                <th width=10%>Diteruskan ke</th>

                                                            </tr>
                                                        </thead>

                                                    </table>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customjs')
    <script>
        $(document).ready(function() {
            var table = $('.dispos_datatable').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{ route('secretary_dispositon_progress', $data->id) }}",
                    "dataType": "json",

                },
                "columns": [{
                        "data": null,
                        "searchable": false,
                        "orderable": false,
                        "targets": 0,
                    },
                    {
                        "data": "date_dispo"
                    },
                    {
                        "data": "sender_dispo"
                    },

                    {
                        "data": "instruction"
                    },
                    {
                        "data": "recevier"
                    },


                ],
                order: [
                    [1, 'asc']
                ],

            });
            table.on('draw.dt', function() {
                var info = table.page.info();
                table.column(0, {
                    search: 'applied',
                    order: 'applied',
                    page: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1 + info.start;
                });
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#text_disposisi').summernote({
                'height': '200',
                toolbar: false,
                placeholder: 'Tuliskan Perintah Konsep Surat'
            });
        });
    </script>
@endsection
