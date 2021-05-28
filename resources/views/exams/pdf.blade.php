<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        h2{
            text-align: center;
            text-transform: uppercase;
        }
        .contenido{
            font-size: 20px;
        }
        #primero{
            background-color: #ccc;
        }
        #segundo{
            color:#44a359;
        }
        #tercero{
            text-decoration:line-through;
        }
    </style>
</head>
<h2>Área clínica facultad de odontología</h2>
<hr>
<div class="contenido">
    <table border="1">
        <tr>
            <td bgcolor="#CCCCCC">Nombre:</td>
            <td>{!! Form::label( $exam->patient->name)." ".Form::label( $exam->patient->surname) !!}</td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC">Fecha de examen:</td>
            <td>{!! Form::label($exam->date) !!}</td>
        </tr>
    </table>

</div>

</body>
</html>
