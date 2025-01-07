@extends('layouts/contentNavbarLayout')

@section('title', 'Customer Management')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Include other styles here -->
@section('content')


<div class="row">



  <!-- Form controls -->

  <div class="card">
  <div class="card-header" >
        <form method="GET" action="{{ url('today_business') }}" class="form-inline">
            <div class="form-group mx-sm-3 mb-2">
                <label for="date" class="sr-only">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ request('date', now()->toDateString()) }}">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="location" class="sr-only">Location</label>
                <select id="location" name="location" class="form-control">
                    <option value="">All Locations</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ request('location') == $location->id ? 'selected' : '' }}>
                            {{ $location->branch_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Filter</button>
        </form>
    </div>
    <div class="table-responsive text-nowrap">

    <div align="center"><h4  style="color:red;">SELVA JEYAM GOLD FINANACE (P) LTD</h4></div>
    <div align="center"><h5  style="color:red;">TODAY BUSINESS REPORT - @php echo date('d-m-Y') @endphp</h5></div>
      <table class="table" >
      <thead>
        <tr>
            <th>Particular</th>
            <th>Amount</th>
            <th>Grams</th>
        </tr>
    </thead>
    <tbody>
        <!-- New Loans -->
        <tr>
            <td>New Loans</td>
            <td>{{ number_format($dailyReport['new_loans']['amount'], 2) }}</td>
            <td>{{ number_format($dailyReport['new_loans']['grams'], 2) }}</td>
        </tr>
        <!-- Released Loans -->
        <tr>
            <td>Released Loans</td>
           <!--  <td>{{ number_format($dailyReport['released_loans']['amount'], 2) }}</td>
            <td>{{ number_format($dailyReport['released_loans']['grams'], 2) }}</td> -->
            <td>{{ number_format($dailyReport['loan_release']['amount'], 2) }}</td>
            <td>{{ number_format($dailyReport['loan_release']['total_grams'], 2) }}</td>
        </tr>
        <!-- Total Loans Upto Today -->

        <tr>
            <td>SJ Document Charge</td>
            <td>{{ number_format($dailyReport['total_loans_upto_today']['total_document_charges'], 2) }}</td>
            <td>--</td> <!-- No grams for this category -->
        </tr>
        <!-- Today's Expenses -->
        <tr>
            <td>Today's Expenses</td>
            <td>{{ number_format($dailyReport['today_expenses'], 2) }}</td>
            <td>—</td> <!-- No grams for this category -->
        </tr>
        <!-- Interest Received -->
        <tr>
            <td>Interest Received</td>
            <td>{{ number_format($dailyReport['interest_received'], 2) }}</td>
            <td>—</td> <!-- No grams for this category -->
        </tr>
        <tr>
            <td>SH Document Charge</td>
            <td>{{ number_format($dailyReport['other_bank_loans']['other_bank_document_charges'], 2) }}</td>
            <td>--</td> <!-- No grams for this category -->
        </tr>
        <tr>
            <td style="color:green !important;font-weight:bold;">OB Loans</td>
            <td style="color:green !important;font-weight:bold;">{{ number_format($dailyReport['other_bank_loans']['amount'], 2) }}</td>
            <td style="color:green !important;font-weight:bold;">{{ number_format($dailyReport['other_bank_loans']['grams'], 2) }}</td>
        </tr>

    </tbody>
    <tfoot>
        <!-- Totals -->
        <tr>
            <th>Total</th>
            <th style="color:red; font-weight:bold;">
                {{ number_format(
                    $dailyReport['new_loans']['amount'] +
                    $dailyReport['released_loans']['amount'] +
                    $dailyReport['total_loans_upto_today']['amount'] +
                    $dailyReport['today_expenses'] +
                    $dailyReport['interest_received'], 2) }}
            </th>
            <th style="color:red; font-weight:bold;">
                {{ number_format(
                    $dailyReport['new_loans']['grams'] +
                    $dailyReport['released_loans']['grams'] + $dailyReport['total_loans_upto_today']['upto_total_grams'] + $dailyReport['other_bank_loans']['grams'], 2)  }}
            </th>
        </tr>
    </tfoot>


    </table>
  </div>
</div>


</div>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Popper.js for Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




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










@endsection
