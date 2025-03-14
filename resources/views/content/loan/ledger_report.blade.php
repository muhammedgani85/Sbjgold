@extends('layouts/contentNavbarLayout')

@section('title', 'Loan Reports')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Include other styles here -->


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
@section('content')
<h4 class="py-0 mb-4">
  <span class="text-muted fw-light" style="color:red !important;">Ledger</span>
</h4>

<div class="row">



  <!-- Form controls -->

  <div class="card">
    <div class="table-responsive text-nowrap">

    <form method="GET" action="{{ route('loan_report.index') }}" class="mb-3 p-3 border rounded bg-light" style="margin-top: 20px;">
    <div class="form-row align-items-center">

        <!-- Date Range Filter: From Date -->
        <div class="col-md-2col-sm-12 mb-2">
            <label for="from_date" class="font-weight-bold">From:</label>
            <input type="date" name="from_date" id="from_date" class="form-control" >
        </div>

        <!-- Date Range Filter: To Date -->
        <div class="col-md-2 col-sm-12 mb-2">
            <label for="to_date" class="font-weight-bold">To:</label>
            <input type="date" name="to_date" id="to_date" class="form-control">
        </div>

        <!-- Branch Filter (Only for specific roles) -->


        <!-- Status Filter -->
        <div class="col-md-2 col-sm-12 mb-2">
            <label for="status" class="font-weight-bold">Status:</label>


        </div>

        <!-- Submit Button -->
        <div class="col-auto mb-2" style="margin-top:30px;">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('loan_report.index') }}" class="btn btn-secondary">Clear</a>
        </div>

    </div>
</form>
<!-- Loader -->
<div id="loader" class="text-center mt-3" style="display: none;">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <p class="mt-2">Processing your request, please wait...</p>
</div>

<table class="table table-bordered" style="margin-bottom: 20px;">
    <thead>
        <tr>
            <th>Particulars</th>
            <th>Inflow (₹)</th>
            <th>Outflow (₹)</th>
            <th>Grams</th>
        </tr>
    </thead>
    <tbody>
        <!-- Opening Balance -->
        <tr>
            <td>Opening Balance</td>
            <td>{{ number_format($openingBalance, 2) }}</td>
            <td></td>
            <td></td>
        </tr>

        <!-- Loans -->
        <tr>
            <td>Total Loans</td>
            <td></td>
            <td>{{ number_format($totalLoans, 2) }}</td>
            <td></td>
            <td></td>
        </tr>

        <!-- Loan Interest -->
        <tr>
            <td>Total Interest</td>
            <td>{{ number_format($totalLoansInt, 2) }}</td>
            <td></td>
            <td></td>
        </tr>

        <!-- SH Loans -->
        <tr>
            <td>Total SH Loans</td>
            <td>{{ number_format($totalOtherLoans, 2) }}</td>
            <td></td>
            <td></td>
        </tr>

        <!-- Expenses -->
        <tr>
            <td>Total Expenses</td>
            <td></td>
            <td>{{ number_format($totalExpenses, 2) }}</td>
            <td></td>
        </tr>

        <!-- Net Balance -->
        <tr>
            <th>Net Balance</th>
            <th>{{ number_format($openingBalance + $totalLoans + $totalLoansInt + $totalOtherLoans, 2) }}</th>
            <th>{{ number_format($totalExpenses, 2) }}</th>
            <th></th>
        </tr>

        <!-- Closing Balance -->
        <tr>
            <th>Closing Balance</th>
            <th colspan="4" class="text-center">{{ number_format($netBalance, 2) }}</th>
        </tr>
    </tbody>
</table>

  </div>
</div>


</div>



<script>
new DataTable('#loanReport', {
    buttons: [
        'excel'
    ],
    layout: {
        topStart: 'buttons'
    }
});


</script>

@endsection
