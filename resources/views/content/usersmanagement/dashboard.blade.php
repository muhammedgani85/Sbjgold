@extends('layouts/contentNavbarLayout')

@section('title', 'Users Management')

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
  <span class="text-muted fw-light" style="color:red !important;">Employee Dashboard</span>
</h4>

<div class="row">
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="card" style="background-color: #FED8B1;color:#000;font-weight:bold;">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Employees</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $total = $users->count();  }}</h4>
                <!-- <small class="text-success">(+29%)</small> -->
              </div>
              <p class="mb-0">Total Employees</p>
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
      <div class="card" style="background-color: #90EE90;color:#000;font-weight:bold;">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Active Employees</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $activeCount = $users->where('status', 'Active')->count();  }}</h4>
                <!-- <small class="text-success">(+18%)</small> -->
              </div>
              <p class="mb-0">Up to Date </p>
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
      <div class="card" style="background-color: #FF7F7F;color:#000;font-weight:bold;">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>InActive Employees</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $activeCount = $users->where('status', 'InActive')->count();  }}</h4>
                <!-- <small class="text-danger">(-14%)</small> -->
              </div>
              <p class="mb-0">Up to Date </p>
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
      <div class="card" style="background-color: #CBC3E3;color:#000;font-weight:bold;">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Resigned Employees</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2" style="color:#000;font-weight:bold;">{{ $activeCount = $users->where('status', 'Resigned')->count();  }}</h4>
                <!-- <small class="text-success">(+42%)</small> -->
              </div>
              <p class="mb-0">Up to Date </p>
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
    <h5 class="card-header" style="color:red;">Employee List(s)</h5>


    <div class="table-responsive text-nowrap">

      <table class="display" id="usersTable">
        <thead>
          <tr>
            <th>S.No</th>
            <th>Emp.ID</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>City</th>
            <!-- <th>Aadhar Number</th> -->
            <th>Location</th>
            <th>Role</th>
            <th>Status</th>
            <th>User Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($users as $user)
          <tr>
            <td class="text-left">{{ $loop->iteration }}</td>
            <td class="text-left">{{ $user->emp_id }}</td>
            <td class="text-left">{{ $user->initial }} {{ $user->first_name }} {{ $user->last_name }} </td>

            <td class="text-left">{{ $user->phone_number }}</td>
            <td class="text-left">{{ $user->city }}</td>
            <!-- <td class="text-left">{{ $user->aadhar_number }}</td> -->
            <td class="text-left">{{ getLocationName($user->location) }} </td>
            <td class="text-left">{{ getRoleName($user->role) }}</td>
            <td class="text-left {{ $user->status === 'Active' ? 'text-success' : ($user->status === 'Inactive' ? 'text-warning' : 'text-danger') }}">
              {{ $user->status }}
            </td>
            <td class="text-left">{{ $user->user_name }}</td>
            <td class="text-left">
              <div class="dropdown">
                <a href="javascript:void(0);" data-id="{{ $user->id }}" class="btn-delete" title="Inactive"><i class="bx bx-trash me-1" style='color:red;'></i></a>
                <a href="{{ route('users.edit', $user->id) }}" title="edit"><i class="bx bx-pencil me-1"></i></a>
                <a href="javascript:void(0);" title="details"><i class='bx bxs-detail'></i></a>

              </div>
    </div>
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
            url: '{{ route("users.softDelete", "") }}/' + userId,
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

/* Add link in head section */
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

@endsection