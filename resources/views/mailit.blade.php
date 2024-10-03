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
              Halo, {{$msg->user->name}}! <br>
              @if($msg->status == 'acc1')
              Pengajuan Permintaan Pembelian Internal anda di APPROVE oleh tim IT ({{$msg->approval->name}} - IT), Pada tanggal {{$msg->it_confirm_date}}.
              @elseif($msg->status == 'acc-1')
              Pengajuan Permintaan Pembelian Internal anda di DISAPPROVE oleh tim IT ({{$msg->approval->name}} - IT), Pada tanggal {{$msg->it_confirm_date}}.
              @endif
              <br><br>
              @if($msg->status == 'acc1')
              Silahkan klik tombol dibawah ini untuk melihat detail Permintaan Pembelian.
              @elseif($msg->status == 'acc-1')
              Silahkan klik tombol dibawah ini untuk melakukan revisi Permintaan Pembelian.
              @endif
            </td>
          </tr>

          <!-- Call to action Button -->
          <tr>
            <td style="padding: 0px 40px 0px 40px; text-align: center;">
              <!-- CTA Button -->
              <table cellspacing="0" cellpadding="0" style="margin: auto;">
                <tr>
                  <td style="background-color: #345C72; padding: 10px 20px; border-radius: 5px; text-align: center;">
                    @if($msg->status == 'acc1')
                    <a href="http://127.0.0.1:8000/printpp/{{$msg->id}}" target="_blank" style="color: #ffffff; text-decoration: none; font-weight: bold;">Lihat data yang diapprove</a>
                    @elseif($msg->status == 'acc-1')
                    <a href="http://127.0.0.1:8000/edit/permintaan/{{$msg->id}}" target="_blank" style="color: #ffffff; text-decoration: none; font-weight: bold;">Cek data yang perlu direvisi</a>
                    @endif
                  </td>
                </tr>
              </table>
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