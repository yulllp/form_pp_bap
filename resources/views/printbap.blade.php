<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print BAP</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            margin: 0;
            font-size: 8.5;
            /* font-size: 12; */
        }

        .container {
            width: 750px;
            height: 100%;
            /* transform: scale(0.73); */
            transform-origin: top left;

            box-sizing: border-box;
            padding-left: 10px;
            /* padding-top: 0.1px; */
            position: relative;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
            /* Ensure equal column widths */
        }

        table td,
        th {
            border: 1px solid black;
            padding: 4px;
            vertical-align: middle;
            box-sizing: border-box;
        }


        @page {
            size: A4 portrait;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .header-table {
            width: 100%;
        }

        .header-table td,
        .header-table th {
            text-align: center;
        }

        img {
            height: 100px;
            width: 100px;
        }

        .ttd {
            height: 50px;
            width: 50px;
        }

        .page-break {
            page-break-after: always;
        }

        .align-center {
            text-align: center;
        }

        .qrContainer {
            transform-origin: top left;
            height: 133px;
            width: 350px;
            font-size: 10;
            box-sizing: border-box;
            padding: 50px;
            position: relative;
        }

        .qrimg {
            width: 65px;
            height: 65px;
            object-fit: contain;

        }

        .no-space {
            padding: 0px;
            margin: 0px;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="container">
            <table class="header-table">
                <tr>
                    <td rowspan="3" colspan="25%">IT SUPPORT-MMNR-GROUP</td>
                    <td rowspan="3" colspan="50%">BERITA ACARA PENGAKUAN DAN PENERIMAAN ASET</td>
                    <td colspan="25%">Form: MMNR-IT-SUPPORT-001</td>
                </tr>
                <tr>
                    <td colspan="25%">Rev: 03</td>
                </tr>
                <tr>
                    <td colspan="25%">Date: 25 September 2024</td>
                </tr>
                <tr>
                    <td colspan="100%" style="font-weight: bold;">Penerima</td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Recipient's Name:</td>
                    <td colspan="75%" style="text-align: left;">{{$bap->penerima->name}}</td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Department:</td>
                    <td colspan="75%" style="text-align: left;">{{$bap->penerima->department->nama}}</td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Date of submission:</td>
                    <td colspan="75%" style="text-align: left;">{{ $bap->created_at->format('d M Y') }}</td>
                </tr>
                <tr>
                    <td colspan="100%" style="font-weight: bold;">Detail Barang</td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Brand:</td>
                    <td colspan="75%" style="text-align: left;">{{$bap->detail_barang->brand->name}}</td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Type:</td>
                    <td colspan="75%" style="text-align: left;">{{$bap->detail_barang->type->name}}</td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Spesifikasi:</td>
                    <td colspan="75%" style="text-align: left;">{{$bap->detail_barang->spesifikasi}}</td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Serial Number:</td>
                    <td colspan="75%" style="text-align: left;">{{$bap->detail_barang->serial_number}}</< /td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">PC Name:</td>
                    <td colspan="75%" style="text-align: left;">{{$bap->detail_barang->pc_name}}</< /td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Password:</td>
                    <td colspan="75%" style="text-align: left;">{{$bap->detail_barang->password}}</< /td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Operational System:</td>
                    <td colspan="75%" style="text-align: left;">{{$bap->detail_barang->os->name}}</< /td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Office:</td>
                    <td colspan="75%" style="text-align: left;">{{$bap->detail_barang->office->name}}</< /td>
                </tr>
                <tr>
                    <td colspan="25%" rowspan="3" style="text-align: left;">Program Default:</td>
                    <td colspan="38%" style="text-align: left;">7-Zip, Adobe Reader, K-Lite</td>
                    <td colspan="37%" style="text-align: left;">GPL (Free)
                    </td>
                </tr>
                <tr>
                    <td colspan="38%" style="text-align: left;">Google Chrome & Mozilla Firefox
                    </td>
                    <td colspan="37%" style="text-align: left;">GPL (Free)
                    </td>
                </tr>
                <tr>
                    <td colspan="38%" style="text-align: left;">Anti Virus
                    </td>
                    <td colspan="37%" style="text-align: left;">Lisensi : Renew Eset Pertahun
                    </td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Other:</td>
                    <td colspan="75%" style="text-align: left;">{{$bap->detail_barang->other}}</< /td>
                </tr>
                <tr>
                    <td colspan="100%" style="font-weight: bold;">Pembelian</td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Company:</td>
                    <td colspan="75%" style="text-align: left;">{{$bap->pembelian->company->name}}</< /td>
                </tr>
                <tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Request Number (PP):</td>
                    <td colspan="38%" style="text-align: left;">{{$bap->pembelian->pp}}</td>
                    <td colspan="7%" style="text-align: left;">
                        Date:
                    </td>
                    <td colspan="30%" style="text-align: left;"> {{ \Carbon\Carbon::parse($bap->pembelian->pp_date)->format('d M Y') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Purchase Number (PO):</td>
                    <td colspan="38%" style="text-align: left;">{{$bap->pembelian->po}}</td>
                    <td colspan="7%" style="text-align: left;">
                        Date:
                    </td>
                    <td colspan="30%" style="text-align: left;"> {{ \Carbon\Carbon::parse($bap->pembelian->po_date)->format('d M Y') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Receipt Note Number (SJ):</td>
                    <td colspan="38%" style="text-align: left;">{{$bap->pembelian->sj}}</td>
                    <td colspan="7%" style="text-align: left;">
                        Date:
                    </td>
                    <td colspan="30%" style="text-align: left;"> {{ \Carbon\Carbon::parse($bap->pembelian->sj_date)->format('d M Y') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="100%" style="font-weight: bold;">Pengecekan</td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">Kode IT
                    </td>
                    <td colspan="75%" style="text-align: left;">
                        {{$bap->nomor}}
                    </td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">
                        Checker
                    </td>
                    <td colspan="75%" style="text-align: left;">
                        {{$bap->pengecekan->checker}}
                    </td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">
                        Checking Date
                    </td>
                    <td colspan="75%" style="text-align: left;">
                        {{ \Carbon\Carbon::parse($bap->pengecekan->checking_date)->format('d M Y') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: left;">
                        Photo
                    </td>
                    <td colspan="38%" style="height: 100px;">
                        @if ($bap->pengecekan->foto1)
                        <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $bap->pengecekan->foto1))); ?>">
                        @endif
                    </td>
                    <td colspan="37%" style="height: 100px;">
                        @if ($bap->pengecekan->foto2)
                        <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $bap->pengecekan->foto2))); ?>">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="100%" style="text-align: left;">
                        1. Dilarang menyimpan / menginstal software yang tidak berlisensi atau data yang tidak berhubungan dengan pekerjaan (MP3, Game dll), kecuali atas persetujuan pimpinan perusahaan. <br>
                        2. Apabila ditemukan software di luar yang terdaftar di atas dan atau data yang tidak berkaitan dengan pekerjaan, adalah tanggung jawab PIC masing-masing. <br>
                        3. Apabila membutuhkan program (software) selain tersebut di atas, supaya mengajukan permintaan atas persetujuan pimpinan perusahaan. <br>
                        4. Jika terjadi kehilangan maka tanggung jawab kepada user yang bersangkutan. <br>
                        5. Pelanggaran terhadap ketentuan diatas akan dikenakan sanksi oleh perusahaan <br>
                        6. IT berhak melakukan audit dan monitoring atas aktivitas yang terjadi serta tindakan lain yang diperlukan. <br>
                        7. User yang bersangkutan telah membaca dan memahami ketentuan IT yang berlaku.
                    </td>
                </tr>
                <tr>
                    <td colspan="25%" style="text-align: center; font-weight: bold;">
                        Checking By
                    </td>
                    <td colspan="25%" style="text-align: center; font-weight: bold;">
                        Purchase By
                    </td>
                    <td colspan="25%" style="text-align: center; font-weight: bold;">
                        Using By
                    </td>
                    <td colspan="25%" style="text-align: center; font-weight: bold;">
                        Approved By
                    </td>
                </tr>
                <tr>
                    @if ($bap->status === 'acc0')
                    <td colspan="25%" style="height: 50px;">
                        <img class="ttd" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $bap->pembuat->ttd))); ?>">
                    </td>
                    <td colspan="25%" style="height: 50px;">

                    </td>
                    <td colspan="25%" style="height: 50px;">

                    </td>
                    <td colspan="25%" style="height: 50px;">

                    </td>
                    @elseif ($bap->status === 'acc1' || $bap->status === 'acc-2')
                    <td colspan="25%" style="height: 50px;">
                        <img class="ttd" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $bap->pembuat->ttd))); ?>">
                    </td>
                    <td colspan="25%" style="height: 50px;">
                        <img class="ttd" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $bap->purchasing->ttd))); ?>">
                    </td>
                    <td colspan="25%" style="height: 50px;">

                    </td>
                    <td colspan="25%" style="height: 50px;">

                    </td>
                    @elseif ($bap->status === 'acc2' || $bap->status === 'acc-3')
                    <td colspan="25%" style="height: 50px;">
                        <img class="ttd" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $bap->pembuat->ttd))); ?>">
                    </td>
                    <td colspan="25%" style="height: 50px;">
                        <img class="ttd" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $bap->purchasing->ttd))); ?>">
                    </td>
                    <td colspan="25%" style="height: 50px;">
                        <img class="ttd" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $bap->penerima->ttd))); ?>">
                    </td>
                    <td colspan="25%" style="height: 50px;">

                    </td>
                    @elseif ($bap->status === 'acc3')
                    <td colspan="25%" style="height: 50px;">
                        <img class="ttd" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $bap->pembuat->ttd))); ?>">
                    </td>
                    <td colspan="25%" style="height: 50px;">
                        <img class="ttd" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $bap->purchasing->ttd))); ?>">
                    </td>
                    <td colspan="25%" style="height: 50px;">
                        <img class="ttd" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $bap->penerima->ttd))); ?>">
                    </td>
                    <td colspan="25%" style="height: 50px;">
                        <img class="ttd" src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/' . $bap->penerima->department->leader->ttd))); ?>">
                    </td>
                    @endif
                </tr>
                <tr>
                    @if ($bap->status === 'acc0')
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama: {{$bap->pembuat->name}}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama:
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama:
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama:
                    </td>
                    @elseif ($bap->status === 'acc1' || $bap->status === 'acc-2')
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama: {{$bap->pembuat->name}}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama: {{$bap->purchasing->name}}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama:
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama:
                    </td>
                    @elseif ($bap->status === 'acc2' || $bap->status === 'acc-3')
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama: {{$bap->pembuat->name}}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama: {{$bap->purchasing->name}}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama: {{$bap->penerima->name}}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama:
                    </td>
                    @elseif ($bap->status === 'acc3')
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama: {{$bap->pembuat->name}}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama: {{$bap->purchasing->name}}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama: {{$bap->penerima->name}}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Nama: {{$bap->penerima->department->leader->name}}
                    </td>
                    @endif
                </tr>
                <tr>
                    @if ($bap->status === 'acc0')
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal: {{$bap->created_at->format('d M Y')}}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal:
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal:
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal:
                    </td>
                    @elseif ($bap->status === 'acc1' || $bap->status === 'acc-2')
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal: {{$bap->created_at->format('d M Y')}}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal: {{ \Carbon\Carbon::parse($bap->purchasing_date)->format('d M Y') }}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal:
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal:
                    </td>
                    @elseif($bap->status === 'acc2' || $bap->status === 'acc-3')
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal: {{$bap->created_at->format('d M Y')}}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal: {{ \Carbon\Carbon::parse($bap->purchasing_date)->format('d M Y') }}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal: {{ \Carbon\Carbon::parse($bap->using_date)->format('d M Y') }}
                    </td>
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal:
                    </td>
                    @elseif($bap->status === 'acc3')
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal: {{$bap->created_at->format('d M Y')}}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal: {{ \Carbon\Carbon::parse($bap->purchasing_date)->format('d M Y') }}
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal: {{ \Carbon\Carbon::parse($bap->using_date)->format('d M Y') }}
                    </td>
                    </td>
                    <td colspan="25%" style="text-align: left; font-weight: bold;">
                        Tanggal: {{ \Carbon\Carbon::parse($bap->approved_date)->format('d M Y') }}
                    </td>
                    @endif
                </tr>
            </table>
        </div>
    </div>

    <div>
        <div class="page-break"></div>
    </div>

    <div class="page">
        <div class="qrContainer">
            <table>
                <tr>
                    <td colspan="2" style="width: 45%;"><strong>Aset of IT MMNR Groups</strong></td>
                    <td rowspan="3" style="width: 55%;" class="align-center no-space">
                        <img class="qrimg" src="data:image/png;base64, {!! base64_encode($qr) !!}" style="max-width: 80px; max-height: 80px;"> <!-- Reduced image size -->
                    </td>
                </tr>
                <tr>
                    <td colspan="2">{{ $bap->pembelian->company->name }}</td>
                </tr>
                <tr>
                    <td style="width: 50%;">{{ \Carbon\Carbon::parse($bap->tanggal_dibuat)->format('d M Y') }}</td>
                    <td style="width: 50%;">{{ $bap->detail_barang->pc_name }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="align-center"><strong>Do Not Remove</strong></td>
                    <td class="align-center"><strong>{{ $bap->nomor }}</strong></td>
                </tr>
            </table>
        </div>
    </div>


</body>

</html>