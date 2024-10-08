@extends('layouts/contentNavbarLayout')

@section('title', 'Leave Management')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
  .holiday {
    color: red;
  }

  .sunday {
    color: blue;
  }
</style>
<!-- Include other styles here -->
@section('content')
<h4 class="py-0 mb-4">
  <span class="text-muted fw-light" style="color:red !important;">Attendace Dashboard</span>
</h4>

<div class="row">
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card" style="background-color: #FED8B1;color:#000;font-weight:bold;">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Total</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;"> {{ $presentMonthCount + $presentWeekCount + $presentDayCount  }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-primary">
                <i class="bx bx-user bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card" style="background-color: #90EE90;color:#000;font-weight:bold;">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Today</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $presentDayCount }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-success">
                <i class="bx bx-user-check bx-sm"> </i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card" style="background-color: #FF7F7F;color:#000;font-weight:bold;">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Week</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $presentWeekCount }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-danger">
                <i class="bx bx-group bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card" style="background-color: #CBC3E3;color:#000;font-weight:bold;">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Month</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;"> {{ $presentMonthCount }}</h4>
              </div>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-warning">
                <i class="bx bx-user-voice bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Month Filter -->


  <!-- Form controls -->
  <div class="card">
    <h5 class="card-header" style="color:red;">Attendace List(s)</h5>
    <div class="table-responsive text-nowrap">
      <form method="POST" action="{{ route('attendance.store') }}">
        @csrf
        <table border="1" style="width:100%; border-spacing: 2px; padding: 10px;">
          <thead>
            <tr>
              <th>Employee Name</th>
              @for ($i = 1; $i <= $monthDays; $i++) <th>{{ $i }}</th>
                @endfor
                <th>Days Present</th>
                <th>Salary</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($employees as $employee)
            @php
            $presentDays = 0;
            $salary = $employee->salary;
            @endphp
            <tr>
              <td>{{ $employee->first_name.' '.$employee->last_name }}</td>
              @for ($i = 1; $i <= $monthDays; $i++) @php $date=Carbon\Carbon::createFromDate(Carbon\Carbon::now()->year, Carbon\Carbon::now()->month, $i);
                $attendanceForDay = $attendance->has($employee->id) ? $attendance[$employee->id]->firstWhere('date', $date->toDateString()) : null;
                $isHoliday = $publicHolidays->firstWhere('date', $date->toDateString());
                $isSunday = $date->isSunday();

                if ($attendanceForDay || $isHoliday || $isSunday) {
                $presentDays++;
                }

                @endphp

                <td class="{{ trim($isHoliday ? 'holiday' : '') }} {{ trim($isSunday ? 'sunday' : '') }}">
                  <input type="checkbox" name="attendance[{{ $employee->id }}][{{ $date->toDateString() }}]" {{ $attendanceForDay || $isHoliday || $isSunday ? 'checked' : '' }} {{ $isHoliday || $isSunday ? 'disabled' : '' }}>
                </td>
                @endfor
                <td>{{ $presentDays }}</td>
                <td>{{ number_format($salary / 30 * $presentDays, 2) }}</td>
                <td>
                  <button type="button" class="btn btn-info open-modal" data-employee-id="{{ $employee->id }}" data-employee-name="{{ $employee->first_name . ' ' . $employee->last_name }}" data-amount="{{ number_format($salary / 30 * $presentDays, 2) }}">Paid Salary</button>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <button type="submit" class="btn btn-primary" style="margin-top:20px;float:right;margin-bottom:20px;">Submit</button>
      </form>
    </div>
  </div>

</div>

<!-- Modal -->
<div class="modal fade" id="expenseModal" tabindex="-1" role="dialog" aria-labelledby="expenseModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="expenseForm" method="POST" action="{{ route('attendance.paidsalary') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="expenseModalLabel">Paid Salary</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="employee_id" id="employeeId">

          <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" readonly>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div>

          <input type="hidden" name="added_by" value="{{ auth()->user()->id }}">
          <input type="hidden" name="date" value="{{ now()->toDateString() }}">
          <input type="hidden" name="expense_type_id" value="13">
          <input type="hidden" name="location" value="{{ session('user_data')->location }}">
          <input type="hidden" name="added_by" value="{{ session('user_data')->id }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Expense</button>
        </div>
      </form>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  new DataTable('#usersTable', {
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
  });

  $(document).ready(function() {
    console.log('Document is ready');

    $('#monthFilter').change(function() {
      var selectedMonth = $(this).val();
      // Add your AJAX call here to fetch data based on the selected month
      console.log('Selected Month:', selectedMonth);
    });

    $('.open-modal').click(function() {
      var employeeId = $(this).data('employee-id');
      var employeeName = $(this).data('employee-name');
      var amount = $(this).data('amount');


      console.log('Employee ID:', employeeId);
      console.log('Employee Name:', employeeName);
      console.log('Amount:',amount);
      var d = new Date();
var currentMonth = d.getFullYear()+'/'+(d.getMonth()+1)+'/'+d.getDate();

      $('#expenseModal').find('.modal-title').text('Add Expense for ' + employeeName);
      $('#expenseModal').find('#employeeId').val(employeeId);
      $('#expenseModal').find('#amount').val(amount);
      $('#expenseModal').find('#description').val("This month Salary "+currentMonth + " " + employeeName);

      $('#expenseModal').modal('show');
    });

    $('#expenseModal .close, .btn-secondary').click(function() {
      $('#expenseModal').modal('hide');
    });
  });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

@endsection
