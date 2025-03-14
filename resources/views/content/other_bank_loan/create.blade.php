@extends('layouts/contentNavbarLayout')

@section('title', 'New Employee')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">New Other Bank Application </span> </h4>
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

          <div class="" align="center">
          <img id="userImage"  style="width:100px; height:100px; border-radius: 50%;" class="h-auto" alt="User Image" >





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
            <select class="form-select" id="customer_loan_no" name="customer_loan_no">
            <option value="">Select a Loan Number</option>


            </select>
          </div>


          <div class="input-group">
            <label class="input-group-text" for="inputGroupSelect01">Bank</label>
            <select class="form-select" id="bank_id" name="bank_id">
              <option selected>Choose...</option>
              @foreach ($banks as $bank )
              <option value="{{ $bank->id }}">{{ $bank->bank_name . ' -'.$bank->location }}</option>

              @endforeach

            </select>
          </div>


          <div class="input-group">
            <span class="input-group-text">Bank Loan Number</span>
            <input type="text" aria-label="First name" name="bank_loan_number" id="bank_loan_number" class="form-control" >

          </div>



          <div class="form-group">
          <label for="interest_type_id">Rate of Interest</label>

          <input type="text" aria-label="First name" name="interest_rate" id="interest_rate" class="form-control" >
          </div>

          <div class="form-group" id="jewel_grams_group1">
            <label for="jewel_grams">Loan Amount</label>
            <input type="number" name="loan_amount" id="loan_amount" class="form-control">
        </div>

        <div class="form-group" id="jewel_grams_group">
            <label for="jewel_grams">Tenurity</label>
            <select class="form-select" id="tenurity" name="tenurity">
            <option value="">Select a month</option>
            @for ($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
            @endfor
            </select>
        </div>


          <div class="form-group" id="jewel_grams_group">
            <label for="jewel_grams">Loan Date</label>
            <input type="date" name="loan_date" id="loan_date" class="form-control">
        </div>




        <div class="form-group">
            <label for="total_loan_amount">Processing Charge</label>
            <input type="text" class="form-control" id="additional_charges" name="additional_charges">
        </div>
        <div class="form-group">
            <label for="total_loan_amount">Document Charge</label>
            <input type="text" class="form-control" id="additional_charges" name="additional_charges">
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
                    const customerPhotoUrl = '/storage/' + response.data.customer_photo;

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
                    $('#userImage').attr('src', customerPhotoUrl);
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


            // Loan Number By Customer ID
            let customerId = $(this).val();
        let loanDropdown = $('#customer_loan_no');

        // Clear existing options
        loanDropdown.empty();

        if (customerId) {
            $.ajax({
                url: '{{ route("other_loans.get-loan-numbers", ":customer_id") }}'.replace(':customer_id', customerId),
                method: 'GET',
                success: function(response) {
                    if (response.length > 0) {
                        response.forEach(function(loanNumber) {
                            loanDropdown.append(`<option value="${loanNumber}">${loanNumber}</option>`);
                        });
                    } else {
                        loanDropdown.append(`<option value="">No loans found</option>`);
                    }
                },
                error: function() {
                    alert('Error fetching loan numbers');
                }
            });
        } else {
            loanDropdown.append(`<option value="">Select a customer first</option>`);
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
                url: '/other-bank-save-loan',
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
                        window.location.href = '/other_loans/create'; // Redirect to loan list or any other page
                    });
                },
                error: function(xhr, status, error) {
                   // console.log(error.message);
                    swal({
                        title: "Error!",
                        text: xhr.responseJSON.message || "An unexpected error occurred.", // Show the returned message
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
