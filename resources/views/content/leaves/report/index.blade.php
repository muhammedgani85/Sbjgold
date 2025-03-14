@extends('layouts/contentNavbarLayout')

@section('title', 'Leave Management')

@section('page-script')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<style>
  .holiday {
    color: red;
  }

  .sunday {
    color: blue;
  }
</style>

<style>
.form-control {
    height: 40px; /* Set the height for input fields */
}
.btn {
    height: 40px; /* Make buttons the same height as inputs */
    margin-left: 5px; /* Optional: Add some space between buttons */
}
</style>

@section('content')
<h4 class="py-0 mb-4">
  <span class="text-muted fw-light" style="color:red !important;">Leave Report</span>
</h4>

<div class="row">
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <div class="card">

    <div class="table-responsive text-nowrap" style="margin-top:30px;">
    <form action="{{ route('leaves.report.index') }}" method="GET" class="mb-3">
    <div class="form-row align-items-center">
        <div class="col-auto mb-2">
            <label for="from_date">From:</label>
            <input type="date" name="from_date" id="from_date" class="form-control" value="{{ $fromDate }}">
        </div>

        <div class="col-auto mb-2">
            <label for="to_date">To:</label>
            <input type="date" name="to_date" id="to_date" class="form-control" value="{{ $toDate }}">
        </div>

        <div class="col-auto mb-2">
            <label for="employee_id">Employee:</label>
            <select name="employee_id" id="employee_id" class="form-control">
                <option value="">All</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->first_name }} {{ $employee->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        @if(in_array($role, [1, 9, 10]))
            <div class="col-auto mb-2">
                <label for="location">Branch:</label>
                <select name="location" id="location" class="form-control">
                    <option value="all">All</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ request('location') == $location->id ? 'selected' : '' }}>
                            {{ $location->branch_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="col-auto mb-2" style="margin-top:30px;">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('leaves.report.index') }}" class="btn btn-secondary">Clear</a>
        </div>
    </div>
</form>



<table id="leaveReportTable" class="table table-bordered">
    <thead>
        <tr>
            <th>Employee</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Approved By</th>
            <th>Reason</th>
            <th>Remarks</th>
            <th>Leave Type</th>
            <th>Location</th>
        </tr>
    </thead>
    <tbody>
    @if($leaves->isEmpty())
        <tr>
            <td colspan="9" style="color: red; text-align: center;">
                <span style='color:red;'>No records found</span>
            </td>
        </tr>
    @else
        @foreach($leaves as $leave)
            <tr>
                <td>{{ $leave->employee->first_name ?? 'N/A' }} {{ $leave->employee->last_name ?? '' }}</td>
                <td>{{ $leave->start_date ?? 'N/A' }}</td>
                <td>{{ $leave->end_date ?? 'N/A' }}</td>
                <td>{{ $leave->status ?? 'N/A' }}</td>
                <td>{{ $leave->approvedBy->first_name ?? 'N/A' }} {{ $leave->approvedBy->last_name ?? '' }}</td>
                <td>{{ $leave->leaveReason->reason ?? 'N/A' }}</td>
                <td>{{ $leave->remarks ?? 'N/A' }}</td>
                <td>{{ $leave->leaveType->name ?? 'N/A' }}</td>
                <td>{{ $leave->branch->branch_name ?? 'N/A' }}</td>
            </tr>
        @endforeach
    @endif
</tbody>
</table>

    </div>
  </div>
</div>

<!-- Include required libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>


<script>
new DataTable('#attendanceTable', {
    "pageLength": 10, // Set default page length
    "lengthMenu": [5, 10, 25, 50, 75, 100], // Set options for page length
    "language": {
      "search": "", // Remove the search label
      "searchPlaceholder": "Search...", // Optionally, you can add a placeholder
      "emptyTable": "No data available",
      "info": "", // Remove the "Showing X to Y of Z entries"
      "infoEmpty": "", // Remove the "Showing 0 to 0 of 0 entries"
      "infoFiltered": "", // Remove the "filtered from X total entries"

      "paginate": {
        "first": "First",
        "last": "Last",
        "next": "Next",
        "previous": "Previous"
      },
      "zeroRecords": "No matching records found"
    },
    "pagingType": "full_numbers",
    "layout": {
        "topStart": {
            "buttons": ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    }
  });
</script>

@endsection
