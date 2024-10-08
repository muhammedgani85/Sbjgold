@extends('layouts/contentNavbarLayout')


@section('title', 'New Leave')
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

  .holiday {
    padding: 10px;
    margin: 5px;
    color: green;
  }

  .past {
    background-color: #FFF;
    /* Different color for past holidays */
    color: red;
    /* Optional: change text color for better readability */
  }
</style>
@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Apply Leave </span> </h4>
<form id="leaveForm" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <!-- Basic -->
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Apply</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">

          <div class="input-group">
            <span class="input-group-text">Emp ID</span>
            <input type="text" aria-label="First name" name="customer_id" id="customer_id" class="form-control" readonly value="{{ $cus_id }} ">
            <input type="hidden" aria-label="First name" name="employee_id" id="employee_id" value="{{ $emp_id }} " class="form-control" readonly>
            <input type="hidden" aria-label="First name" name="location" id="location" value="{{ $location }} " class="form-control" readonly>


          </div>


          <div class="input-group">
            <label class="input-group-text" for="inputGroupSelect01">Leave Type</label>
            <select class="form-select" id="leave_type" name="leave_type">
              <option selected>Choose...</option>
              @foreach ($leaveTypes as $type )
              <option value="{{ $type->id }}">{{ $type->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="input-group">
            <span class="input-group-text">Start Date</span>
            <input type="date" aria-label="First name" name="start_date" id="start_date" class="form-control">

          </div>

          <div class="input-group">
            <span class="input-group-text">End Date</span>
            <input type="date" aria-label="First name" name="end_date" id="end_date" class="form-control">

          </div>
          <div class="input-group">
            <label class="input-group-text" for="inputGroupSelect01">Leave Reason</label>
            <select class="form-select" id="reason" name="reason">
              <option selected>Choose...</option>
              @foreach ($leavereason as $reason )
              <option value="{{ $reason->id }}">{{ $reason->reason }}</option>
              @endforeach
            </select>
          </div>

          <div class="input-group input-group-merge">
            <span class="input-group-text">Remarks</span>
            <textarea class="form-control" aria-label="With textarea" name="remarks" id="remarks"></textarea>
          </div>


          <div class="input-group">


            <button type="button" id="submitForm" class="btn rounded-pill btn-success">Apply</button>
            <button type="button" class="btn rounded-pill btn-danger">Reset</button>


          </div>


        </div>
      </div>
    </div>
</form>
<!-- Merged -->
<div class="col-md-6">
  <div class="card mb-4">
    <h5 class="card-header">Public Holidays</h5>

    <ul>
      @foreach ($holidays as $holiday)
      <li class="holiday {{ $holiday->isPast ? 'past' : '' }}"> {{ \Carbon\Carbon::parse($holiday->date)->format('F j, Y') }} - {{ $holiday->name }}</li>
      @endforeach
    </ul>
  </div>
</div>


</div>




<!-- Button with dropdowns & addons -->

<div class="card">
  <h5 class="card-header" style="color:red;">My Leaves</h5>


  <div class="table-responsive text-nowrap">

    <table class="display" id="usersTable">
      <thead>
        <tr>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Days</th>
          <th>Leave Type</th>
          <th>Leave Reason</th>
          <th>Apply Date</th>
          <th>Status</th>
          <th>Approved By</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($myleaves as $leave )
        <tr>
          <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d-m-Y') }}</td>
          <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d-m-Y') }}</td>
          <td>{{ \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1 }}</td>
          <td>{{ $leave->leaveType->name }}</td>
          <td>{{ $leave->leaveReason->reason }}</td>
          <td>{{ date('d-m-Y',strtotime($leave->created_at)) }}</td>

          <td class="text-left {{ $leave->status === 'Pending' ? 'text-danger' : ($leave->status === 'Approved' ? 'text-success' : 'text-warning') }}">
            {{ $leave->status }}
          </td>
          <td>{{ getUserName($leave->approved_by) }} </td>
        </tr>

        @endforeach

      </tbody>
    </table>
  </div>


  <!-- Custom file input -->






  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
  <script>
    $('#submitForm').click(function(e) {



      e.preventDefault();
      let formData = new FormData($('#leaveForm')[0]);

      $.ajax({
        url: "{{ route('leaves.store') }}",
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          // alert(response.success);
          swal("Done!", response.success, "success");
          //location.reload();
          window.location.href = "{{ url('leaves/create')}}";
        },
        error: function(response) {

          let errors = response.responseJSON.errors;
          $('#errorMessages').remove(); // Remove the previous error messages container
          let errorHtml = '<div id="errorMessages"><ul>';
          $.each(errors, function(key, value) {
            errorHtml += '<li>' + value + '</li>';
          });
          errorHtml += '</ul></div>';
          $('#leaveForm').before(errorHtml);

        }
      });

    });
  </script>
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

  @endsection