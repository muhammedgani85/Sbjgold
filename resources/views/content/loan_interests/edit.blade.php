@extends('layouts/contentNavbarLayout')

@section('title', 'New Sandha')

@section('content')

<h4 class="py-3 mb-4"><span class="text-muted fw-light">Location Details </span> </h4>
<form id="customerForm" method="POST" action="{{ route('customers.update', $loanInterests->id) }}">
  @csrf
  <div class="row">
    <!-- Basic -->
    <div class="col-md-6">
      <div class="card mb-4">
        <h5 class="card-header">Information</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">




          <div class="input-group">
            <span class="input-group-text">Type</span>
            <input type="text" aria-label="sandha_name name" name="type" id="type" class="form-control" value="{{ $loanInterests->type }}">

          </div>


          <div class="input-group">
            <span class="input-group-text">Interest Rate</span>
            <input type="text" aria-label="First name" name="interest_rate" id="interest_rate" class="form-control" value="{{ $loanInterests->interest_rate }}">


          </div>


          <div class="input-group">
            <span class="input-group-text">Interest Percentage</span>
            <input type="text" aria-label="First name" name="interest_percentage" id="interest_percentage" class="form-control" value="{{ $loanInterests->interest_percentage }}">

          </div>

         <!--  -->
          <div class="input-group">
            <span class="input-group-text">Per Gram Amount</span>
            <input type="text" aria-label="First name" name="per_gram_amount" id="per_gram_amount" class="form-control" value="{{ $loanInterests->per_gram_amount }}">

          </div>

          <div class="input-group">
            <span class="input-group-text">Months</span>
            <input type="text" aria-label="First name" name="months" id="months" class="form-control" value="{{ $loanInterests->months }}">

          </div>
          <div class="input-group">
            <span class="input-group-text">Document Charge</span>
            <input type="text" aria-label="First name" name="document_charge" id="document_charge" class="form-control" value="{{ $loanInterests->document_charge }}">
            <input type="hidden" aria-label="First name" name="loan_type_id" id="loan_type_id" class="form-control" value="1">
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
            <a  class="btn rounded-pill btn-danger"  href="{{ url('loan_interests') }}">Back</a>


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
        url: "{{ route('loan_interests.update', $loanInterests->id) }}",
        method: 'POST', // Use POST because of FormData, but Laravel will interpret it as PUT
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-HTTP-Method-Override': 'PUT' // Override the method to PUT
        },
        success: function(response) {
            swal("Done!", response.message, "success");
            window.location.href = "{{ url('loan_interests') }}";
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



</script>






<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
@endsection
