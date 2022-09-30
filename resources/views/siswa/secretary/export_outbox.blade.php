<style>
    @page {
        margin: 40px;
        margin-top: 0px;
        font-size: :14px;
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

<title>
    {{ $mail->outboxmail_number }}.pdf
</title>

<body>


    @section('content')
        <div class="row">

            <div class="col-md-8">

                <div class="card">
                    <div class="card-body">


                        <table>

                            <tr>
                                @if (!empty($mail->logo))
                                    <td width="205px">
                                        {{-- <img width="100px" 
                                        src="{{ public_path('storage/logo_outbox/' . $mail->logo) }}" alt=""> --}}
                                    </td>
                                @else
                                    <td width="205px"> </td>
                                @endif
                                <td>
                                    <table class="text-center">

                                        <tr>
                                            <td class="text-center" style="text-align: center">
                                                <h3 style="margin:0px;margin:auto">
                                                    <?= $mail->main_institution ?>
                                                </h3>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="text-center bold" style="text-align: center">
                                                <h2 style="margin:0px">
                                                    <?= $mail->name_institution ?></h2>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class=" text-center "style="text-align: center">
                                                <?= $mail->address_institution ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center small" style="text-align: center"> Telp :
                                                <?= $mail->phone_institution ?> | Email :
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
                                <td style="font-size: 12pt">Nomor &nbsp;&nbsp;&nbsp;&nbsp;: <?= $mail->outboxmail_number ?>
                                </td>
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


                        <table style="width:100%;padding-top:30px;margin-top:20px">

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



                        <div style="margin-top:10px;margin-left:0px;margin-right:0px;margin-bottom:60px;">
                            <?= $mail->mail_detail ?>
                        </div>


                        <table style="width:100%;">

                            <tr>
                                <td style="text-align: left;padding-left:520px"><?= $mail->closing_sentence ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;padding-left:520px">
                                    <?= $mail->mail_officer ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;padding-left:520px;padding-top:80px">
                                    <?= $mail->officer ?> </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;padding-left:520px">
                                    <?= $mail->identity_number ?> </td>
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
    </body>
