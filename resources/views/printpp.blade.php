<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            margin: 0;
            padding: 20px;
            padding-right: 20px;
            transform: scale(0.7);
            /* Scale down the content */
            transform-origin: top left;
        }

        .di {
            text-align: center;
        }

        @page {
            size: A4 portrait;
            margin: 0;
        }

        .page {
            width: 100%;
            height: 50%;
            /* Reduce the height to fit two pages */
            box-sizing: border-box;
            padding: 10px;
            position: relative;
        }

        .container {
            /* width: 100%; */
            width: 1050px;
            height: 100%;
            box-sizing: border-box;
            padding: 10px;
            position: relative;
        }

        .header-table,
        .info-table,
        .main-table,
        .sign-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            /* Remove margin to remove gaps between tables */
        }

        .header-table td,
        .info-table td,
        .main-table th,
        .main-table td,
        .sign-table td {
            border: 1px solid black;
            padding: 4px;
            /* Reducing padding to decrease height */
            /* text-align: center; */
            vertical-align: middle;
        }

        .def {
            text-align: center;
            vertical-align: middle;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            /* No margin to remove vertical gap */
        }

        .main-table th,
        .main-table td {
            padding: 8px;
        }

        .sign-table td {
            padding: 10px;
        }

        .ttd {
            width: 100px;
            height: 60px;
            text-align: center;
        }

        .ttd-name {
            text-align: center;
        }

        p {
            text-align: center;
            font-size: 12px;
            margin: 0;
        }

        .footer-table {
            border-collapse: collapse;
            border: 1px solid black;
        }

        img {
            width: 85px;
            height: 60px;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="container">
            <table class="header-table">
                <tr>
                    <td rowspan="3" colspan="25%" class="def">IT-MMNR-GROUP</td>
                    <td rowspan="3" colspan="50%" class="def">PERMINTAAN PEMBELIAN INTERNAL - PERALATAN IT</td>
                    <td colspan="25%">Form : MMNR-IT-SUPPORT-004</td>
                </tr>
                <tr>
                    <td colspan="25%">Rev : 02</td>
                </tr>
                <tr>
                    <td colspan="25%">Date : 20-02-2024</td>
                </tr>
            </table>
            <table class="info-table">
                <tr>
                    <td style="width: 350px;">No PPI - Perangkat IT</td>
                    <td colspan="2">{{$pp->nomor}}</td>
                </tr>
                <tr>
                    <td>Nama pengguna</td>
                    <td colspan="2">{{$pp->user->name}}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td colspan="2">{{$pp->user->jabatan}}</td>
                </tr>
                <tr>
                    @php
                    $startDate = $pp->user->tahun_masuk;
                    $now = new DateTime();

                    $interval = $startDate->diff($now);
                    $years = $interval->y;
                    $months = $interval->m;
                    $lamaBekerja = "{$years} tahun dan {$months} bulan";
                    @endphp

                    <td>Lama bekerja</td>
                    <td colspan="2">{{$lamaBekerja}}</td>
                </tr>
                <tr>
                    <td>Pembelian untuk PT</td>
                    <td colspan="2">{{$pp->pt_tujuan->name}}</td>
                </tr>
                <tr>
                    <td>Alasan Permintaan</td>
                    <td colspan="2"> {{$pp->alasan}} </td>
                </tr>
            </table>

            <!-- Main Table with 5 rows -->
            <table class="main-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama & Spesifikasi Barang</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Tgl Diperlukan</th>
                        <th>Keterangan IT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pp->barang->reverse() as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td> <!-- Row number -->
                        <td>{{ $data->nama ?? 'DISI OLEH IT' }}</td>
                        <td>{{ $data->jumlah ?? 'DISI OLEH IT' }}</td>
                        <td>{{ $data->satuan ?? 'DISI OLEH IT' }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tanggal_diperlukan)->format('d-m-Y') ?? 'DISI OLEH IT' }}</td>
                        <td>{{ $data->keterangan_it ?? 'DISI OLEH IT' }}</td>
                    </tr>
                    @endforeach

                    @for($i = count($pp->barang); $i < 5; $i++)
                        <tr>
                        <td style="color: white;">.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                        @endfor
                </tbody>
            </table>

            <!-- Sign Table with fixed column size -->
            <table class="sign-table">
                <tr>
                    <td class="di">Diminta</td>
                    <td class="di">Diketahui</td>
                    <td class="di">Disetujui</td>
                </tr>
                <tr>
                    <td class="ttd">
                        @if ($pp->user->ttd)
                        <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $pp->user->ttd))); ?>">
                        @endif
                    </td>
                    <td class="ttd">
                        @if ($pp->approval->ttd && ($pp->status == 'acc1' || $pp->status == 'acc-2' || $pp->status == 'acc2'))
                        <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $pp->approval->ttd))); ?>">
                        @endif
                    </td>
                    <td class="ttd">
                        @if($pp->user->department->leader->ttd && $pp->status == 'acc2')
                        <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $pp->user->department->leader->ttd))); ?>">
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="ttd-name">
                        @if($pp->user)
                        {{ $pp->user->name }}
                        @endif
                    </td>
                    <td class="ttd-name">
                        @if($pp->approval && ($pp->status == 'acc1' || $pp->status == 'acc-2' || $pp->status == 'acc2'))
                        {{ $pp->approval->name }}
                        @endif
                    </td>
                    <td class="ttd-name">
                        @if ($pp->user->department->leader && $pp->status == 'acc2')
                        {{$pp->user->department->leader->name}}
                        @endif
                    </td>
                </tr>
            </table>

            <table class="footer-table">
                <tr>
                    <td>
                        <p>** Berdasarkan Kebijakan IT Indoprima Group Rev.0 date 02 dec 2013</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>