<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="font-family: 'Poppins', Arial, sans-serif">
    <table width="100%" style="border: 1px solid #cccccc" cellspacing="0" cellpadding="0">
        <tr>
            <td style="padding: 20px;">
                <table class="content" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;" cellspacing="0" cellpadding="0">
                    <!-- Header -->
                    <tr>
                        <td class="header" style="background-color: #345C72; padding: 40px; text-align: center; color: white; font-size: 24px;">
                            Approval Email from IT PT IMLI
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td class="body" style="padding: 40px; text-align: left; font-size: 16px; line-height: 1.6;">
                            Halo, {{$msg->pembuat->name}}! <br>
                            Berita Acara Pengakuan anda dengan nomor {{$msg->nomor}} baru saja 
                            @if ($msg->status === 'acc1')
                            diapprove oleh {{$msg->purchasing->name}}
                            @elseif ($msg->status === 'acc2')
                            diapprove oleh {{$msg->penerima->name}}
                            @elseif ($msg->status === 'acc3')
                            diapprove oleh {{$msg->penerima->department->leader->name}}
                            @endif

                            @if ($msg->status === 'acc-1')
                            direject oleh {{$msg->purchasing->name}}
                            <br>
                            Mohon 
                            @elseif ($msg->status === 'acc-2')
                            direject oleh {{$msg->penerima->name}}
                            @elseif ($msg->status === 'acc-3')
                            direject oleh {{$msg->penerima->department->leader->name}}
                            @endif
                            <br><br>
                            Silahkan klik tombol dibawah ini untuk melihat detail Berita Acara Pengakuan dan Penerimaan Aset.
                        </td>
                    </tr>

                    <!-- Call to action Button -->
                    <tr>
                        <td style="padding: 0px 40px; text-align: center;">
                            <div style="text-align: center;">
                                <div style="background-color: #345C72; padding: 10px 20px; border-radius: 5px; margin-bottom: 10px;">
                                    <a href="http://192.168.4.222:8081/e-form/bap/ongoing" target="_blank" style="color: #ffffff; text-decoration: none; font-weight: bold;">Lihat Detail</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="body" style="padding: 40px; text-align: left; font-size: 16px; line-height: 1.6;">
                            Jika terdapat kendala, silahkan menghubungi IT staff terdekat.
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer" style="background-color: #333333; padding: 40px; text-align: center; color: white; font-size: 14px;">
                            Copyright &copy; 2024 | IT SUPPORT PT IMLI
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>