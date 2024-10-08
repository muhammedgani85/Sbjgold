@extends('layouts/contentNavbarLayout')

@section('title', 'Users Management')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection

@section('content')



<div>
  <h4 class="text-muted fw-light">Loans</h4>
</div>

<div class="row">
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Total</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">6</h4>
                <!-- <small class="text-success">(+29%)</small> -->
              </div>
              <p class="mb-0">Total Loans - Active</p>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-primary">
                <i class="bx bx-user bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Today</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">3</h4>
                <!-- <small class="text-success">(+18%)</small> -->
              </div>
              <p class="mb-0">Today </p>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-success">
                <i class="bx bx-user-check bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Month</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">2</h4>
                <!-- <small class="text-danger">(-14%)</small> -->
              </div>
              <p class="mb-0">Up to date </p>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-danger">
                <i class="bx bx-group bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Years</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">1</h4>
                <!-- <small class="text-success">(+42%)</small> -->
              </div>
              <p class="mb-0">Current Year </p>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-warning">
                <i class="bx bx-user-voice bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Form controls -->

  <div class="card">
    <h5 class="card-header">Loan List(s)</h5>


    <div class="table-responsive text-nowrap">
      <!-- <div style='float:right;'><a href="{{ url('users/create') }}"><button type="button" class="btn rounded-pill btn-primary">Add User</button></a></div> -->
      <table class="table" id="example">
        <thead>
          <tr>
            <th>Customer Name</th>
            <th>Cust.ID</th>
            <th>Mobile Number</th>
            <th>Loan ID</th>
            <th>Particular</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Duration</th>
            <th>Int<span style='font-size:8px;color:red;'>(upto date)</span></th>

            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <tr>
            <td><i class="bx bxl-angular bx-sm text-danger me-3"></i> <span class="fw-medium">Kannan</span></td>
            <td>N0001</td>
            <td>9000012345</td>
            <td>CF0001</td>
            <td><span class="badge bg-label-primary me-1">Chain</span></td>
            <td>12K</td>
            <td><span class="badge bg-label-primary me-1">25gm</span></td>
            <td>102 days</td>
            <td><span style='color:red;'>Rs.1000</span></td>
            <td>
              <div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon delete-record"><i class="bx bx-show mx-1"></i></button>
                <button class="btn btn-sm btn-icon delete-record"><i class="bx bx-paper-plane mx-1"></i></button>
              </div>
            </td>
          </tr>
          <tr>
            <td><i class="bx bxl-angular bx-sm text-danger me-3"></i> <span class="fw-medium">Batcha</span></td>
            <td>N0001</td>
            <td>9000012987</td>
            <td>CF0002</td>
            <td><span class="badge bg-label-primary me-1">Ring</span></td>
            <td>11K</td>
            <td><span class="badge bg-label-primary me-1">12gm</span></td>
            <td>67 days</td>
            <td><span style='color:red;'>Rs.50</span></td>
            <td>
              <div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon delete-record"><i class="bx bx-show mx-1"></i></button>
                <button class="btn btn-sm btn-icon delete-record"><i class="bx bx-paper-plane mx-1"></i></button>

              </div>
            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>


</div>




<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

<script>
  new DataTable('#example', {
    layout: {
      topStart: {
        pageLength: {
          menu: [10, 25, 50, 100]

        }

      },
      topEnd: {
        search: {
          placeholder: 'Type search here'
        }
      },
      bottomEnd: {
        paging: {
          numbers: 3
        }
      }
    }
  });
</script>

@endsection