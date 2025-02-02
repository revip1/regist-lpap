<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat</title>
    <style>
        @page {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .certificate {
            width: 297mm;
            height: 210mm;
            position: relative;
            color: #000;
            margin: 0;
            padding: 0;
        }
        .certificate-content {
            width: 100%;
            height: 100%;
            position: relative;
            background-image: url('{{ Request::is("*export-pdf*") ? public_path("img/sertif.png") : asset("img/sertif.png") }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        .name {
            position: absolute;
            top: 38%;
            left: 0;
            right: 0;
            font-size: 28px;
            font-weight: bold;
            text-align: center;
        }
        .program {
            position: absolute;
            top: 45%;
            left: 0;
            right: 0;
            font-size: 22px;
            text-align: center;
        }
        .unique-code {
            position: absolute;
            top: 53%;
            left: 0;
            right: 0;
            font-size: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="certificate-content">
            <div class="name">{{ $userDetail->full_name }}</div>
            <div class="program">Program: {{ $userDetail->ticket->program->name }}</div>
            <div class="unique-code">Kode Tiket: {{ $userDetail->ticket->unique_code }}</div>
        </div>
    </div>
</body>
</html>