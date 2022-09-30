@extends('guru.layouts.master')

@section('title', 'Sekretaris - Retensi Surat Masuk')

@section('navbar')
    @include('guru.layouts.progress-sidebar')
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="card w-100">
                <div class="card-header">Sekretaris - Retensi Surat Masuk</div>
                <div class="card-body">
                    <table class="table  inbox_retention" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="bg-light">#</th>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Tanggal</th>
                                <th>Pengirim</th>
                                <th>Perihal</th>

                            </tr>

                        </thead>

                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection


@section('customjs')
    <script>
        function status_retention(d) {
            if (d == 1)
                return 'Ditinjau Kembali';
            else if (d == 2)
                return 'Permanen';
            else if (d == 2)
                return 'Musnah';
            else
                return 'Belum Diatur';
        }

        function format(d) {
            if (d.class == null)
                d.class = "Belum Diatur";
            if (d.sub_class == null)
                d.sub_class = "Belum Diatur";
            if (d.mail_location == null)
                d.mail_location = "Belum Diatur";
            if (d.active_year == null)
                d.active_year = "Belum Diatur";
            if (d.inactive_year == null)
                d.inactive_year = "Belum Diatur";
            return (
                'Klasifikasi : ' +
                d.class +
                '-' +
                d.sub_class +
                '<hr>' +
                'Lokasi Penyimpanan : ' +
                d.mail_location +
                '<hr>' +
                'Tahun Aktif : ' +

                d.active_year +

                '<hr>' +
                'Tahun Inaktif : ' + d.inactive_year +

                '<hr>' +
                'Status : ' + status_retention(d.retention_status)
            );
        }

        $(document).ready(function() {
            var detailRows = [];
            var table = $('.inbox_retention').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{ route('inbox_retention_sec_progress', $group_id) }}",
                    "dataType": "json",

                },

                "columns": [{

                        class: 'details-control btn-secondary',
                        orderable: false,
                        data: null,
                        defaultContent: ''
                    },

                    {
                        "data": null,
                        "searchable": false,
                        "orderable": false,
                        "targets": 0,
                    },
                    {
                        "data": "mail_number"
                    },
                    {
                        "data": "date"
                    },
                    {
                        "data": "sender"
                    },
                    {
                        "data": "mail_about"
                    },

                ],
                order: [
                    [2, 'asc']
                ],

            });
            table.on('draw.dt', function() {
                var info = table.page.info();
                table.column(1, {
                    search: 'applied',
                    order: 'applied',
                    page: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1 + info.start;
                });
            });

            $('.inbox_retention tbody').on('click', 'tr td.details-control', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var idx = detailRows.indexOf(tr.attr('id'));

                if (row.child.isShown()) {
                    tr.removeClass('details');
                    row.child.hide();

                    // Remove from the 'open' array
                    detailRows.splice(idx, 1);
                } else {
                    tr.addClass('details');
                    row.child(format(row.data())).show();

                    // Add to the 'open' array
                    if (idx === -1) {
                        detailRows.push(tr.attr('id'));
                    }
                }
            });

            table.on('draw', function() {
                detailRows.forEach(function(id, i) {
                    $('#' + id + ' td.details-control').trigger('click');
                });
            });

        });
    </script>




@endsection
