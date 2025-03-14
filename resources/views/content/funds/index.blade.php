@extends('layouts/contentNavbarLayout')

@section('title', 'Funds Management')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<style>
  .text-left {
    text-align: left;
  }

  .text-success {
    color: green;
  }

  .text-warning {
    color: purple;
  }

  .text-danger {
    color: red;
  }


</style>
<!-- Include other styles here -->
@section('content')
<h4 class="py-0 mb-4">
  <span class="text-muted fw-light" style="color:red !important;">Funds(s)</span>
</h4>

<div class="row">



  <!-- Form controls -->

  <div class="card">

    <div class="table-responsive text-nowrap">
    <div><a href="#" data-bs-toggle="modal" data-bs-target="#fundModal">Add</a></div>
      <!-- Expenses Table -->
<table class="table" id="fundsTable">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Location</th>
            <th>Amount</th>
            <th>Description</th>
            <th>Type</th>
            <th>Added_By</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($funds as $fund)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $fund->branch_name }}</td>  <!-- Access branch_name directly -->
                <td>{{ $fund->amount }}</td>
                <td>{{ $fund->description }}</td>
                <td>{{ $fund->type }}</td>
                <td>{{ $fund->added_by_name }}</td>
                <td>
                    <!-- Add your actions (edit, delete) here -->


                    <a href="javascript:void(0);" data-id="{{ $fund->id }}" class="btn-delete" title="Delete"><i class="bx bx-trash me-1" style="color:red;"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No records found</td>
            </tr>
        @endforelse
    </tbody>
</table>
  </div>
</div>


</div>

<!-- Modal Popup Message -->

<div class="modal fade" id="fundModal" tabindex="-1" aria-labelledby="followUpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <h5 class="modal-title" id="followUpModalLabel" style="color:green;margin-left:20px;">Add Funds</h5>
                <form id="fundForm" class="p-4 border rounded bg-light">
    @csrf
    <div class="form-group">
        <label for="location">Location:</label>
        <select name="location" id="location" class="form-select">
        <option value="">Select a reason</option>
        @foreach($location as $loc)
            <option value="{{ $loc->id }}">{{ $loc->branch_name }}</option>
        @endforeach
    </select>
    </div>
    <div class="form-group">
        <label for="amount">Amount:</label>
        <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="Enter amount" required>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Optional description"></textarea>
    </div>
    <div class="form-group">

        <input type="hidden" class="form-control" id="added_by" name="added_by" value="{{ session('user_data')->id }}">
    </div>
    <div class="form-group">
        <label for="type">Type:</label>
        <select class="form-control" id="type" name="type">
            <option value="add">Add</option>
            <option value="withdraw">Withdraw</option>
        </select>
    </div>
    <button type="button" id="submitFund" class="btn btn-primary" style="margin:20px;">Submit</button>
</form>
        </div>
    </div>
</div>






<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
  new DataTable('#fundsTable', {
    "pageLength": 10, // Set default page length
    "lengthMenu": [5, 10, 25, 50, 75, 100], // Set options for page length
    "language": {
      "search": "", // Remove the search label
      "searchPlaceholder": "Search...", // Optionally, you can add a placeholder
      "emptyTable": "No data available",
      "info": "", // Remove the "Showing X to Y of Z entries"
      "infoEmpty": "", // Remove the "Showing 0 to 0 of 0 entries"
      "infoFiltered": "", // Remove the "filtered from X total entries"

      "paginate": {
        "first": "First",
        "last": "Last",
        "next": "Next",
        "previous": "Previous"
      },
      "zeroRecords": "No matching records found"
    },
    "pagingType": "full_numbers",
  });

/** Store the Data's */

$(document).ready(function() {
    // Show popup when "Add Fund" button is clicked
    $('#submitFund').on('click', function() {
        // Validate required fields
        const form = $('#fundForm');
        /* if (form[0].checkValidity() === false) {
            form.addClass('was-validated');
            swal("Validation Error", "Please fill out all required fields.", "error");
            return;
        } */

        // Serialize form data
        const data = form.serialize();

        // AJAX request to save data
        $.ajax({
            url: "{{ route('funds.store') }}",
            type: "POST",
            data: data,
            success: function(response) {
                swal("Saved!", "Fund entry has been saved.", "success");
                $('#fundModal').modal('hide'); // Close the modal on success
                //form[0].reset(); // Reset the form fields
                location.reload();

            },
            error: function(xhr) {
                swal("Error!", "There was an error saving the fund entry.", "error");
            }
        });
    });


    /** Delete fund */
    $('.btn-delete').on("click", function() {
      var $this = $(this);
      swal({
        title: "Remove?",
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
            url: '{{ route("funds.softDelete", "") }}/' + userId,
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



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

@endsection
