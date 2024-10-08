@extends('layouts/contentNavbarLayout')

@section('title', 'New Employee')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Employee Details </span> </h4>
<form id="employeeForm" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <!-- Basic -->
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Basic Information</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">


          <div class="input-group">
            <span class="input-group-text">Initial</span>
            <input type="text" aria-label="First name" name="initial" id="initial" class="form-control" maxlength="2" minlength="1">

          </div>
          <div class="input-group">
            <span class="input-group-text">First Name</span>
            <input type="text" aria-label="First name" name="first_name" id="first_name" class="form-control">

          </div>

          <div class="input-group">
            <span class="input-group-text">Last Name</span>
            <input type="text" aria-label="First name" name="last_name" id="last_name" class="form-control">

          </div>






          <div class="input-group">
            <span class="input-group-text">Father Name</span>
            <input type="text" aria-label="First name" name="father_name" id="father_name" class="form-control">

          </div>




        </div>
      </div>
    </div>

    <!-- Merged -->
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Contact Details</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">



          <div class="input-group">
            <span class="input-group-text">Phone Number</span>
            <input type="text" aria-label="First name" name="phone_number" id="phone_number" class="form-control" onkeypress="return isNumber(event)" maxlength="13" minlength="10">

          </div>

          <div class="input-group">
            <span class="input-group-text">Emr. Number</span>
            <input type="text" aria-label="First name" name="emergency_number" id="emergency_number" class="form-control" onkeypress="return isNumber(event)" maxlength="13" minlength="10">

          </div>
          <div class="input-group">
            <span class="input-group-text">City</span>
            <input type="text" aria-label="First name" name="city" id="city" class="form-control">

          </div>


          <div class="input-group input-group-merge">
            <span class="input-group-text">Address</span>
            <textarea class="form-control" aria-label="With textarea" name="address" id="address"></textarea>
          </div>

        </div>
      </div>
    </div>

    <!-- Sizing -->
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Identification</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">

          <div class="input-group">
            <span class="input-group-text">Aadhar Number</span>
            <input type="text" aria-label="First name" name="aadhar_number" id="aadhar_number" class="form-control" onkeypress="return isNumber(event)" onkeypress="return isNumber(event)" maxlength="16" minlength="16">

          </div>

          <div class="input-group">
            <span class="input-group-text">Driving Lic Number</span>
            <input type="text" aria-label="First name" name="driving_license_number" id="driving_license_number" class="form-control">

          </div>

          <div class="input-group">
            <span class="input-group-text">PAN</span>
            <input type="text" aria-label="First name" name="pan" id="pan" class="form-control">

          </div>
        </div>
      </div>
    </div>
    <!-- Checkbox and radio addons -->
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Salary</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">

          <div class="input-group">
            <span class="input-group-text">Basic &#8377;</span>
            <input type="number" class="form-control" placeholder="Amount" name="salary" id="salary" aria-label="Amount (to the nearest dollar)" onkeypress="return isNumber(event)" />
            <span class="input-group-text">.00</span>
          </div>

          <div class="input-group">
            <span class="input-group-text">Deduction&#8377;</span>
            <input type="number" class="form-control" placeholder="Deduction" name="deduction" id="deduction" aria-label="Amount (to the nearest dollar)" onkeypress="return isNumber(event)" value="0"/>
            <span class="input-group-text">.00</span>
          </div>

          <div class="input-group">
            <span class="input-group-text">Others&#8377;</span>
            <input type="number" class="form-control" placeholder="Others" name="others" id="others" aria-label="Amount (to the nearest dollar)" onkeypress="return isNumber(event)" value="0" />
            <span class="input-group-text">.00</span>
          </div>

        </div>
      </div>

    </div>
  </div>


  <div class="row">
    <!-- Multiple inputs & addon -->
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Role & Credential Details</h5>

        <div class="card-body demo-vertical-spacing demo-only-element">
          <div class="input-group">
            <label class="input-group-text" for="inputGroupSelect01">Roles</label>
            <select class="form-select" id="role" name="role">
              <option selected>Choose...</option>
              @foreach($roles as $role)
              <option value="{{  $role->id }}">{{ $role->role_name }}</option>

              @endforeach
            </select>
          </div>
          <div class="input-group">
            <label class="input-group-text" for="inputGroupSelect01">Status</label>
            <select class="form-select" id="status" name="status">
              <option selected>Choose...</option>
              <option value="Active">Active</option>
              <option value="InActive">InActive</option>
              <option value="Resinged">Resigned</option>


            </select>
          </div>
          <div class="input-group">
            <label class="input-group-text" for="inputGroupSelect01">Location</label>
            <select class="form-select" id="location" name="location">
              <option selected>Choose...</option>
              @foreach($branchs as $branch)
              <option value="{{  $branch->id }}">{{ $branch->branch_prefix }} - {{ $branch->branch_name }}</option>

              @endforeach
            </select>
          </div>

          <div class="input-group">
            <label class="input-group-text" for="inputGroupSelect01">Emp Id</label>
            <input type="text" class="form-control" placeholder="Emp_Id" name="emp_id" id="emp_id" readonly />
          </div>

          <div class="input-group">
            <span class="input-group-text">@</span>
            <input type="text" class="form-control" placeholder="User Name" name="user_name" id="user_name" aria-label="Amount (to the nearest dollar)" />

          </div>

          <div class="input-group">
            <span class="input-group-text">@</span>
            <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Amount (to the nearest dollar)" />

          </div>
        </div>

      </div>
    </div>


    <!-- Speech To Text -->
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Other Information</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">
          <small class="text-light fw-semibold">Joining Date</small>
          <input type="date" class="form-control" name="joining_date" id="joining_date">

          <div class="input-group">
            <label class="input-group-text" for="document">Upload</label>
            <input type="file" class="form-control" id="document" name="document">
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


            <button type="button" id="submitForm" class="btn rounded-pill btn-success">Save</button>
            <button type="button" class="btn rounded-pill btn-danger">Reset</button>


          </div>


        </div>
      </div>
    </div>
  </div>
  <div id="user-count">
    User count: <span id="count">0</span>
  </div>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $('#submitForm').click(function(e) {

    e.preventDefault();
    let formData = new FormData($('#employeeForm')[0]);

    $.ajax({
      url: "{{ route('users.store') }}",
      method: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        // alert(response.success);
        swal("Done!", response.success, "success");
        //location.reload();
        window.location.href = "{{ url('/users')}}";
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
</script>
<script>
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
              var locationCode = response.location_code + '-E'; // Assuming you have a location code to prepend
              var employeeId = locationCode + '-' + (count + 1).toString().padStart(4, '0');
              $('#emp_id').val(employeeId);
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
@endsection
