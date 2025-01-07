@extends('layouts/contentNavbarLayout')

@section('title', 'Customer Management')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection
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
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $total =  $loans->count();  }}</h4>
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
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $todayLoans;  }}</h4>
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
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $weekLoans;  }}</h4>
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
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $monthLoans;  }}</h4>
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
    <div class="table-responsive text-nowrap">

      <table class="table" id="usersTable">
        <thead>
          <tr>
             <th>Image</th>
            <th>Loan No</th>
            <th>Cust.ID</th>
            <th>Cust.Name</th>
            <th>Location</th>
            <th>Loan Amount</th>
           <!--  <th>Type</th> -->
            <th>Int.Scheme</th>
            <th>Int / Month</th>
            <th>L.Date</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
        @foreach ( $loans as $loan)
        <tr>
        <td>
          @if($loan->customer_photo!=NULL)
          <a href="{{ asset('storage/' . $loan->customer_other) }}" target="_blank">
           <img src="{{ asset('storage/' . $loan->customer_other) }}" alt="Image" style="width:100px; height:100px;border:1px solid lightgrey;border-radius: 25px;">
          </a>
           @else
           No Image
           @endif
          </td>
          <td>{{ $loan->loan_number }}</td>
          <td>{{ $loan->customer->customer_id }}</td>
          <td>{{ $loan->customer->first_name }} {{ $loan->customer->last_name }}</td>
          <td>{{ $loan->location->branch_name }}</td>
          <td>{{ $loan->total_loan_amount }}</td>
          <!-- <td>{{ $loan->loanType->loan_types }}</td> -->

          <td>{{ $loan->interest_month." - Month" }}</td>
          <td>{{   number_format((float)$loan->total_interest_amount / $loan->interest_month, 2, '.', '');  }}</td>
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

          <!-- <a href="javascript:void(0);" data-id="{{ $loan->loan_number }}"  title="view"><i class='bx bx-show'></i></i></a>  -->
          <a href="{{ route('loans.customer_interest_list', $loan->loan_number) }}" title="Interest List"><i class='bx bx-list-ol'></i></a>
          <!-- <a href="http://127.0.0.1:8000/customers/2/edit" title="Pay Interest"><i class='bx bx-rupee' style="color:red;" ></i></a> -->

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
