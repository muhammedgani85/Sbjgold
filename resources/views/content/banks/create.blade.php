@extends('layouts/contentNavbarLayout')

@section('title', 'New Sandha')

@section('content')

<h4 class="py-3 mb-4"><span class="text-muted fw-light">Location Details </span> </h4>
<form id="editSandhaForm">
@csrf

  <div class="row">
    <!-- Basic -->
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Information</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">




          <div class="input-group">
            <span class="input-group-text">Bank Name</span>
            <input type="text" aria-label="sandha_name name" name="bank_name" id="bank_name" class="form-control" >

          </div>


          <div class="input-group">
            <span class="input-group-text">Location</span>


            <select name="location"  id="location" class="form-control">
              <option>Choose Location</option>
              @foreach ( $bank_list as $b)
              <option value="{{ $b->id }}">{{ $b->branch_name }} </option>
              @endforeach
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
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });

   $('#submitForm').click(function(e) {
    e.preventDefault();
    let formData = new FormData($('#editSandhaForm')[0]);

    console.log([...formData]); // Debugging: Log all form data

    $.ajax({
        url: "{{ route('banks.store') }}",
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            swal("Done!", response.message, "success");
            window.location.href = "{{ url('/banks') }}";
        },
        error: function(response) {
            let errors = response.responseJSON.errors;
            $('#errorMessages').remove();
            let errorHtml = '<div id="errorMessages"><ul>';
            $.each(errors, function(key, value) {
                errorHtml += '<li>' + value + '</li>';
            });
            errorHtml += '</ul></div>';
            $('#editSandhaForm').before(errorHtml);
        }
    });
});

</script>





<script>



$('#resetButton').on('click', function () {
    location.reload();
});

</script>






<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
@endsection
