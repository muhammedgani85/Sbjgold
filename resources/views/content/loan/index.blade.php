@extends('layouts/contentNavbarLayout')

@section('title', 'Customer Management')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection
@php
use Carbon\Carbon;
@endphp
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Include other styles here -->
@section('content')
<h4 class="py-0 mb-4">
  <span class="text-muted fw-light" style="color:red !important;">Loans</span>
</h4>

<div class="row">
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card" style="background-color: #FED8B1;color:#000;font-weight:bold;">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Loans (Total)</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $total =  $loans->count();  }}</h4> / &nbsp;
                <small class="text-danger font-weight-bold">{{ isset($loans)?$loans->where('status','Dispatch')->sum('total_loan_amount'):"0" }}</small>
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
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $todayLoans;  }}</h4> / &nbsp;
                <small class="text-danger font-weight-bold">{{ isset($loans)?$loans->where('status','Dispatch')->where('created_at', '>=', Carbon::today())->sum('total_loan_amount'):"0" }}</small>
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
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $weekLoans;  }}</h4> / &nbsp;
                <small class="text-danger font-weight-bold">{{ isset($loans)?$loans->where('status','Dispatch')->where('created_at', '>=', Carbon::now()->startOfWeek())->sum('total_loan_amount'):"0" }}</small>
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
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $monthLoans;  }}</h4> / &nbsp;
                <small class="text-danger font-weight-bold">{{ isset($loans)?$loans->where('status','Dispatch')->where('created_at', '>=', Carbon::now()->startOfMonth())->sum('total_loan_amount'):"0" }}</small>
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
    <div class="table-responsive text-nowrap">

      <table class="table" id="usersTable">
        <thead>
          <tr>
             <th>Image</th>
            <th>Loan#</th>
            <th>Cust.ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Amount</th>
            <th>Quality</th>
            <th>Scheme</th>
            <th>Gram</th>
            <th>Net Gram</th>
            <th>L.Date</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
        @foreach ( $loans as $loan)
        <tr>
        <td>

          <a href="{{ asset('storage/' . $loan->customer_photo) }}" target="_blank">
          <img src="{{ $loan->customer_photo ? asset('storage/' . $loan->customer_photo) : asset('assets/images/sj_logo.png') }}"  alt="Image" style="width:50px; height:50px; border-radius:50%;">
          </a>

          </td>
          <td>{{ $loan->loan_number }}</td>
          <td>{{ $loan->customer->customer_id }}</td>
          <td>{{ $loan->customer->first_name }} {{ $loan->customer->last_name }}</td>
          <td>{{ $loan->location->branch_name }}</td>
          <td>{{ $loan->total_loan_amount }}</td>
          <td>@php
          $qualities = explode(',', $loan->jewel_quality); // Convert string to array
          $count_916 = count(array_filter($qualities, fn($q) => trim($q) === '916'));
          $count_22ct = count(array_filter($qualities, fn($q) => trim($q) === '22ct'));
          $count_other = count(array_filter($qualities, fn($q) => trim($q) === 'Others'));
          @endphp
          916: {{ $count_916 }}<br> 22ct: {{ $count_22ct }} <br>Others : {{ $count_other }}
          </td>

          <td>{{ $loan->interest_month." - Month" }}</td>
          <td>{{ $loan->jewel_grams }}</td>
          <td>{{ $loan->jewel_net_grams }}</td>

          <td>{{ $loan->created_at }}</td>
          @php
    switch ($loan->status) {
        case 'New':
            $statusClass = 'status-new';
            break;
        case 'Approved':
            $statusClass = 'status-approved';
            break;
        case 'Rejected':
            $statusClass = 'status-rejected';
            break;
        case 'Dispatch':
            $statusClass = 'status-dispatch';
            break;
        case 'Withdraw':
            $statusClass = 'status-withdraw';
            break;
        default:
            $statusClass = '';
            break;
    }
@endphp

<td class="{{ $statusClass }}">
    {{ $loan->status }}
</td>


          <td>

   @if($loan->status!='Rejected' &&  $loan->status!='New')


          <a href="{{ route('loans.customer_interest_list1', $loan->loan_number) }}" title="Interest List"><i class='bx bx-list-ol'></i></a>


  <a href="javascript:void(0);"
     class="pay-interest"
     data-id="{{ $loan->loan_number }}"
     data-start-date="{{ date('Y-m-d',strtotime($loan->created_at)) }}"
     data-interest-amount="{{ number_format((float)$loan->total_interest_amount / $loan->interest_month, 2, '.', ''); }}"
     title="Pay Interest">
    <i class='bx bx-rupee' style="color:red;"></i>
  </a>
  <a  title="Action" data-bs-toggle="modal" data-bs-target="#actionModal" data-customer-number="{{ $loan->customer->customer_id }}"
  data-loan-number="{{ $loan->loan_number }}"><i class='bx bx-message-edit'></i></a>
  @if($loan->status!='Released')
  <a  title="Release Loan" data-bs-toggle="modal" data-bs-target="#actionModal1" data-customer-number="{{ $loan->customer->customer_id }}"
  data-loan-number="{{ $loan->loan_number }}" data-loan-amount="{{ $loan->total_loan_amount }}"><i class='bx bx-power-off'></i></a>
  @endif

  @if($loan->status=='Released')
  <a  title="Reverese Loan" data-bs-toggle="modal" data-bs-target="#revokeModal" data-customer-number="{{ $loan->customer->customer_id }}"
  data-loan-number="{{ $loan->loan_number }}" ><i class='bx bx-revision'></i></a>
  @endif



  @endif

  <a  title="Receipt Loan" href="{{ route('new_release-letter', $loan->loan_number) }}" target="_blank"><i class='bx bx-printer'></i></a>
  @if($is_check)
  <a  title="Edit Loan" href="{{ route('new_release-letter', $loan->loan_number) }}" target="_blank"><i class='bx bx-pencil'></i></a>
   @endif
          </td>

        </tr>

        @endforeach

        </tbody>

    </table>
  </div>
</div>


</div>


<!-- Modal -->
<div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionModalLabel">Loan Action - <span id='cust_name'></span> - <span id='loan_number'></span></h5>


                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="actionForm" method="POST" action="{{ route('loans.action_customer') }}">
                @csrf
                <div class="modal-body">
                    <!-- Action Type Field -->
                    <div class="mb-3">
                        <label for="action_type" class="form-label">Action Type</label>
                        <select id='action_type' name="action_type" class="form-controller">
                          <option value="1">First Action</option>
                          <option value="2">Second Action</option>
                          <option value="3">Final Action</option>

                        </select>

                    </div>

                    <!-- Hidden Fields for Loan and Customer -->
                    <input type="hidden" name="loan_number" id="loan_number" value="">
                    <input type="hidden" name="customer_number" id="customer_number" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Loan Release Bootstrap Modal -->
<div class="modal fade" id="actionModal1" tabindex="-1" aria-labelledby="loanReleaseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="loanReleaseModalLabel">Loan Release Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="loanReleaseForm" action="/release-loan" method="POST">
      @csrf
      <!-- Loan Details in Header Section -->
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <strong>Customer Name:</strong> <input type="text"id="release_customerName" name="release_customerName" readonly>
          </div>
          <div class="col-md-6">
            <strong>Loan Number:</strong> <input type="text" id="release_loanNumber" name="release_loanNumber" readonly>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-6">
            <strong>Amount:</strong> <input type="text" id="release_loanAmount" name="release_loanAmount" readonly>
          </div>
          <div class="col-md-6">
            <strong>Interest:</strong> <input type="text" id="release_loanInterest" name="release_loanInterest">
          </div>
        </div>
        <hr />

        <!-- Loan Release Form -->


          <div class="mb-3">
            <label for="waiveOff" class="form-label">Waive Off:</label>
            <input type="text" class="form-control" name="waive_off" id="waiveOff">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
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
        <label for="month">Choose Month</label>
        <select class="form-control" id="payment_month" name="payment_month">
            <option value="">Select Month</option>
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
    </div>

    <div class="form-group">
        <label for="paymentAmount">Interest Amount</label>
        <input type="number" class="form-control" id="paymentAmount" name="interest_amount" placeholder="Interest">
    </div>

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


<!-- Revoke Modal -->

<!-- Modal HTML -->
<div class="modal fade" id="revokeModal" tabindex="-1" aria-labelledby="actionModal1Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionModal1Label">Revoke Loan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="revokeLoanForm">
                    @csrf
                    <input type="hidden" name="revoke_loan_number" id="revoke_loan_number">
                    <input type="hidden" name="revoke_customer_id" id="revoke_customer_id">

                    <!-- Revoke Reason Dropdown -->
                    <div class="mb-3">
                        <label for="revokeReason" class="form-label">Revoke Reason</label>
                        <select class="form-control" id="revokeReason" name="revoke_reason">
                        <option value="error">Error in Loan</option>
                        <option value="customer_request">Customer Request</option>
                        <option value="other">Other</option>
                        <option value="duplicate_loan">Duplicate Loan Entry</option>
                        <option value="incorrect_amount">Incorrect Loan Amount</option>
                        <option value="fraudulent_activity">Fraudulent Activity</option>
                        <option value="missed_documents">Missing Documents</option>
                        <option value="loan_disqualified">Loan Disqualified</option>
                        <option value="legal_issue">Legal Issues</option>
                        </select>
                    </div>

                    <!-- Remarks Field -->
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-danger">Revoke Loan</button>
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





    // Payment Amount

   // Capture the interest amount when a month is selected
  /*  $(document).ready(function() {
    // Event handler for when a month is selected
    $(document).on('change', 'input[name="  "]', function() {
        var interestAmount = $(this).data('interest');  // Get interest amount from the selected radio button

        // Check if interestAmount exists
        if (interestAmount) {
            $('#paymentAmount').val(interestAmount);  // Set the paymentAmount input to the selected interest amount
            console.log('Interest Amount Set:', interestAmount);
        } else {
            alert("Interest amount not available for this month.");
        }
    }); */

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
        payment_month: $('#payment_month').val(),
        payment_amount: $('#paymentAmount').val(),
        payment_method: $('#paymentType').val(),
        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
        };

        // AJAX request to submit the form
          $.ajax({
          url: '{{ route("interest.payment.paid", "") }}',
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



</script>
<script>
  $(document).ready(function () {
    // Event handler for the "pay-interest" button click
    $('.pay-interest').on('click', function () {
        var loanNumber = $(this).data('id'); // Get loan number from data-id
        var loanStartDate = $(this).data('start-date'); // Get loan start date from data-start-date
        var interestAmount = $(this).data('interest-amount'); // Get interest amount

        // Populate loan number in the modal
        $('#loanNumber').val(loanNumber);

        // Call function to dynamically generate the months based on loan start date
      //  generateMonths(loanStartDate, interestAmount);

        // Open the modal
        $('#interestPaymentModal').modal('show');
    });

    // Function to generate months based on loan start date
    function generateMonths(startDate, interestAmount) {
        var start = new Date(startDate); // Convert to Date object
        var today = new Date(); // Get current date

        var tbody = $('#interestPaymentForm tbody');
        tbody.empty(); // Clear previous entries

        var monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        while (start <= today) {
            var monthName = monthNames[start.getMonth()]; // Get month name
            var monthNumber = `${start.getFullYear()}-${start.getMonth() + 1}`; // Year-Month format

            // Append each month as a new row
            tbody.append(`
              <tr>
                <td>${monthName} ${start.getFullYear()}</td>
                <td>
                  <input
                    type="text"
                    value="${interestAmount}"
                    class="form-control interest-amount"
                    data-month="${monthNumber}">
                </td>
                <td>
                  <input
                    type="radio"
                    name="payment_month"
                    value="${monthNumber}"
                    data-interest="${interestAmount}"
                    required>
                </td>
              </tr>
            `);

            // Move to the next month
            start.setMonth(start.getMonth() + 1);
        }
    }

    // Update interest amount in the selected payment month
    $(document).on('input', '.interest-amount', function () {
        let updatedAmount = $(this).val();
        let monthNumber = $(this).data('month');

        // Update the radio button's data-interest attribute
        $(`input[name="payment_month"][value="${monthNumber}"]`).data('interest', updatedAmount);
    });

    // Update payment amount when a radio button is selected
    $(document).on('change', 'input[name="payment_month"]', function () {
        let selectedInterest = $(this).data('interest');
        $('#paymentAmount').val(selectedInterest); // Update the payment amount input field
    });
});

</script>

<script>
    document.getElementById('actionModal').addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget;

        // Extract data attributes from the button
        var loanNumber = button.getAttribute('data-loan-number');
        var customerNumber = button.getAttribute('data-customer-number');

        // Update the hidden fields in the modal form
        document.getElementById('loan_number').value = loanNumber;
        document.getElementById('customer_number').value = customerNumber;

        document.getElementById('cust_name').innerHTML = loanNumber;
        document.getElementById('loan_number').innerHTML = customerNumber;




    });


//Loan Release
document.getElementById('actionModal1').addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget;

        // Extract data attributes from the button
        var loanNumber = button.getAttribute('data-loan-number');
        var customerNumber = button.getAttribute('data-customer-number');
        var release_loanAmount = button.getAttribute('data-loan-amount');

        // Update the hidden fields in the modal form
        document.getElementById('release_loanNumber').value = loanNumber;
        document.getElementById('release_customerName').value = customerNumber;
        document.getElementById('release_loanAmount').value = release_loanAmount;






    });



// Loan Relased Store

$('#loanReleaseForm').on('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    swal({
        title: "Are you sure?",
        text: "Do you want to release this loan?",
        icon: "warning",
        buttons: {
            cancel: {
                text: "Cancel",
                value: false,
                visible: true,
                className: "btn-secondary",
                closeModal: true,
            },
            confirm: {
                text: "Yes, Release it!",
                value: true,
                visible: true,
                className: "btn-primary",
                closeModal: false,
            },
        },
        dangerMode: true,
    }).then((willRelease) => {
        if (willRelease) {
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function (response) {
                    swal("Success", "Loan has been released successfully!", "success")
                        .then(() => {
                            // Redirect to release letter page
                            $('#actionModal1').modal('hide');
                            window.open(`/release-letter/${response.loan_id}`, '_blank');
                        });
                },
                error: function (xhr) {
                    let errorMessage = xhr.responseJSON && xhr.responseJSON.message
                        ? xhr.responseJSON.message
                        : 'Failed to release the loan.';
                    swal("Error", errorMessage, "error");
                },
            });
        }
    });
});



$(document).ready(function() {
    // Open the modal and pass the data
    $('a[data-bs-toggle="modal"]').on('click', function() {
        var customerId = $(this).data('customer-number');
        var loanNumber = $(this).data('loan-number');

        // Set values in the modal
        $('#revoke_customer_id').val(customerId);
        $('#revoke_loan_number').val(loanNumber);
    });

    // Handle the form submission
    $('#revokeLoanForm').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission

        // Get form data
        var formData = $(this).serialize();

        // Confirm the action with SweetAlert
        swal({
            title: "Are you sure?",
            text: "Do you want to revoke this loan?",
            icon: "warning",
            buttons: ["Cancel", "Yes, Revoke it!"],
            dangerMode: true,
        }).then((willRevoke) => {
            if (willRevoke) {
                // Send the AJAX request
                $.ajax({
                    url: '/revoke-loan', // Update with the correct route
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        swal("Success", "Loan has been revoked successfully!", "success")
                            .then(() => {
                                // Close the modal
                                $('#actionModal1').modal('hide');
                                // Optionally reload the page or update the UI
                                location.reload();
                            });
                    },
                    error: function(xhr) {
                        swal("Error", "Failed to revoke the loan. Please try again.", "error");
                    }
                });
            }
        });
    });
});




</script>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

@endsection
