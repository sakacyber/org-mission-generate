<!DOCTYPE html>
<html>

<head>
    <title>Print Mission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        h2,
        h4 {
            margin-bottom: 0;
        }

        .info {
            margin-bottom: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="no-print" style="text-align: right; margin-bottom: 20px;">
        <button onclick="window.print()">Print</button>
    </div>

    <h2>Mission: {{ $mission->goal }}</h2>
    <p><strong>Location:</strong> {{ $mission->place }}</p>
    <p><strong>Mission Date:</strong> {{ $mission->mission_date }}</p>
    <p><strong>CEO Signature Date:</strong> {{ $mission->ceo_signature_date }}</p>

    <h4>Assigned People:</h4>
    <ul>
        @foreach($mission->people as $person)
            <li>{{ $person->name }} ({{ $person->department->name }})</li>
        @endforeach
    </ul>
</body>

</html>