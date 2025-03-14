@extends('layouts/contentNavbarLayout')

@section('title', 'TeleCaller Management')

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
  <span class="text-muted fw-light" style="color:red !important;">TeleCaller Follow-up</span>
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
    <form method="GET" action="{{ route('telecaller.index') }}" class="mb-4">
    <div class="row">
        <!-- Date Range Filter -->
        <div class="col-md-3 mb-3">
            <label for="from_date" class="form-label">From:</label>
            <input type="date" name="from_date" id="from_date"
                   value="{{ request('from_date', now()->startOfMonth()->toDateString()) }}"
                   class="form-control">
        </div>

        <div class="col-md-3 mb-3">
            <label for="to_date" class="form-label">To:</label>
            <input type="date" name="to_date" id="to_date"
                   value="{{ request('to_date', now()->endOfMonth()->toDateString()) }}"
                   class="form-control">
        </div>

        <!-- Branch Filter (shown only for specific roles) -->
        @if(in_array(session('user_data')->role, [1, 9, 10]))
            <div class="col-md-2 mb-3">
                <label for="branch_id" class="form-label">Branch:</label>
                <select name="branch_id" id="branch_id" class="form-select">
                    <option value="all">All</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->branch_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <!-- Loan Type Filter -->
        <div class="col-md-2 mb-3" style="margin-top:30px;">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('telecaller.index') }}" class="btn btn-secondary">Clear</a>
        </div>
    </div>

    <!-- Submit Button -->

</form>





<table class="table">
    <thead>
        <tr>
          <th>#</th>
            <th>Name</th>

            <th>Unpaid</th>
            <th>Phone Number</th>
            <th>Loan No</th>
            <th>Branch</th>
            <th>Loan Created Date</th>

            <th>Unpaid Months</th>

        </tr>
    </thead>
    <tbody>
        @forelse($customerData as $customer)
            <tr>
            <td><a href="#" data-bs-toggle="modal" data-bs-target="#followUpModal" onclick="setCustomerId('<?php echo $customer['cust_id'] ?>','<?php echo $customer['loan_number'] ?>')"><i class="bx bx-pencil me-1"></i></a></td>
                <td>{{ $customer['first_name'].$customer['last_name']}}</td>
                <td>
                @if(!empty($customer['unpaid_months']))
                       {{ count($customer['unpaid_months']) }}
                    @else
                        No unpaid months
                    @endif
                </td>

                <td><a href="tel:{{ $customer['phone_number'] }}">{{ $customer['phone_number'] }}</a></td>
                <td>{{ $customer['loan_number'] }}</td>

                <td>{{ $customer['branch_name'] }}</td>
                <td>{{ \Carbon\Carbon::parse($customer['loan_created_date'])->format('Y-m-d') }}</td>
                <td>
                    @if(!empty($customer['unpaid_months']))
                        {{ implode(', ', array_map(function($month) {
                            return Carbon\Carbon::create()->month($month)->format('F');
                        }, $customer['unpaid_months'])) }}
                    @else
                        No unpaid months
                    @endif
                </td> <!-- Show unpaid months -->

            </tr>
        @empty
            <tr>
                <td colspan="7" style="color: red;">No customers found with unpaid interest for the selected date range.</td>
            </tr>
        @endforelse
    </tbody>
</table>



    </div>
  </div>
</div>

<!-- Model -->
 <!-- resources/views/content/telecaller/index.blade.php -->
<div class="modal fade" id="followUpModal" tabindex="-1" aria-labelledby="followUpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 style="color:red;margin-left:20px;">Previous Follow-Ups</h6>
                <ul class="list-group mb-3" id="previousFollowUps" style="max-height: 200px; overflow-y: auto;">
                <!-- AJAX response will be appended here -->
                </ul>
                <h5 class="modal-title" id="followUpModalLabel" style="color:green;margin-left:20px;">Add Follow-Up</h5>
                <form method="POST" action="{{ route('telecaller.store') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="customer_id" id="customer_id">
 <input type="hidden" name="loan_number" id="loan_number">
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <select name="reason" id="reason" class="form-select">
                            <option value="">Select a reason</option>
                            @foreach($reasons as $reason)
                                <option value="{{ $reason->name }}">{{ $reason->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="comments" class="form-label">Comments</label>
                        <textarea name="comments" id="comments" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="follow_date" class="form-label">Date</label>
                        <input type="date" name="follow_date" id="follow_date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Trigger button -->


<script>
    function setCustomerId(id,loan_number) {
        document.getElementById('customer_id').value = id;
        document.getElementById('loan_number').value = loan_number;
        loadPreviousFollowUps(id,loan_number);
    }

    function loadPreviousFollowUps(customerId, loanNumber) {

    $('#previousFollowUps').empty(); // Clear previous follow-up data

    // AJAX request with both customerId and loanNumber
    $.ajax({
        url: '/telecaller/follow-up?customer_id=' + customerId + '&loan_number=' + loanNumber,
        method: 'GET',
        success: function(response) {
            if (response.length) {
                response.forEach(function(followUp) {
                    $('#previousFollowUps').append(`
                        <li class="list-group-item">
                            <strong>Date:</strong> ${followUp.follow_date}<br>
                            <strong>Reason:</strong> ${followUp.reason}<br>
                            <strong>Comments:</strong> ${followUp.comments}<br>
                            <strong>Loan Number:</strong> ${followUp.loan_number}
                        </li>
                    `);
                });
            } else {
                $('#previousFollowUps').append('<li class="list-group-item">No previous follow-ups.</li>');
            }
        },
        error: function() {
            alert('Error retrieving follow-up data.');
        }
    });
}
</script>



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
