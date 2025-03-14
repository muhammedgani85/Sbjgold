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
  <span class="text-muted fw-light" style="color:red !important;">Loans Interest</span>
</h4>

<div class="row">

  <!-- Form controls -->

  <div class="card">
    <div class="table-responsive text-nowrap">

    <form method="GET" action="{{ route('report.intrestreport') }}" class="mb-3 p-3 border rounded bg-light" style="margin-top: 20px;">
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
<!-- Branch Filter (Only for specific roles) -->
      @if(in_array($role, [1, 9, 10]))
            <div class="col-md-2 col-sm-12 mb-2">
            <label for="branch_id" class="font-weight-bold">Branch:</label>
            <select name="location" id="location" class="form-control">
                <option value="">All</option>
                @if (isset($branch))

                @foreach ($branch as $br)
                <option value="{{ $br->id }}">{{ $br->branch_name }}</option>
                @endforeach


                @endif

            </select>
            </div>
        @endif

        <!-- Status Filter -->
        <div class="col-md-2 col-sm-12 mb-2" style="display: none;">
            <label for="status" class="font-weight-bold">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="">All</option>

                @if (isset($loan_status))

                @foreach ($loan_status as $lstatus)
                <option value="{{ $lstatus }}">{{ $lstatus }}</option>
                @endforeach


                @endif

            </select>

        </div>

        <!-- Submit Button -->
        <div class="col-auto mb-2" style="margin-top:30px;">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('report.intrestreport') }}" class="btn btn-secondary">Clear</a>
        </div>

    </div>
</form>


      <table class="table table-bordered" style="margin-bottom: 20px;" id="loanReport">
        <thead>
          <tr>

            <th>Loan No</th>
            <th>Month</th>
            <th>Paid Amount</th>
            <th>Mode</th>
            <th>Location</th>
            <th>Paid Date</th>


          </tr>
        </thead>


        <tbody>
          @if (isset($inrest_Reports))
          @foreach ( $inrest_Reports as $interest)



          <tr>
            <td>{{ $interest->loan_id}} </td>
            <td>{{ $interest->month}} </td>
            <td>{{ $interest->interest_amount}} </td>
            <td>{{ $interest->payment_method}} </td>
            <td>{{ $interest->location}} </td>
            <td>{{ $interest->created_at}} </td>

          </tr>
          @endforeach
          @endif
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
