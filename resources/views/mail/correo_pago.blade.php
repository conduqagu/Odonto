<!--<META HTTP-EQUIV="REFRESH" URL="Odonto.test/exams/show/".{{$exam->id}}>-->
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Llamado de emergencia</title>
</head>
<body>
<p>Hola {{$patient->name.' '.$patient->surname }}.</p>
<p>Este es el resumen de los tratamientos aplicados en el examen {{$exam->tipoExam}} del {{$exam->date}}:</p>
<table border="1" width="100%" align="center">
    <tr>
        <td bgcolor="#CCCCCC">Nombre</td>
        <td bgcolor="#CCCCCC">Coste</td>
    </tr>

    @foreach ($tratamientos as $tratamiento)
        <tr>
            <td>{{ $tratamiento->tipoTratamiento->name }}</td>
            <td>{{ $tratamiento->coste }}</td>
        </tr>
    @endforeach
    <tr>
        <th>IVA (%):</th>
        <th>{{$exam->iva}}</th>
    </tr>
    <tr>
        <th>Coste total (€): </th>
        <th>{{$coste_total}}</th>
    </tr>
</table>
<p>Para realizar el pago por Paypal seleccione el siguiente enlace:</p>
<a href="odonto.test/paypal/pay/{{$exam->id}}">
    Pagar con PAYPAL
</a>
<p>Muchas gracias desde la Facultad de Odontología.</p>

</body>
</html>

