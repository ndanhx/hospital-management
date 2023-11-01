<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Patient Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
        }

        .info-label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .info-value {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Patient Information</h1>

        <div class="info-label">Full Name:</div>
        <div class="info-value">{{ $user->name }}</div>

        <div class="info-label">Email:</div>
        <div class="info-value">{{ $user->email }}</div>

        <div class="info-label">Phone:</div>
        <div class="info-value">{{ $user->phone }}</div>

        <div class="info-label">Date of Birth:</div>
        <div class="info-value">{{ $user->created_at }}</div>

        <div class="info-label">Address:</div>
        <div class="info-value">{{ $user->address }}</div>

        <hr>

        <h1>Health Information</h1>

        <div class="info-label">Diagnosis:</div>
        <div class="info-value">{{ $heathBook->diagnosis }}</div>

        <div class="info-label">Doctor:</div>
        <div class="info-value">{{ $doctor[0]->name }}</div>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Drug Name</th>
                    <th>Quantity</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listPrescriptions as $prescription)
                <tr>
                    <td>{{ $prescription->STT }}</td>
                    <td>{{ $prescription->drug_name }}</td>
                    <td>{{ $prescription->quantity }}</td>
                    <td>{{ $prescription->time }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
