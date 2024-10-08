@extends('layouts/contentNavbarLayout')

@section('title', 'New Employee')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">New Application </span> </h4>
<form id="loanForm" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <!-- Basic -->
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Basic Information</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">

        <div class="input-group">
            <label class="input-group-text" for="inputGroupSelect01">Customer</label>
            <select class="form-select" id="customer_number" name="customer_number">
              <option selected>Choose...</option>
              @foreach ($customer as $cus )
              <option value="{{ $cus->id }}">{{ $cus->customer_id . ' -'.$cus->first_name.' '.$cus->first_name }}</option>

              @endforeach

            </select>
          </div>
          <div id="customer_info"  style="display:none;">

          <div class="input-group">
          <img src="{{asset('assets/images/sj_logo.png')}}" style ="width:200px;height:50px;" class="h-auto rounded-circle"/>


          </div>


          <table class="table table-bordered mt-4">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td><span id="initial"></span> <span id="first_name"></span> <span id="last_name"></span></td>
                    </tr>
                    <tr>
                        <th>Father Name</th>
                        <td><span id="father_name"></span></td>
                    </tr>
                    <tr>
                        <th>Spouse Name</th>
                        <td><span id="spouse_name"></span></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td><span id="gender"></span></td>
                    </tr>
                    <tr>
                        <th>DOB</th>
                        <td><span id="dob"></span></td>
                    </tr>
                    <tr>
                        <th>Marital Status</th>
                        <td><span id="marital_status"></span></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td><span id="phone_number"></span></td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td><span id="city"></span></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><span id="permanent_address"></span></td>
                    </tr>
                    <tr>
                        <th>Aadhar</th>
                        <td><span id="aadhar_number"></span></td>
                    </tr>
                </tbody>
            </table>
</div>
        </div>
      </div>
    </div>

    <!-- Merged -->
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Loan Details</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">



        <div class="input-group">
            <label class="input-group-text" for="inputGroupSelect01">Type</label>
            <select class="form-select" id="loan_type" name="loan_type">
              <option selected>Choose...</option>
              @foreach ($loan_type as $type )

              <option value="{{ $type->id }}" >{{ $type->loan_prefix . ' -'.$type->loan_type }}</option>

              @endforeach

            </select>
          </div>
          <!-- {{ $type->id === 1 ? 'selected' : '' }} value="{{ $loanNumber }}" -->
          <div class="input-group">
            <span class="input-group-text">Loan Number</span>
            <input type="text" aria-label="First name" name="loan_number" id="loan_number" class="form-control" readonly >

          </div>



          <div class="form-group">
          <label for="interest_type_id">Interest Type</label>
          <select class="form-control" id="interest_type_id" name="interest_type_id">
          <option selected>Choose...</option>
          <!-- Options will be populated via AJAX -->
          </select>
          </div>

          <div class="form-group" id="jewel_grams_group1">
            <label for="jewel_grams">Jewel Net Grams</label>
            <input type="number" name="jewel_net_grams" id="jewel_net_grams" class="form-control">
        </div>


          <div class="form-group" id="jewel_grams_group">
            <label for="jewel_grams">Jewel Grams</label>
            <input type="number" name="jewel_grams" id="jewel_grams" class="form-control">
        </div>


        <div class="form-group">
            <label for="total_loan_amount">Total Loan Amount</label>
            <input type="text" class="form-control" id="total_loan_amount" name="total_loan_amount" readonly>
        </div>
        <div class="form-group">
            <label for="total_interest_amount">Total Interest Amount <span style="color:red !important;">( Include Round Off)</span></label>
            <input type="text" class="form-control" id="total_interest_amount" name="total_interest_amount" readonly>
        </div>
        <div class="form-group">
            <label for="per_month_payable_amount">Per Month Payable Amount</label>
            <input type="text" class="form-control" id="per_month_payable_amount" name="per_month_payable_amount" readonly>
        </div>

        <div class="form-group">
            <label for="per_month_payable_amount">Total Amount <span style="color:red;">(Include interest)</span></label>
            <input type="text" class="form-control" id="total_include_int_amount" name="total_include_int_amount" readonly>
        </div>

        <div class="form-group">
            <label for="per_month_payable_amount">Document Charge</label>
            <input type="text" class="form-control" id="document_charge" name="document_charge" readonly>
            <input type="hidden" class="form-control" id="location_id" name="location_id" value="{{ $location }}">
        </div>

        </div>




      </div>
    </div>


  </div>


  <div class="row">
    <!-- Multiple inputs & addon -->



    <!-- Speech To Text -->
    <div class="col-md-12">
      <div class="card mb-12">
        <h5 class="card-header">Documents</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">

          <div class="input-group">
            <label class="input-group-text" for="document">Photo</label>
            <input type="file" class="form-control" id="customer_photo" name="customer_photo">
          </div>



          <div class="input-group">
            <label class="input-group-text" for="document">Others</label>
            <input type="file" class="form-control" id="customer_other" name="customer_other">
          </div>
        </div>
      </div>


    </div>


  </div>


  <!-- Button with dropdowns & addons -->



  <!-- Custom file input -->

  <div class="row" align="centre">
    <div class="col-12">
      <div class="card">

        <div class="card-body demo-vertical-spacing demo-only-element">
          <div class="input-group">


            <button type="button" id="submitLoanForm" class="btn rounded-pill btn-success">Save</button>
            <button type="button" class="btn rounded-pill btn-danger">Reset</button>


          </div>


        </div>
      </div>
    </div>
  </div>

  </form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $('#submitForm').click(function(e) {

    e.preventDefault();
    let formData = new FormData($('#customerForm')[0]);

    $.ajax({
      url: "{{ route('customers.store') }}",
      method: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        // alert(response.success);
        swal("Done!", response.success, "success");
        //location.reload();
        window.location.href = "{{ url('/customers')}}";
      },
      error: function(response) {

        let errors = response.responseJSON.errors;
        $('#errorMessages').remove(); // Remove the previous error messages container
        let errorHtml = '<div id="errorMessages"><ul>';
        $.each(errors, function(key, value) {
          errorHtml += '<li>' + value + '</li>';
        });
        errorHtml += '</ul></div>';
        $('#customerForm').before(errorHtml);

      }
    });

  });
</script>

<script>
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
    return true;
  }
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
            url: '{{ route("users.softDelete", "") }}/' + userId,
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
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('#customer_number').change(function() {
            var customerNumber = $(this).val();
            if (customerNumber) {
                $.ajax({
                    url: '{{ route("customer.info") }}',
                    type: 'GET',
                    data: { customer_number: customerNumber },
                    success: function(response) {
                        if (response.status == 'success') {
    $('#initial').text(response.data.initial);
    $('#first_name').text(response.data.first_name);
    $('#last_name').text(response.data.last_name);
    $('#father_name').text(response.data.father_name);
    $('#spouse_name').text(response.data.spouse_name);
    $('#gender').text(response.data.gender);
    $('#dob').text(response.data.dob);
    $('#marital_status').text(response.data.marital_status);
    $('#phone_number').text(response.data.phone_number);
    $('#city').text(response.data.city);
    $('#permanent_address').text(response.data.permanent_address);
    $('#aadhar_number ').text(response.data.aadhar_number);


                            $('#customer_info').show();
                        } else {
                            alert(response.message);
                            $('#customer_info').hide();
                        }
                    }
                });
            } else {
                $('#customer_info').hide();
            }
        });

   // Loan Type Change Function


        $('#loan_type').change(function() {
        var loanTypeId = $('#loan_type').val();

        $('#loan_number').val('');
            $('#interest_type_id').empty().append('<option selected>Choose...</option>');
            $('#jewel_grams').val('');
            $('#total_loan_amount').val('');
            $('#total_interest_amount').val('');
            $('#per_month_payable_amount').val('');
        if (loanTypeId) {
            $.ajax({
                url: "{{ route('fetchLoanDetails') }}",
                type: "POST",
                data: {
                    loan_type_id: loanTypeId,

                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    // Update loan number
                    $('#loan_number').val(data.loan_number);

                    // Update loan interests
                    $('#interest_type_id').empty();
                    $('#interest_type_id').append('<option selected>Choose...</option>');
                    $.each(data.interests, function(key, interest) {
                        $('#interest_type_id').append('<option value="'+ interest.id +'">'+ interest.type +' -'+ interest.months +' Month - Rate : '+ interest.interest_rate +' Paisa</option>');
                    });

                    if (loanTypeId == 1) { // Gold Loan
                        $('#jewel_grams_group').show();
                        $('#jewel_grams_group1').show();
                        $('#total_loan_amount').prop('readonly', true);
                    } else { // Other loan types
                        $('#jewel_grams_group').hide();
                        $('#jewel_grams_group1').hide();
                        $('#total_loan_amount').prop('readonly', false);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        } else {
            $('#loan_number').val('');
            $('#interest_type_id').empty();
            $('#interest_type_id').append('<option selected>Choose...</option>');
        }
    });


    // Loan Interest Calculation

    $('#interest_type_id').change(function() {
            var interestTypeId = $(this).val();
            /* var loanAmount = parseFloat($('#loan_amount').val()); */
            var jewelGrams = parseFloat($('#jewel_grams').val());

            if (!interestTypeId || !jewelGrams) {
                return;
            }


            $.ajax({
                url: '{{ route("fetchInterestDetails") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    interest_type_id: interestTypeId
                },
                success: function(response) {
                    var perGramAmount = parseFloat(response.per_gram_amount);
                    var loanAmount =  0; //parseFloat(response.loanAmount);
                    var months = parseInt(response.months);
                    var interestRate = parseFloat(response.interest_percentage);
                    var interestPer = parseFloat(response.interest_rate);
                    var daysInMonth = 30; // Assuming 30 days in a month
                    var daysInYear = 365; // Assuming 365 days in a year


                    var totalLoanAmount = loanAmount + (jewelGrams * perGramAmount);
                    var totalInterestAmount = (totalLoanAmount * interestRate * (months * daysInMonth) / daysInYear) / 100;
                    //var totalInterestAmount = ((totalLoanAmount * interestPer / 100) * months)/ 365;
                    totalInterestAmount = roundUpToNearest10(totalInterestAmount);
                    var perMonthPayableAmount = (totalLoanAmount + totalInterestAmount) / months;

                    $('#loan_amount').val(loanAmount.toFixed(2));
                    $('#total_loan_amount').val(totalLoanAmount.toFixed(2));
                    if(totalInterestAmount < 100){
                      $('#total_interest_amount').val(100);
                    }else{
                      $('#total_interest_amount').val(totalInterestAmount);
                    }
                    $('#total_interest_amount').val(totalInterestAmount);
                    $('#per_month_payable_amount').val(roundUpToNearest10(perMonthPayableAmount.toFixed(2)));
                    $('#total_include_int_amount').val(totalLoanAmount + totalInterestAmount);
                    $('#document_charge').val(response.document_charge);


                }

            });
                  function roundUpToNearest10(amount) {
                  return Math.ceil(amount / 10) * 10;
                  }
        });

        $('#loan_amount, #jewel_grams').on('input', function() {
            $('#interest_type_id').trigger('change');
        });

  // Other Loan Amount Calculation
  $('#interest_type_id, #total_loan_amount').change(function() {
        calculateAmounts();
    });

    function calculateAmounts() {
        var loanTypeId = $('#loan_type').val();
        var interestTypeId = $('#interest_type_id').val();
        var loanAmount = $('#total_loan_amount').val();

        if (!loanTypeId || !interestTypeId || !loanAmount) return;

        var interestRate = $('#interest_type_id option:selected').data('interest-rate');
        var months = $('#interest_type_id option:selected').data('months');

        if (loanTypeId != 1) { // Not Gold Loan
            $.ajax({
                url: '/calculate-loan-amounts',
                type: 'POST',
                data: {
                    loan_type_id: loanTypeId,
                    interest_type_id: interestTypeId,
                    total_loan_amount: loanAmount,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#total_interest_amount').val(response.total_interest_amount);
                    $('#per_month_payable_amount').val(response.per_month_payable_amount);
                     $('#total_include_int_amount').val(loanAmount + response.per_month_payable_amount);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
    }


 // Save Loan
 $('#submitLoanForm').click(function(e) {
    e.preventDefault(); // Prevent default form submission

    // Show the confirmation popup
    swal({
        title: "Are you sure?",
        text: "Do you want to proceed with the loan submission?",
        icon: "warning",
        buttons: {
            cancel: {
                text: "Cancel",
                value: null,
                visible: true,
                className: "btn btn-danger",
                closeModal: true
            },
            confirm: {
                text: "Confirm",
                value: true,
                visible: true,
                className: "btn btn-success",
                closeModal: false
            }
        }
    }).then((isConfirm) => {
        if (isConfirm) {
            // User clicked "Confirm"
            var formData = new FormData($('#loanForm')[0]);

            $.ajax({
                url: '/save-loan',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    swal({
                        title: "Success!",
                        text: "Loan saved successfully.",
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: "OK",
                                className: "btn btn-success"
                            }
                        }
                    }).then(() => {
                        // Optionally, clear the form or redirect
                        window.location.href = '/loans/create'; // Redirect to loan list or any other page
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    swal({
                        title: "Error!",
                        text: "Error saving loan.",
                        icon: "error",
                        buttons: {
                            confirm: {
                                text: "OK",
                                className: "btn btn-danger"
                            }
                        }
                    });
                }
            });
        } else {
            // User clicked "Cancel"
            swal({
                title: "Cancelled",
                text: "Your loan submission was cancelled.",
                icon: "info",
                buttons: {
                    confirm: {
                        text: "OK",
                        className: "btn btn-primary"
                    }
                }
            });
        }
    });
});







    });
</script>
<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://unpkg.com/sweetalert/dist/sweetalert.min.css">

<!-- SweetAlert JS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection
