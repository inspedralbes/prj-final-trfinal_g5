<!DOCTYPE html>
<html>
<head>
    <title>Registro Exitoso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, p {
            margin: 0 0 20px;
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <img src="../public/img/logo.png" alt="Fithub">
    <div class="container">
        <h1>¡Registro Exitoso!</h1>
        <p>Hola {{ $usuari->nom }} {{$usuari->cognoms}},</p>
        <p>¡Bienvenido a Fithub! Tu registro ha sido completado exitosamente.</p>
        <p>A partir de ahora, podrás disfrutar de todas las funcionalidades que ofrecemos en nuestra aplicacion.</p>
        <p>Gracias por unirte a nosotros.</p>
        <p>Saludos cordiales,</p>
        <p>El equipo de Fithub</p>
    </div>
    <div class="footer">
        <p>Este mensaje se ha enviado automáticamente. Por favor, no respondas a este mensaje.</p>
    </div>
</body>
</html>