<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Applications Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 8px;
            color: #333;
            margin: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #999;
            padding: 3px 2px;
            text-align: left;
            vertical-align: top;
            word-wrap: break-word;
        }

        thead {
            background-color: #f0f0f0;
        }

        th {
            font-weight: bold;
            font-size: 8px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr {
            line-height: 1.2;
        }
    </style>
</head>
<body>

<h2>Mizoram House Applications Report</h2>

<table>
    <thead>
    <tr>
        <th>Submitted At</th>
        <th>Reason</th>
        <th>Status</th>
        <th>Application ID</th>
        <th>Applicant Name</th>
        <th>Contact</th>
        <th>Gender</th>
        <th>Designation</th>
        <th>Department</th>
        <th>No. of Persons</th>
        <th>House</th>
        <th>Arrival</th>
        <th>Departure</th>
    </tr>
    </thead>
    <tbody>
    @foreach($applications as $application)
        <tr>
            <td>{{ $application->created_at ? date('d-m-Y', strtotime($application->created_at)) : 'N/A' }}</td>
            <td>{{ $application->type ?? '' }}</td>
            <td>{{ $application->status ?? '' }}</td>
            <td>{{ $application->application_id }}</td>
            <td>{{ $application->applicant_name ?? '' }}</td>
            <td>{{ $application->contact ?? '' }}</td>
            <td>{{ $application->gender ?? '' }}</td>
            <td>{{ $application->designation ?? '' }}</td>
            <td>{{ $application->department->name ?? '' }}</td>
            <td>{{ $application?->number_of_persons ??'' }}</td>
            <td>{{ $application->house->name ?? '' }}</td>
            <td>{{ $application->start_date ? date('d-m-Y', strtotime($application->start_date)) : '' }}</td>
            <td>{{ $application->end_date ? date('d-m-Y', strtotime($application->end_date)) : '' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
