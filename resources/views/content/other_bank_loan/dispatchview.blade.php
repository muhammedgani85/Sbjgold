@extends('layouts/contentNavbarLayout')

@section('title', 'Loan Dispatch')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Loan Dispatch </span> </h4>

<meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="row">
    <!-- Basic -->
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Basic Information</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">


          <div id="customer_info">

          <div class="input-group">
          <img src="{{asset('assets/images/sj_logo.png')}}" style ="width:200px;height:50px;" class="h-auto rounded-circle"/>


          </div>


          <table class="table table-bordered mt-4">
          <tbody>
    <tr>
        <th>Name</th>
        <td><span id="initial">{{ $loan->customer->initial }}</span> <span id="first_name">{{ $loan->customer->first_name }}</span> <span id="last_name">{{ $loan->customer->last_name }}</span></td>
    </tr>
    <tr>
        <th>Father Name</th>
        <td><span id="father_name">{{ $loan->customer->father_name }}</span></td>
    </tr>
    <tr>
        <th>Spouse Name</th>
        <td><span id="spouse_name">{{ $loan->customer->spouse_name }}</span></td>
    </tr>
    <tr>
        <th>Gender</th>
        <td><span id="gender">{{ $loan->customer->gender }}</span></td>
    </tr>
    <tr>
        <th>DOB</th>
        <td><span id="dob">{{ $loan->customer->dob }}</span></td>
    </tr>
    <tr>
        <th>Marital Status</th>
        <td><span id="marital_status">{{ $loan->customer->marital_status }}</span></td>
    </tr>
    <tr>
        <th>Phone Number</th>
        <td><span id="phone_number">{{ $loan->customer->phone_number }}</span></td>
    </tr>
    <tr>
        <th>City</th>
        <td><span id="city">{{ $loan->customer->city }}</span></td>
    </tr>
    <tr>
        <th>Address</th>
        <td><span id="permanent_address">{{ $loan->customer->permanent_address }}</span></td>
    </tr>
    <tr>
        <th>Aadhar</th>
        <td><span id="aadhar_number">{{ $loan->customer->aadhar_number }}</span></td>
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





        <table class="table table-bordered mt-4">
          <tbody>
          <tr>
                <th>Loan Number</th>
                <td>{{ $loan->loan_number }}</td>
            </tr>
            <tr>
                <th>Loan Amount</th>
                <td>{{ $loan->total_loan_amount }}</td>
            </tr>
            <tr>
                <th>Interest</th>
                <td>{{ $loan->total_interest_amount }}</td>
            </tr>
            <tr>
                <th>Total Loan Amount (include interes )</th>
                <td>{{ $loan->total_include_int_amount }}</td>
            </tr>
            <tr>
                <th>No of Months</th>
                <td>{{ $loan->interest_month }}</td>
            </tr>
            <tr>
                <th>Jewel Net Grm</th>
                <td>{{ $loan->jewel_net_grams }}</td>
            </tr>
            <tr>
                <th>Jewel Actual Grm</th>
                <td>{{ $loan->jewel_grams }}</td>
            </tr>
            <tr>
                <th>Document Charge</th>
                <td>{{ $loan->document_charge }}</td>
            </tr>
            <tr>
                <th>Loan Date</th>
                <td>{{ $loan->created_at }}</td>
            </tr>

</tbody>
            </table>


            <input type="hidden" id="loan_number" value="{{ $loan->loan_number }}">


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
          @if($loan->customer_photo)
          <img src="{{ asset('storage/photos/lOaImYU6oqX3S7nsWqRlOhOClq5tsemwuCvQGUZH.png') }}" alt="Your Image">
          @else
              No Photo Available
          @endif
          </div>



          <div class="input-group">
            <label class="input-group-text" for="document">Others</label>
            <img src="" />
          </div>



          <label>Payment Type : </label>
          <div class="input-group">

          <input type="radio" id="cash" name="status" value="cash"> &nbsp;<span style="color:green;">Cash</span> &nbsp;&nbsp;&nbsp;
    <input type="radio" id="gpay_phonepay" name="status" value="gpay_phonepay">&nbsp;<span style="color:red;">Gpay / PhonePay</span> &nbsp;&nbsp;&nbsp;
    <input type="radio" id="bank" name="status" value="bank">&nbsp;<span style="color:purple;">Bank Account</span>&nbsp;&nbsp;&nbsp;
          </div>
<!-- Cash Denomination Div -->
<div id="cash-denomination" style="display: none;">

            <table>

            <tr>
                    <td><label>2000 Rs:</label></td>
                    <td><input type="number" id="twothousand_notes" name="twothousand_notes" min="100"></td>
                </tr>

                <tr>
                    <td><label>1000 Rs:</label></td>
                    <td><input type="number" id="thousand_notes" name="thousand_notes" min="100"></td>
                </tr>



            <tr>
                    <td><label>500 Rs:</label></td>
                    <td><input type="number" id="five_hundred_notes" name="five_hundred_notes" min="0"></td>
                </tr>
                <tr>
                    <td><label>100 Rs:</label></td>
                    <td><input type="number" id="hundred_notes" name="hundred_notes" min="0"></td>
                </tr>

                <tr>
                    <td><label>50 Rs:</label></td>
                    <td><input type="number" id="fifty_notes" name="fifty_notes" min="0"></td>
                </tr>
                <tr>
                    <td><label>20 Rs:</label></td>
                    <td><input type="number" id="twenty_notes" name="twenty_notes" min="0"></td>
                </tr>
                <tr>
                    <td><label>10 Rs:</label></td>
                    <td><input type="number" id="ten_notes" name="ten_notes" min="0"></td>
                </tr>
            </table>
        </div>

<!-- GPay/PhonePay Div -->
<div id="gpay-phonepay" style="display: none;">
    <table>
        <tr>
            <td><label>Enter GPay/PhonePay Number:</label></td>
            <td><input type="text" id="gpay_phonepay_number" name="gpay_phonepay_number"></td>
        </tr>
    </table>
</div>

<!-- Bank Account Details Div -->
<div id="bank-details" style="display: none;">
    <table>
        <tr>
            <td><label>Account Holder Name:</label></td>
            <td><input type="text" id="account_holder_name" name="account_holder_name"></td>
        </tr>
        <tr>
            <td><label>Bank Name:</label></td>
            <td><input type="text" id="bank_name" name="bank_name"></td>
        </tr>
        <tr>
            <td><label>Account Number:</label></td>
            <td><input type="text" id="account_number" name="account_number"></td>
        </tr>
        <tr>
            <td><label>IFSC Code:</label></td>
            <td><input type="text" id="ifsc_code" name="ifsc_code"></td>
        </tr>
        <tr>
            <td><label>Branch:</label></td>
            <td><input type="text" id="branch_name" name="branch_name"></td>
        </tr>
    </table>
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


            <button type="button" id="submitStatus" class="btn rounded-pill btn-success">Save</button>
            <button type="button" class="btn rounded-pill btn-danger">Reset</button>


          </div>


        </div>
      </div>
    </div>
  </div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>



<script>
   $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#submitStatus').click(function() {
        // Get selected radio button value
        var status = $('input[name="status"]:checked').val();

        if (!status) {
            Swal.fire({
                icon: 'warning',
                title: 'Please select a status.',
                showConfirmButton: true
            });
            return;
        }

        // Show SweetAlert2 confirmation popup
        Swal.fire({
            title: 'Are you sure?',
            text: "Sure want do this !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to update status
                $.ajax({
                    url: '/update-dispatch-loan-status',  // Adjust URL according to your routes
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        loan_number: $('#loan_number').val(), // Assuming you have a hidden input or similar for loan number
                        status: 'Dispatch'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Updated!',
                            'The loan status has been updated.',
                            'success'
                        );
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'There was an issue updating the loan status.',
                            'error'
                        );
                    }
                });
            }
        });
    });


    // payment type
    // Listen for changes on the radio buttons
    $('input[name="status"]').change(function() {
        var selectedValue = $(this).val();

        // Hide all divs initially
        $('#cash-denomination').hide();
        $('#gpay-phonepay').hide();
        $('#bank-details').hide();

        // Show the appropriate div based on the selected value
        if (selectedValue === 'cash') {
            $('#cash-denomination').show();
        } else if (selectedValue === 'gpay_phonepay') {
            $('#gpay-phonepay').show();
        } else if (selectedValue === 'bank') {
            $('#bank-details').show();
        }
    });



});

</script>


@endsection
