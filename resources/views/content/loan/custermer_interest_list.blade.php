@extends('layouts/contentNavbarLayout')

@section('title', 'Loan Management')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Include other styles here -->
@section('content')
<h4 class="py-0 mb-4">
  <span class="text-muted fw-light" style="color:red !important;">Loans Interest</span>
</h4>
@php
use Carbon\Carbon;
@endphp

<div class="row">


  <!-- Form controls -->

  <div class="card">
    <div class="table-responsive text-nowrap">

      <table class="table" id="usersTable">
        <thead>
          <tr>

            <th>Loan No</th>
            <th>Month</th>
            <th>Interest Amount</th>
            <th>Payment Method</th>
            <th>Paid Date</th>
            <th>Action</th>

          </tr>
        </thead>

        <tbody>
          @if($interst_list->isNotEmpty())
          @foreach ($interst_list as  $list )

          <tr>
            <td>{{ isset($list->loan_id)?$list->loan_id:"" }} </td>
            <td>
              @php

              $monthNumber = isset($list->month)?$list->month:""; // Example month number
              $monthName = Carbon::createFromFormat('m', $monthNumber)->format('F');
              @endphp
              {{ $monthName }} </td>
            <td>{{ isset($list->interest_amount)?$list->interest_amount:"" }} </td>
            <td>{{ isset($list->payment_method)?$list->payment_method:"" }} </td>
            <td>{{ isset($list->created_at)?$list->created_at:"" }} </td>
            <td><a href="{{ route('loans.interest_invoice', ['loan_id' => $list->loan_id]) }}?month={{ $list->month }}" target="_blank">
    View
</a></td>
          </tr>

          @endforeach
          @endif

        </tbody>

    </table>
  </div>
</div>


</div>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Popper.js for Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Pay Interest Modal -->
<!-- Modal -->
<div class="modal fade" id="interestPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Interest Payment</h5>
        <button type="button"  class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="interestPaymentForm">
          <div class="form-group">
            <label for="loanNumber">Loan Number</label>
            <input type="text" class="form-control" id="loanNumber" name="loan_number" readonly>
          </div>

          <div class="form-group">
            <label>Choose Month to Pay Interest</label>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Month</th>
                  <th>Interest Due</th>
                  <th>Pay</th>
                </tr>
              </thead>
              <tbody>
                <!-- Rows will be dynamically added here by JavaScript -->
              </tbody>
            </table>
          </div>

          <input type="hidden" class="form-control" id="paymentAmount" name="payment_amount" required>

          <div class="form-group">
            <label for="paymentType">Payment Method</label>
            <select class="form-control" id="paymentType" name="payment_method" required>
              <option value="cash">Cash</option>
              <option value="gpay">GPay</option>
              <option value="bank_transfer">Bank Transfer</option>
            </select>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Payment</button>
          </div>
        </form>
      </div>
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
  $(document).ready(function() {
    $('.btn-delete').on("click", function() {
      var $this = $(this);
      swal({
        title: "InActive?",
        text: "Please ensure and then confirm!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
      }).then(function(e) {
        if (e.value) {
          var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          var userId = $this.data('id');

          $.ajax({
            type: 'DELETE',
            url: '{{ route("customers.softDelete", "") }}/' + userId,
            data: {
              _token: CSRF_TOKEN
            },
            dataType: 'JSON',
            success: function(results) {
              if (results.success) {
                swal("Done!", results.message, "success");
                setTimeout(function() {
                  location.reload()
                }, 2000);
              } else {
                swal("Error!", results.message, "error");
              }
            },
            error: function(xhr) {
              console.log(xhr.responseText);
            }
          });
        }
      });
    });

  });



</script>

<script>
$(document).ready(function() {
    $('.pay-interest').on('click', function() {
        var loanNumber = $(this).data('id'); // Get loan number from data-id
        var loanStartDate = $(this).data('start-date'); // Get loan start date from data-start-date
        var interestAmount = $(this).data('interest-amount'); // Get interest amount

        // Populate loan number in the modal
        $('#loanNumber').val(loanNumber);

        // Call function to dynamically generate the months based on loan start date
        generateMonths(loanStartDate, interestAmount);

        // Open the modal
        $('#interestPaymentModal').modal('show');
    });

    // Function to generate months based on loan start date
    function generateMonths(startDate, interestAmount) {
        var start = new Date(startDate); // Convert to Date object
        var today = new Date(); // Get current date

        var tbody = $('#interestPaymentForm tbody');
        tbody.empty(); // Clear previous entries

        var interestAmount = interestAmount; // You can make this dynamic
        var monthNames = ["January", "February", "March", "April", "May", "June",
                          "July", "August", "September", "October", "November", "December"];

        while (start <= today) {
            var monthName = monthNames[start.getMonth()]; // Get month name
            var monthNumber = start.getMonth() + 1; // Get month number (1-12)

            // Append each month as a new row
            tbody.append(`
              <tr>
                <td>${monthName} ${start.getFullYear()}</td>
                <td>${interestAmount}</td>
                <td><input type="radio" name="payment_month" value="${monthNumber}" data-interest="${interestAmount}"required></td>
              </tr>
            `);

            // Move to the next month
            start.setMonth(start.getMonth() + 1);
        }
    }




    // Payment Amount

   // Capture the interest amount when a month is selected
   $(document).ready(function() {
    // Event handler for when a month is selected
    $(document).on('change', 'input[name="payment_month"]', function() {
        var interestAmount = $(this).data('interest');  // Get interest amount from the selected radio button

        // Check if interestAmount exists
        if (interestAmount) {
            $('#paymentAmount').val(interestAmount);  // Set the paymentAmount input to the selected interest amount
            console.log('Interest Amount Set:', interestAmount);
        } else {
            alert("Interest amount not available for this month.");
        }
    });

    // On form submit, check if paymentAmount is set
    $('#interestPaymentForm').on('submit', function(e) {
        e.preventDefault();  // Prevent form submission for now

        var paymentAmount = $('#paymentAmount').val();
        console.log('Payment Get : ' +paymentAmount);
        if (!paymentAmount) {
            alert("Please select a valid month to set the payment amount.");
            return;  // Stop form submission if payment amount is not set
        }

        // Collect form data (assuming other fields are validated)
        var formData = {
        loan_number: $('#loanNumber').val(),
        payment_month: $('input[name="payment_month"]:checked').val(),
        payment_amount: $('#paymentAmount').val(),
        payment_method: $('#paymentType').val(),
        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
        };

        // AJAX request to submit the form
          $.ajax({
          url: '{{ route("interest.payment.store", "") }}',
          method: 'POST',
          data: formData,
          success: function(response) {
          if (response.success) {
            alert(response.success); // Display success message
            $('#interestPaymentModal').modal('hide'); // Close modal
            location.reload(); // Optionally reload page or update UI
          }
          },
          error: function(xhr) {
          console.log(xhr.responseText); // Log errors if any
          }
          });
    });
});

});

</script>


<script>


</script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

@endsection
