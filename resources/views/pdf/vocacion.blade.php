<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Vocacion</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
            line-height: 1.5;
            color: #151b1e;           
        }
        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #c2cfd6;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 2px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #c2cfd6;
        }
        th, td {
            display: table-cell;
            vertical-align: inherit;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
    </style>
</head>
<body>
    <div>
        <h3>Reporte de Vocacion <span class="derecha">{{$ahora}}</span></h3>
    </div>
    <div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                <th>Productor</th>
                <th>Finca</th>
                <th>Vocacion</th>
                <th>Tiempo en el cultivo de mora</th>
                <th>Practicas basicas del cultivo de mora</th>
                <th>Desea recibir capacitacion</th>
                <th>Dias a la semana en el cultivo de mora</th>  
                <th>Labores</th>
                <th>Motivo por el cual cultiva mora</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vocacions as $v)
                <tr>
                    <td>{{$v->nombre}}</td>
                    <td>{{$v->nombre_finca}}</td>
                    <td>{{$v->vocacion}}</td>
                    <td>{{$v->tiempo}}</td>
                    <td>{{$v->practicaBasica}}</td>
                    <td>{{$v->capacitacionRefuerzo}}</td>
                    <td>{{$v->diasMora}}</td>
                    <td>{{$v->labores}}</td>
                    <td>{{$v->motivo}}</td>
                </tr>
                @endforeach                                
            </tbody>
        </table>
    </div>
    <div class="izquierda">
        <p><strong>Total de registros: </strong>{{$cont}}</p>
    </div>    
</body>
</html>