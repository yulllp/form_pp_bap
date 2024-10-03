<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #38a169; /* green color */
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #2f855a; /* darker green */
        }
    </style>
</head>
<body>
    <h3>{{$msg->user->name}} telah mengajukan Permintaan Pembelian Internal - IT</h3>
    <h3>Klik tombol dibawah untuk approve pengajuan {{$msg->user->name}}</h3>
    <a href="http://127.0.0.1:8000/approval/permintaan/{{$msg->id}}" class="button">
        Click Here
    </a>
</body>
</html>