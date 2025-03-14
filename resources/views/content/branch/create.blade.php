@extends('layouts/contentNavbarLayout')

@section('title', 'New Sandha')

@section('content')

<h4 class="py-3 mb-4"><span class="text-muted fw-light">Location Details </span> </h4>
<form id="customerForm" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <!-- Basic -->
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Information</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">




          <div class="input-group">
            <span class="input-group-text">Location Name</span>
            <input type="text" aria-label="sandha_name name" name="branch_name" id="branch_name" class="form-control">

          </div>


          <div class="input-group">
            <span class="input-group-text">ShortCode</span>
            <input type="text" aria-label="First name" name="branch_prefix" id="branch_prefix" class="form-control">


          </div>


          <div class="input-group">
            <span class="input-group-text">Address</span>
            <input type="text" aria-label="First name" name="address" id="address" class="form-control">

          </div>

         <!--  -->
          <div class="input-group">
            <span class="input-group-text">Contact Number</span>
            <input type="text" aria-label="First name" name="mobile_number" id="mobile_number" class="form-control">

          </div>

          <div class="input-group">
            <span class="input-group-text">Address</span>
            <input type="text" aria-label="First name" name="address" id="address" class="form-control">

          </div>
          <div class="input-group">
            <span class="input-group-text">Org Name</span>
            <input type="text" aria-label="First name" name="org_name" id="org_name" class="form-control">

          </div>



        </div>
      </div>
    </div>

    <!-- Merged -->





    <!-- Sizing -->

    <!-- Checkbox and radio addons -->

  </div>





  <!-- Button with dropdowns & addons -->



  <!-- Custom file input -->

  <div class="row" align="centre">
    <div class="col-12">
      <div class="card">

        <div class="card-body demo-vertical-spacing demo-only-element">
          <div class="input-group">


            <button type="button" id="submitForm" class="btn rounded-pill btn-success">Save</button>
            <button type="button" class="btn rounded-pill btn-danger" id="resetButton">Reset</button>


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
      url: "{{ route('branch.store') }}",
      method: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        // alert(response.success);
        swal("Done!", response.success, "success");
        //location.reload();
        window.location.href = "{{ url('/branch')}}";
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

document.getElementById('branch_name').addEventListener('input', function () {
    const branchName = this.value.trim();

    let prefix;
    if (branchName.includes(' ')) {
        // For multi-word names, take the first letter of each word up to 3 characters
        prefix = branchName.split(' ')
            .map(word => word[0] ? word[0].toUpperCase() : '')
            .join('')
            .substring(0, 3);
    } else {
        // For single-word names, take the first 3 characters
        prefix = branchName.substring(0, 3).toUpperCase();
    }

    document.getElementById('branch_prefix').value = prefix;
});

$('#resetButton').on('click', function () {
    location.reload();
});

</script>






<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
@endsection
