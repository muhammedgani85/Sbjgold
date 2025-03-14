@extends('layouts/contentNavbarLayout')

@section('title', 'New Role')

@section('content')

<h4 class="py-3 mb-4"><span class="text-muted fw-light">Role Edit Details </span> </h4>
<form id="customerForm" enctype="multipart/form-data" method="POST" action="{{ route('roles.update', $roles->id) }}">
@csrf
@method('PUT')
  <div class="row">
    <!-- Basic -->
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Information</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">




          <div class="input-group">
            <span class="input-group-text">Role Name</span>
            <input type="text" aria-label="sandha_name name" name="role_name" id="role_name" class="form-control" value="{{ $roles->role_name }}">

            <input type="hidden" aria-label="First name" name="updated_by" id="updated_by" class="form-control" value="{{ session('user_data')->id; }}">

          </div>


          <div class="input-group">
            <span class="input-group-text">Status</span>
            <select class="form-select" id="status" name="status">

            <option value="Active" {{ $roles->status === 'Active' ? 'selected' : '' }}>Active</option>
            <option value="InActive" {{ $roles->status === 'InActive' ? 'selected' : '' }}>InActive</option>


            </select>


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


          <button type="submit" class="btn rounded-pill btn-success">Save Changes</button>
            <button type="button" class="btn rounded-pill btn-danger" id="resetButton">Reset</button>


          </div>


        </div>
      </div>
    </div>
  </div>

</form>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $('#customerForm').on('submit', function (e) {
    e.preventDefault();

    let form = $(this); // Reference to the form
    Swal.fire({
        title: "Save Changes?",
        text: "Please ensure and then confirm!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Update it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            // Proceed with form submission via AJAX
            $.ajax({
                url: form.attr('action'), // Ensure correct route in 'action' attribute
                method: 'POST', // Change to 'PUT' if your route expects a PUT request
                data: form.serialize(),
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: "Roles updated successfully.",
                        icon: "success",
                    }).then(() => {
                        window.location.href = "{{ route('roles.index') }}"; // Redirect to index
                    });
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorHtml = '<ul>';
                    $.each(errors, function (key, value) {
                        errorHtml += '<li>' + value + '</li>';
                    });
                    errorHtml += '</ul>';
                    Swal.fire("Error!", errorHtml, "error");
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Cancelled", "Your changes were not saved!", "info");
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



$('#resetButton').on('click', function () {
    location.reload();
});

</script>






<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
@endsection
