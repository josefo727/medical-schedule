<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cita actualizada</title>
</head>
<body>
    <p>Se le notifica que su cita fue actualizada satisfactoriamente.</p>
    <p>
        <strong>Fecha:</strong> {{ $medicalAppointment->date->format('d-M-Y') }} <br>
        <strong>Hora:</strong> {{ $medicalAppointment->date->format('h:i A') }} <br>
        <strong>Doctor:</strong> {{ $medicalAppointment->doctor->fullName }} <br>
        <strong>Paciente:</strong> {{ $medicalAppointment->patient->fullName }} <br>
        <strong>Especialidad:</strong> {{ $medicalAppointment->doctor->specialty->name }}
    </p>
</body>
</html>
