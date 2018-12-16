{{--{{dd($dados)}}--}}
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>

    </title>
    <style type="text/css">

        body {
            font-family: arial;
        }

        table,  th,  td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td {
            text-align: left;
        }

        .rodape {
            position: absolute;
            bottom:0;
            width: 100%;
            height: 90px;
            margin-top: 70px;
        }

        table {
            width: 100%;
            top: 210px;
        }

        tr, th {
            font-size: 12px;
            text-align: left;
        }

        table { page-break-inside:auto }
        tr { page-break-inside:avoid; page-break-after:auto }
        thead { display:table-header-group }
        tfoot { display:table-footer-group }
    </style>
</head>
<body>
<center>
    <div>

    </div>
</center>

<h3 style="text-align: center">Netstart Soluçoes em Tecnologia</h3>

<p>

</p>

<table class="" border="1">
    <thead>
    <tr>
        <th>N</th>
        <th>Cliente</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($clientes as $key =>  $cliente)
        <tr>
            <th>{{ $key+1 }}</th>
            <th>{{ $cliente->nome }}</th>
        </tr>
    @endforeach
    </tbody>
</table>

<center>
    <div class="rodape">
        <center>

        </center>
    </div>
</center>
</body>
</html>
