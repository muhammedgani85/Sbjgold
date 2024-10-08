@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Employee')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Edit Employee Details</span></h4>
<form id="employeeForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <!-- Basic -->
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Basic Information</h5>
                <div class="card-body demo-vertical-spacing demo-only-element">
                    <div class="input-group">
                        <span class="input-group-text">Initial</span>
                        <input type="text" aria-label="Initial" name="initial" id="initial" class="form-control" value="{{ $employee->initial }}">
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">First Name</span>
                        <input type="text" aria-label="First name" name="first_name" id="first_name" class="form-control" value="{{ $employee->first_name }}">
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">Last Name</span>
                        <input type="text" aria-label="Last name" name="last_name" id="last_name" class="form-control" value="{{ $employee->last_name }}">
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">Father Name</span>
                        <input type="text" aria-label="Father name" name="father_name" id="father_name" class="form-control" value="{{ $employee->father_name }}">
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
                        <input type="text" aria-label="Phone number" name="phone_number" id="phone_number" class="form-control" value="{{ $employee->phone_number }}" onkeypress="return isNumber(event)">
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">Emr. Number</span>
                        <input type="text" aria-label="Emergency number" name="emergency_number" id="emergency_number" class="form-control" value="{{ $employee->emergency_number }}" onkeypress="return isNumber(event)">
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">City</span>
                        <input type="text" aria-label="City" name="city" id="city" class="form-control" value="{{ $employee->city }}">
                    </div>

                    <div class="input-group input-group-merge">
                        <span class="input-group-text">Address</span>
                        <textarea class="form-control" aria-label="With textarea" name="address" id="address">{{ $employee->address }}</textarea>
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
                        <input type="text" aria-label="Aadhar number" name="aadhar_number" id="aadhar_number" class="form-control" value="{{ $employee->aadhar_number }}" onkeypress="return isNumber(event)">
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">Driving Lic Number</span>
                        <input type="text" aria-label="Driving license number" name="driving_license_number" id="driving_license_number" class="form-control" value="{{ $employee->driving_license_number }}">
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">PAN</span>
                        <input type="text" aria-label="PAN" name="pan" id="pan" class="form-control" value="{{ $employee->pan }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Salary -->
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Salary</h5>
                <div class="card-body demo-vertical-spacing demo-only-element">
                    <div class="input-group">
                        <span class="input-group-text">Basic &#8377;</span>
                        <input type="number" class="form-control" placeholder="Amount" name="salary" id="salary" value="{{ $employee->salary }}" aria-label="Amount (to the nearest dollar)" onkeypress="return isNumber(event)">
                        <span class="input-group-text">.00</span>
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">deduction &#8377;</span>
                        <input type="number" class="form-control" placeholder="Deduction" name="deduction" id="deduction" value="{{ $employee->deduction }}" aria-label="Amount (to the nearest dollar)" onkeypress="return isNumber(event)">
                        <span class="input-group-text">.00</span>
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">Others &#8377;</span>
                        <input type="number" class="form-control" placeholder="Others" name="others" id="others" value="{{ $employee->others }}" aria-label="Amount (to the nearest dollar)" onkeypress="return isNumber(event)">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role & Credential Details -->
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Role & Credential Details</h5>
                <div class="card-body demo-vertical-spacing demo-only-element">
                    <div class="input-group">
                        <label class="input-group-text" for="role">Roles</label>
                        <select class="form-select" id="role" name="role">
                            <option selected>Choose...</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" @if($employee->role == $role->id) selected @endif>{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group">
                        <label class="input-group-text" for="status">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option selected>Choose...</option>
                            <option value="Active" @if($employee->status == 'Active') selected @endif>Active</option>
                            <option value="InActive" @if($employee->status == 'InActive') selected @endif>InActive</option>
                            <option value="Resigned" @if($employee->status == 'Resigned') selected @endif>Resigned</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label class="input-group-text" for="location">Location</label>
                        <select class="form-select" id="location" name="location">
                            <option selected>Choose...</option>
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" @if($employee->location == $branch->id) selected @endif>{{ $branch->branch_prefix }} - {{ $branch->branch_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group">
                        <label class="input-group-text" for="emp_id">Emp Id</label>
                        <input type="text" class="form-control" placeholder="Emp_Id" name="emp_id" id="emp_id" value="{{ $employee->emp_id }}" readonly>
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input type="text" class="form-control" placeholder="User Name" name="user_name" id="user_name" value="{{ $employee->user_name }}" aria-label="Username">
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Password">
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Information -->
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Other Information</h5>
                <div class="card-body demo-vertical-spacing demo-only-element">
                    <small class="text-light fw-semibold">Joining Date</small>
                    <input type="date" class="form-control" name="joining_date" id="joining_date" value="{{ $employee->joining_date }}">

                    <div class="input-group">
                        <label class="input-group-text" for="document">Upload</label>
                        <input type="file" class="form-control" id="document" name="document">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" align="center">
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

</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#submitForm').click(function(e) {
        e.preventDefault();
        let formData = new FormData($('#employeeForm')[0]);

        $.ajax({
            url: "{{ route('users.update', $employee->id) }}",
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                //alert(response.success);

                swal("Done!", response.success, "success");
                window.location.href = "{{ url('/users')}}";

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
                $('#employeeForm').before(errorHtml);
            }
        });
    });

    $(document).ready(function() {
        $('#location').change(function() {
            var locationId = $(this).val();

            if (locationId) {
                $.ajax({
                    url: '/get-location-count', // Your route to get the count
                    type: 'GET',
                    data: {
                        location_id: locationId
                    },
                    success: function(response) {
                        if (response.success) {
                            var count = response.count;
                            var locationCode = response.location_code; // Assuming you have a location code to prepend
                            var employeeId = locationCode + '-' + (count + 1).toString().padStart(4, '0');
                            $('#emp_id').val(employeeId);
                            $('#count').text(count); // Update the user count
                        } else {
                            alert('Failed to get location count.');
                        }
                    },
                    error: function() {
                        alert('Error occurred while fetching location count.');
                    }
                });
            } else {
                $('#emp_id').val('');
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