<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KYC Certificate</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .certificate-box {
            border: 2px solid #000;
            padding: 20px;
            width: 700px;
            margin: auto;
        }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td { padding: 8px; vertical-align: top; }
        .section-title { background: #f2f2f2; font-weight: bold; text-align: left; }
        .photo-cell { text-align: center; padding-top: 10px; }
        .photo-cell img { border: 1px solid #ccc; }
    </style>
</head>
<body>
<div class="certificate-box">
    <h2>KYC Certificate</h2>

    <p><strong>Transaction ID:</strong> {{ $data['KycRes']['@attributes']['txn'] ?? '-' }}</p>
    <p><strong>Timestamp:</strong> {{ $data['KycRes']['@attributes']['ts'] ?? '-' }}</p>

    <table border="1">
        <tr><td colspan="2" class="section-title">Personal Information</td></tr>
        <tr>
            <td><strong>Name:</strong></td>
            <td>{{ $data['KycRes']['UidData']['Poi']['@attributes']['name'] ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Gender:</strong></td>
            <td>{{ $data['KycRes']['UidData']['Poi']['@attributes']['gender'] ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>DOB:</strong></td>
            <td>{{ $data['KycRes']['UidData']['Poi']['@attributes']['dob'] ?? '-' }}</td>
        </tr>

        <tr><td colspan="2" class="section-title">Photo</td></tr>
        <tr>
            <td colspan="2" class="photo-cell">
                @if (!empty($data['KycRes']['UidData']['Pht']))
                    <img src="data:image/jpeg;base64,{{ $data['KycRes']['UidData']['Pht'] }}" alt="KYC Photo" width="120" height="150">
                @else
                    <em>No photo available</em>
                @endif
            </td>
        </tr>

        <tr><td colspan="2" class="section-title">Address</td></tr>
        <tr>
            <td><strong>House:</strong></td>
            <td>{{ $data['KycRes']['UidData']['Poa']['@attributes']['house'] ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Street:</strong></td>
            <td>{{ $data['KycRes']['UidData']['Poa']['@attributes']['street'] ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Locality:</strong></td>
            <td>{{ $data['KycRes']['UidData']['Poa']['@attributes']['loc'] ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>District:</strong></td>
            <td>{{ $data['KycRes']['UidData']['Poa']['@attributes']['dist'] ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>State:</strong></td>
            <td>{{ $data['KycRes']['UidData']['Poa']['@attributes']['state'] ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>PIN Code:</strong></td>
            <td>{{ $data['KycRes']['UidData']['Poa']['@attributes']['pc'] ?? '-' }}</td>
        </tr>
    </table>

    <p style="margin-top: 30px;"><strong>Issued By:</strong> UIDAI</p>
</div>
</body>
</html>
