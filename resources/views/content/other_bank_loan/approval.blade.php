@extends('layouts/contentNavbarLayout')

@section('title', 'Loan Apporval')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

@section('content')
<h4 class="py-0 mb-4">
  <span class="text-muted fw-light" style="color:red !important;">Loan Approval</span>
</h4>

<div class="row">



  <!-- Form controls -->

  <div class="card">



    <div class="table-responsive text-nowrap">

      <table class="display" id="usersTable">
      <thead>
                <tr>
                    <th>Loan Number</th>
                    <th>Customer Name</th>
                    <th>Loan Type</th>
                    <th>Total Loan Amount</th>
                    <th>Total Interest Amount</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($loans as $loan)
                <tr>
                    <td>{{ $loan->loan_number }}</td>
                    <td>{{ $loan->customer->first_name.' '.$loan->customer->last_name }}</td>
                    <td>{{ $loan->loanType->loan_type }}</td> <!-- Ensure this line matches your LoanType model attributes -->
                    <td>{{ $loan->total_loan_amount }}</td>
                    <td>{{ $loan->total_interest_amount }}</td>
                    <td>{{ $loan->created_at }}</td>
                    <td>
                        <!-- Add your action buttons here -->
                        <a href="{{ route('loans.approvalview', ['loan_number' => $loan->loan_number]) }}" title="edit"><i class="bx bx-pencil me-1"></i></a>


                        <a href="#" title="edit"><i class="bx bx-trash me-1" style='color:red;'></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>


    </table>
  </div>
</div>


</div>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>


<script>
  new DataTable('#usersTable', {
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
            url: '{{ route("customers.softDelete", "") }}/' + userId,
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
