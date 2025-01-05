<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f9f9f9;
        }
        .certificate {
            background-image: url('/img/sertif.png');
            background-size: cover;
            width: 1000px;
            height: 700px;
            margin: 50px auto;
            position: relative;
            color: #000;
        }
        .name {
            position: absolute;
            top: 250px;
            width: 100%;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }
        .program {
            position: absolute;
            top: 320px;
            width: 100%;
            font-size: 18px;
            text-align: center;
        }
        .unique-code {
            position: absolute;
            top: 400px;
            width: 100%;
            font-size: 16px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="name">{{ $userDetail->full_name }}</div>
        <div class="program">Program: {{ $userDetail->ticket->program->name }}</div>
        <div class="unique-code">Kode Tiket: {{ $userDetail->ticket->unique_code }}</div>
    </div>
</body>
</html>
