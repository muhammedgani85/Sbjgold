@extends('layouts/contentNavbarLayout')

@section('title', 'Leave Management')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<style>
  .text-left {
    text-align: left;
  }

  .text-success {
    color: green;
  }

  .text-warning {
    color: purple;
  }

  .text-danger {
    color: red;
  }
</style>
<!-- Include other styles here -->
@section('content')
<h4 class="py-0 mb-4">
  <span class="text-muted fw-light" style="color:red !important;">Leave Dashboard</span>
</h4>

<div class="row">
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card" style="background-color: #FED8B1;color:#000;font-weight:bold;">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Total ( Year )</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $totalLeave  }}</h4>
                <!-- <small class="text-success">(+29%)</small> -->
              </div>
              <!-- <p class="mb-0">Total Employees</p> -->
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
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $countTodayLeaves;  }}</h4>
                <!-- <small class="text-success">(+18%)</small> -->
              </div>
              <!-- <p class="mb-0">Up to Date </p> -->
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-success">
                <i class="bx bx-user-check bx-sm"></i>
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
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $countCurrentWeek;  }}</h4>
                <!-- <small class="text-danger">(-14%)</small> -->
              </div>
              <!-- <p class="mb-0">Up to Date </p> -->
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
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $countCurrentMonth;  }}</h4>
                <!-- <small class="text-success">(+42%)</small> -->
              </div>
              <!-- <p class="mb-0">Up to Date </p> -->
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


  <!-- Form controls -->

  <div class="card">
    <h5 class="card-header" style="color:red;">Leave List(s)</h5>


    <div class="table-responsive text-nowrap">

      <table class="display" id="usersTable">
        <thead>
          <tr>
            <th>Emp.ID</th>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>days</th>
            <th>Leave Type</th>
            <th>Reason</th>
            <th>A.Date</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($leaves as $leave)
          <tr>
            <td>{{ $leave->employee->emp_id }}</td>
            <td>{{ $leave->employee->initial.' '.$leave->employee->first_name.' '. $leave->employee->last_name}}</td>
            <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1 }}</td>
            <td>{{ $leave->leaveType->name }}</td>
            <td>{{ $leave->leaveReason->reason }}</td>
            <td>{{ date('d-m-Y',strtotime($leave->created_at)) }}</td>
            <td class="text-left {{ $leave->status === 'Pending' ? 'text-danger' : ($leave->status === 'Approved' ? 'text-success' : 'text-warning') }}">
              {{ $leave->status }}
            </td>
            <td>
              <div class="dropdown">
                <a href="http://127.0.0.1:8000/users/2/edit" title="Approved" onclick="approveLeave('{{ $leave->id }}')"><i class='bx bx-check'></i></a>
                <a href="javascript:void(0);" data-id="2" class="btn-delete" title="Cancel" onclick="cancelLeave('{{ $leave->id }}')"><i class='bx bx-x'></i></a>

                <a href="javascript:void(0);" title="withdraw" onclick="withdrawLeave('{{ $leave->id }}')"><i class='bx bx-crop'></i></a>
                <a href="javascript:void(0);" data-id="2" class="btn-delete" title="Remove" onclick="removeLeave('{{ $leave->id }}')"><i class="bx bx-trash me-1" style="color:red;"></i></a>

              </div>
            </td>
          </tr>

          @endforeach

        </tbody>
      </table>
    </div>
  </div>


</div>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>


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
</script>

<script>
  // Example AJAX functions for leave actions

  // Approve leave
  function approveLeave(id) {
    $.ajax({
      url: 'leave/approve/' + id,
      method: 'POST',
      data: {
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        // alert(response.message);
        // Optionally update UI or reload data
        swal("Done!", response.message, "success");
        //location.reload();
        window.location.href = "{{ url('leaves')}}";
      },
      error: function(xhr) {
        console.error('Error withdrawing leave:', xhr.responseText);
        // Handle errors
      }
    });
  }

  // Cancel leave
  function cancelLeave(id) {

    $.ajax({
      url: 'leave/cancel/' + id,
      method: 'POST',
      data: {
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        // alert(response.message);
        // Optionally update UI or reload data
        swal("Done!", response.message, "success");
        //location.reload();
        window.location.href = "{{ url('leaves')}}";
      },
      error: function(xhr) {
        console.error('Error withdrawing leave:', xhr.responseText);
        // Handle errors
      }
    });
  }

  // Withdraw leave
  function withdrawLeave(id) {

    $.ajax({
      url: 'leave/withdraw/' + id,
      method: 'POST',
      data: {
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        // alert(response.message);
        // Optionally update UI or reload data
        swal("Done!", response.message, "success");
        //location.reload();
        window.location.href = "{{ url('leaves')}}";
      },
      error: function(xhr) {
        console.error('Error withdrawing leave:', xhr.responseText);
        // Handle errors
      }
    });
  }


  // Remove leave
  function removeLeave(id) {
    $.ajax({
      url: 'leave/remove/' + id,
      method: 'POST',
      data: {
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        // alert(response.message);
        // Optionally update UI or reload data
        swal("Done!", response.message, "success");
        //location.reload();
        window.location.href = "{{ url('leaves')}}";
      },
      error: function(xhr) {
        console.error('Error withdrawing leave:', xhr.responseText);
        // Handle errors
      }
    });
  }
</script>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

@endsection