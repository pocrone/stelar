<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $mail->outboxmail_number }}.pdf</title>


    <style>
        @font-face {
            font-family: 'Arial';
            font-style: normal;
            font-weight: normal;
        }

        @font-face {
            font-family: 'Arial';
            font-style: normal;
            font-weight: bold;
        }

        @page {
            margin: 40px;
            margin-top: 20px;
        }


        body {
            font-family: 'arial';
            font-size: 15px;
        }

        .header {
            font-size: 15px;
        }


        .table,
        .table td,
        .table th {
            border: 1px solid #2b2b2b;
            text-align: left;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            padding: 5px;
        }



        .policy-content .items {
            padding-left: 10px;
        }


        ul {
            margin-bottom: 0px;
            padding-left: 0px;
            padding-inline-start: 0px;
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

        /* width */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #bdbdbd;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgb(95, 95, 95);
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #464d52;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        #watermark {
            position: fixed;
            bottom: 0px;
            color: #d12f2fc4;
            font-size: 13px;
            /** Your watermark should be behind every content**/
            z-index: -1000;
        }

        /*Imported from the source of document_content.css*/
        table.ordered-list tr td.ol-label,
        table.ordered-list tr td.ol-content {
            vertical-align: top;
            text-align: left;
            border: 0px;
        }
    </style>

</head>

<body>
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



                    <div
                        style="margin-top:10px;margin-left:0px;margin-right:10px;margin-bottom:60px;padding-right:10px">
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



</html>
