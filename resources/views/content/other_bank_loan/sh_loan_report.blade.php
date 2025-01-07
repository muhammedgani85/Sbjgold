@extends('layouts/contentNavbarLayout')

@section('title', 'Share Holder Report')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Include other styles here -->
@section('content')
<h4 class="py-0 mb-4">
  <span class="text-muted fw-light" style="color:red !important;">Share Holder Loans</span>
</h4>

<div class="row">



  <!-- Form controls -->

  <div class="card">
    <div class="table-responsive text-nowrap">

    <form method="GET" action="{{ route('loan_report.sh_loan_report') }}" class="mb-3 p-3 border rounded bg-light" style="margin-top: 20px;">
    <div class="form-row align-items-center">

        <!-- Date Range Filter: From Date -->
        <div class="col-md-2col-sm-12 mb-2">
            <label for="from_date" class="font-weight-bold">From:</label>
            <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
        </div>

        <!-- Date Range Filter: To Date -->
        <div class="col-md-2 col-sm-12 mb-2">
            <label for="to_date" class="font-weight-bold">To:</label>
            <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
        </div>

        <!-- Branch Filter (Only for specific roles) -->
        @if(in_array($role, [1, 9, 10]))
            <div class="col-md-2 col-sm-12 mb-2">
            <label for="branch_id" class="font-weight-bold">Branch:</label>
            <select name="location" id="location" class="form-control">
                <option value="">All</option>
                @if (isset($banks))

                @foreach ($banks as $br)
                <option value="{{ $br->id }}">{{ $br->bank_name. " - ". $br->location}}</option>
                @endforeach


                @endif

            </select>
            </div>
        @endif

        <!-- Status Filter -->
        <div class="col-md-2 col-sm-12 mb-2">
            <label for="status" class="font-weight-bold">Status:</label>

            <select name="status" id="status" class="form-control">
                <option value="">All</option>



            </select>
        </div>

        <!-- Submit Button -->
        <div class="col-auto mb-2" style="margin-top:30px;">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('loan_report.sh_loan_report') }}" class="btn btn-secondary">Clear</a>
        </div>

    </div>
</form>

      <table class="table table-bordered" style="margin-bottom: 20px;" id="sh_loanTable">
      <thead>
        <tr>
            <th>Loan No</th>
            <th>Cust.ID</th>
            <th>Cust.Name</th>
            <th>S.H.Name</th>
            <th>S.H.Loan Number</th>
            <th>Loan Amount</th>
            <th>Month</th>
            <th>Int Rate</th>
            <th>L.Date</th>



        </tr>
    </thead>
    <tbody>
        @foreach($other_loans as $loan)
            <tr>
                <td>{{ $loan->customer_loan_no }}</td>
                <td>{{ $loan->customer ? $loan->customer->customer_id : 'N/A' }}</td> <!-- Displaying customer ID -->
                <td>{{ $loan->customer ? $loan->customer->first_name." ".$loan->customer->last_name : 'N/A' }}</td> <!-- Displaying customer name -->
                <td>{{ $loan->bank->bank_name ? $loan->bank->bank_name : 'N/A'  }}</td>
                <td>{{ $loan->bank_loan_number ? $loan->bank_loan_number : 'N/A'  }}</td>
                <td>{{ $loan->loan_amount }}</td>
                <td>{{ $loan->tenurity }}</td>
                <td>{{ $loan->interest_rate }}</td>
                <td>{{ date('d-m-Y',strtotime($loan->loan_date)) }}</td> <!-- Assuming loan_date is a Carbon instance -->




            </tr>
        @endforeach
    </tbody>

    </table>
  </div>
</div>


</div>


<!-- Pay Interest Modal -->
<!-- Modal -->





<script>
new DataTable('#sh_loanTable', {
    buttons: [
        'excel'
    ],
    layout: {
        topStart: 'buttons'
    }
});


</script>






@endsection
