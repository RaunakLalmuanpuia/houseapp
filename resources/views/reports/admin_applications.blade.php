<style>

</style>
<div>
    <table>
        <thead>
        <tr>
            <th>Submitted at</th>
            <th>REASON</th>
            <th>STATUS</th>
            <th>APPLICATION ID</th>
            <th>APPLICANT NAME</th>
            <th>CONTACT</th>
            <th>GENDER</th>
            <th>DESIGNATION</th>
            <th>DEPARTMENT</th>
            <th>NO. OF PERSONS</th>
            <th>HOUSE</th>
            <th>ARRIVAL</th>
            <th>DEPARTURE</th>
        </tr>
        </thead>
        <tbody>
        @foreach($applications as $application)
            <tr>
                <td>{{ date('d-m-Y', strtotime($application->created_at)) ?? 'N/A' }}</td>
                <td>{{ $application?->type ??'' }}</td>
                <td>{{ $application?->status ??'' }}</td>
                <td>{{ $application?->application_id }}</td>
                <td>{{ $application?->applicant_name ?? ''}}</td>
                <td>{{ $application?->contact ?? ''}}</td>
                <td>{{ $application?->gender ??'' }}</td>
                <td>{{ $application?->designation ??'' }}</td>
                <td>{{ $application?->department?->name ??'' }}</td>
                <td>{{ $application?->number_of_persons ??'' }}</td>
                <td>{{ $application?->house?->name ??'' }}</td>
                <td>{{ date('d-m-Y', strtotime($application->start_date)) }}</td>
                <td>{{ date('d-m-Y', strtotime($application->end_date)) }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
