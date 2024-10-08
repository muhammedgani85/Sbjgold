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




  <!-- Form controls -->

  <div class="card">
    <h5 class="card-header" style="color:red;">Leave List(s)</h5>


    <div class="table-responsive text-nowrap">

      <table class="display" id="usersTable">
        <thead>
          <tr>
          <th>ID</th>
                <th>Type</th>
                <th>Interest Rate</th>
                <th>Months</th>
                <th>Status</th>
                <th>Loan Type</th>

          </tr>
        </thead>
        <tbody>
            @foreach($loanInterests as $loanInterest)
                <tr>
                    <td>{{ $loanInterest->id }}</td>
                    <td>{{ $loanInterest->type }}</td>
                    <td>{{ $loanInterest->interest_rate }}</td>
                    <td>{{ $loanInterest->months }}</td>
                    <td>{{ $loanInterest->status ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $loanInterest->loanType->loan_type }}</td>
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
