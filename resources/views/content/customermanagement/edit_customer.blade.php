@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Customer')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Customer Details </span> </h4>
<form id="customerForm" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Add this line to specify PUT request for update -->
    <div class="row">
        <!-- Basic Information -->
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Basic Information</h5>
                <div class="card-body demo-vertical-spacing demo-only-element">
                    <div class="input-group">
                        <span class="input-group-text">Customer ID</span>
                        <input type="text" name="customer_id" id="customer_id" class="form-control" value="{{ $customer->customer_id}}" readonly>
                        <input type="hidden" name="location_id" id="location_id" class="form-control" value="{{ $location }}" readonly>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Initial</span>
                        <input type="text" name="initial" id="initial" class="form-control" maxlength="2" minlength="1" value="{{ $customer->initial }}">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">First Name</span>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $customer->first_name }}">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Last Name</span>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $customer->last_name }}">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Father Name</span>
                        <input type="text" name="father_name" id="father_name" class="form-control" value="{{ $customer->father_name }}">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Spouse Name</span>
                        <input type="text" name="spouse_name" id="spouse_name" class="form-control" value="{{ $customer->spouse_name }}">
                    </div>
                    <div class="input-group">
                        <label class="input-group-text" for="inputGroupSelect01">Gender</label>
                        <select class="form-select" id="gender" name="gender">
                            <option selected>Choose...</option>
                            <option value="Male" {{ $customer->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="FeMale" {{ $customer->gender == 'FeMale' ? 'selected' : '' }}>FeMale</option>
                            <option value="Others" {{ $customer->gender == 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">DOB</span>
                        <input type="date" name="dob" id="dob" class="form-control" value="{{ $customer->dob }}">
                    </div>
                    <div class="input-group">
                        <label class="input-group-text" for="inputGroupSelect01">Marital Status</label>
                        <select class="form-select" id="marital_status" name="marital_status">
                            <option selected>Choose...</option>
                            <option value="UnMarried" {{ $customer->marital_status == 'UnMarried' ? 'selected' : '' }}>UnMarried</option>
                            <option value="Married" {{ $customer->marital_status == 'Married' ? 'selected' : '' }}>Married</option>
                            <option value="Single" {{ $customer->marital_status == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Widow" {{ $customer->marital_status == 'Widow' ? 'selected' : '' }}>Widow</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Details -->
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Contact Details</h5>
                <div class="card-body demo-vertical-spacing demo-only-element">
                    <div class="input-group">
                        <span class="input-group-text">Phone Number</span>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" onkeypress="return isNumber(event)" maxlength="13" minlength="10" value="{{ $customer->phone_number }}">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Emr. Number</span>
                        <input type="text" name="emergency_number" id="emergency_number" class="form-control" onkeypress="return isNumber(event)" maxlength="13" minlength="10" value="{{ $customer->emergency_number }}">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Email</span>
                        <input type="text" name="email_id" id="email_id" class="form-control" value="{{ $customer->email_id }}">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">City</span>
                        <input type="text" name="city" id="city" class="form-control" value="{{ $customer->city }}">
                    </div>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">Permanent Address</span>
                        <textarea class="form-control" name="permanent_address" id="permanent_address">{{ $customer->permanent_address }}</textarea>
                    </div>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">Communication Address</span>
                        <textarea class="form-control" name="communication_address" id="communication_address">{{ $customer->communication_address }}</textarea>
                    </div>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">Ward</span>
                        <textarea class="form-control" name="ward" id="ward">{{ $customer->ward }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Identification -->
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Identification</h5>
                <div class="card-body demo-vertical-spacing demo-only-element">
                    <div class="input-group">
                        <span class="input-group-text">Aadhar Number</span>
                        <input type="text" name="aadhar_number" id="aadhar_number" class="form-control" onkeypress="return isNumber(event)" maxlength="16" minlength="16" value="{{ $customer->aadhar_number }}">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Driving Lic Number</span>
                        <input type="text" name="driving_license_number" id="driving_license_number" class="form-control" value="{{ $customer->driving_license_number }}">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">PAN</span>
                        <input type="text" name="pan" id="pan" class="form-control" value="{{ $customer->pan }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Occupation -->
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Ocupation</h5>
                <div class="card-body demo-vertical-spacing demo-only-element">

                    <div class="input-group">
                        <label class="input-group-text" for="inputGroupSelect01">Occupation</label>
                        <select class="form-select" id="occupation_id" name="occupation_id">
                            <option selected>Choose...</option>
                            @foreach($occupations as $occupation)
                            <option value="{{  $occupation->id }}" {{ $customer->occupation_id  == $occupation->id  ? 'selected' : '' }}>{{ $occupation->occupation }}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="input-group">
                        <label class="input-group-text" for="inputGroupSelect01">Type</label>
                        <select class="form-select" id="occupation_type" name="occupation_type">
                            <option selected>Choose...</option>
                            <option value="Salaried" {{ $customer->occupation_type == 'Salaried' ? 'selected' : '' }}>Salaried</option>
                            <option value="Business" {{ $customer->occupation_type == 'Business' ? 'selected' : '' }}>Business</option>

                        </select>
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">Job Title</span>
                        <input type="text" aria-label="First name" name="job_type_details" id="job_type_details" class="form-control" value="{{ $customer->job_type_details }}">

                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">References</h5>

                <div class="card-body demo-vertical-spacing demo-only-element">

                    <div class="input-group">
                        <span class="input-group-text">R.Name1:</span>
                        <input type="text" aria-label="First name" name="r_name" id="r_name" class="form-control" value="{{ $customer->r_name}}">

                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Phone No:</span>
                        <input type="text" aria-label="First name" name="r_phone" id="r_phone" class="form-control" value="{{ $customer->r_phone}}" onkeypress="return isNumber(event)" maxlength="13" minlength="10">

                    </div>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">Address</span>
                        <textarea class="form-control" aria-label="With textarea" name="r_address" id="r_address" value="{{ $customer->r_address}}"></textarea>
                    </div>


                    <div class="input-group">
                        <span class="input-group-text">R.Name2:</span>
                        <input type="text" aria-label="First name" name="r_name1" id="r_name1" class="form-control" value="{{ $customer->r_name1}}">

                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Phone No:</span>
                        <input type="text" aria-label="First name" name="r_phone1" id="r_phone1" class="form-control" value="{{ $customer->r_phone1}}" onkeypress="return isNumber(event)" maxlength="13" minlength="10">

                    </div>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">Address</span>
                        <textarea class="form-control" aria-label="With textarea" name="r2_address" id="r2_address" value="{{ $customer->r2_address}}"></textarea>
                    </div>

                    <div class="input-group input-group-merge">
                        <span class="input-group-text">Others</span>
                        <textarea class="form-control" aria-label="With textarea" name="r_others" id="r_others" value="{{ $customer->r_others}}"></textarea>
                    </div>

                </div>

            </div>
        </div>
        <!-- Documents -->
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Documents</h5>
                <div class="card-body demo-vertical-spacing demo-only-element">
                    <div class="input-group">
                        <input type="file" name="customer_photo" id="customer_photo" class="form-control">
                        <label class="input-group-text" for="customer_photo">Customer Photo</label>
                    </div>
                    <div class="input-group">
                        <input type="file" name="customer_aadharr" id="customer_aadharr" class="form-control">
                        <label class="input-group-text" for="customer_aadharr">Aadharr Card</label>
                    </div>
                    <div class="input-group">
                        <input type="file" name="customer_other" id="customer_other" class="form-control">
                        <label class="input-group-text" for="customer_other">Other Documents</label>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <h5 class="card-header">Bank Details</h5>
                <div class="card-body demo-vertical-spacing demo-only-element">

                    <div class="input-group">
                        <span class="input-group-text">Account Holder Name</span>
                        <input type="text" aria-label="First name" name="account_holder_name" id="account_holder_name" value="{{ $customer->account_holder_name}}" class="form-control">

                    </div>

                    <div class="input-group">
                        <span class="input-group-text">Bank Name</span>
                        <input type="text" aria-label="First name" name="bank_name" id="bank_name" value="{{ $customer->bank_name}}" class="form-control">

                    </div>

                    <div class="input-group">
                        <span class="input-group-text">Account Number</span>
                        <input type="text" aria-label="First name" name="account_number" id="account_number" value="{{ $customer->account_number}}" class="form-control">

                    </div>
                    <div class="input-group">
                        <span class="input-group-text">IFSC</span>
                        <input type="text" aria-label="First name" name="ifsc" id="ifsc" value="{{ $customer->ifsc}}" class="form-control">

                    </div>



                    <div class="input-group">
                        <span class="input-group-text">Gpay or PhonePe</span>
                        <input type="text" aria-label="First name" name="gpay_no" id="gpay_no" value="{{ $customer->gpay_no}}" class="form-control">

                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <div class="input-group">
                            <button type="button" id="submitForm" class="btn rounded-pill btn-success">Update</button>
                            <button type="button" class="btn rounded-pill btn-danger">Cancel</button>
                        </div>
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
            url: "{{ route('customers.update', $customer->id) }}",
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                //alert(response.success);

                swal("Done!", response.success, "success");
                window.location.href = "{{ url('customers')}}";

                //location.reload();
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



    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.keyCode : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
@endsection