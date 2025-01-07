@extends('layouts/contentNavbarLayout')

@section('title', 'Expenses Report')

@section('page-script')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

<!-- DataTables CSS -->
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

<style>
  .holiday {
    color: red;
  }

  .sunday {
    color: blue;
  }
</style>

<style>
.form-control {
    height: 40px; /* Set the height for input fields */
}
.btn {
    height: 40px; /* Make buttons the same height as inputs */
    margin-left: 5px; /* Optional: Add some space between buttons */
}
</style>

@section('content')
<h4 class="py-0 mb-4">
  <span class="text-muted fw-light" style="color:red !important;">Expenses</span>
</h4>

<div class="row">
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <div class="card">

    <div class="table-responsive text-nowrap" style="margin-top:30px;">
    <form action="{{ route('expenses.report.index') }}" method="GET" class="mb-3 p-3 border rounded bg-light">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <label for="from_date">From:</label>
                <input type="date" name="from_date" class="form-control" value="{{ $fromDate }}">
            </div>
            <div class="col-auto">
                <label for="to_date">To:</label>
                <input type="date" name="to_date" class="form-control" value="{{ $toDate }}">
            </div>
            <div class="col-auto">
                <label for="expense_type_id">Expense Type:</label>
                <select name="expense_type_id" class="form-control">
                    <option value="">All</option>
                    @foreach($expenseTypes as $type)
                        <option value="{{ $type->id }}" {{ $expenseTypeId == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Location Filter for Specific Roles -->
        @if(in_array($role, ['8','9','10']))
            <div class="col-auto mb-2">
                <label for="location">Location:</label>
                <select name="location" id="location" class="form-control">
                    <option value="">All</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ request('location') == $location->id ? 'selected' : '' }}>
                            {{ $location->branch_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
            <div class="form-group d-flex mb-2" style="margin-top:35px;">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('expenses.report.index') }}" class="btn btn-secondary">Clear</a>
            </div>
        </div>
    </form>



    <h6 class="mt-4" align="center" style="color:red;">Expenses Report for: {{ $fromDate }} to {{ $toDate }}</h6>

    <table class="table table-bordered" style="margin-bottom: 20px;"  id="expensesReportTable">
        <thead>
            <tr>
              <th>Date</th>
                <th>Expense Type</th>
                <th>Description</th>
                <th>Branch</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse($expenses as $expense)
                <tr>
                    <td>{{ date('d-m-Y',strtotime($expense->date)) ?? 'N/A' }}</td>
                    <td>{{ $expense->expenseType->name ?? 'N/A' }}</td>
                    <td>{{ $expense->description ?? 'N/A' }}</td>
                    <td>{{ $expense->branch->branch_name ?? 'N/A' }}</td>
                    <td>{{ number_format($expense->amount, 2) }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: red;">
                        No record found
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr >
                <th></th>
                <th></th>
                <th></th>
                <th style="color: green;">Grand Total</th>
                <th style="color: green;font-weight:bold;">{{ number_format($grandTotal, 2) }}</th>
            </tr>
        </tfoot>
    </table>
    </div>
  </div>
</div>


<script>
new DataTable('#expensesReportTable', {
    buttons: [
        'excel'
    ],
    layout: {
        topStart: 'buttons'
    }
});


</script>



@endsection
