<!DOCTYPE html>
<html>
<head>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Monthly Attendance Report - {{ date('F Y', strtotime($month)) }}</h2>
    <p>Student Name: {{ $student->name }}</p>
    <p>Division: {{ $student->division }}</p>
    
    <h3>Attendance Summary</h3>
    <p>Total Classes: {{ $attendanceData->count() }}</p>
    <p>Present: {{ $attendanceData->where('is_present', 1)->count() }}</p>
    <p>Absent: {{ $attendanceData->where('is_present', 0)->count() }}</p>
    <p>Attendance Percentage: 
        {{ $attendanceData->count() > 0 
            ? round(($attendanceData->where('is_present', 1)->count() / $attendanceData->count()) * 100, 2) 
            : 0 }}%
    </p>

    <h3>Detailed Report</h3>
    <table>
        <tr>
            <th>Date</th>
            <th>Status</th>
            <th>Remarks</th>
        </tr>
        @foreach($attendanceData as $attendance)
        <tr>
            <td>{{ $attendance->date }}</td>
            <td>{{ $attendance->is_present ? 'Present' : 'Absent' }}</td>
            <td>{{ $attendance->remarks ?? '-' }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>