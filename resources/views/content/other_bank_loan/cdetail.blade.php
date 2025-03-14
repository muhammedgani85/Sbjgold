@extends('layouts/contentNavbarLayout')

@section('title', 'Customer Management')

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
  <span class="text-muted fw-light" style="color:red !important;">Customer Dashboard</span>
</h4>

<div class="row">
  <!-- User Sidebar -->
  <div class="col-xl-4 col-lg-5 order-1 order-md-0">
    <!-- User Card -->
    <div class="card mb-6">
      <div class="card-body pt-12">
        <div class="user-avatar-section">
          <div class=" d-flex align-items-center flex-column">
            <img class="img-fluid rounded mb-4" src="../../assets/img/avatars/1.png" height="120" width="120" alt="User avatar">
            <div class="user-info text-center">
              <h5>Violet Mendoza</h5>
              <span class="badge bg-label-secondary">Author</span>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
          <div class="d-flex align-items-center me-5 gap-4">
            <div class="avatar">
              <div class="avatar-initial bg-label-primary rounded w-px-40 h-px-40">
                <i class="bx bx-check bx-lg"></i>
              </div>
            </div>
            <div>
              <h5 class="mb-0">1.23k</h5>
              <span>Task Done</span>
            </div>
          </div>
          <div class="d-flex align-items-center gap-4">
            <div class="avatar">
              <div class="avatar-initial bg-label-primary rounded w-px-40 h-px-40">
                <i class="bx bx-customize bx-lg"></i>
              </div>
            </div>
            <div>
              <h5 class="mb-0">568</h5>
              <span>Project Done</span>
            </div>
          </div>
        </div>
        <h5 class="pb-4 border-bottom mb-4">Details</h5>
        <div class="info-container">
          <ul class="list-unstyled mb-6">
            <li class="mb-2">
              <span class="h6">Username:</span>
              <span>@violet.dev</span>
            </li>
            <li class="mb-2">
              <span class="h6">Email:</span>
              <span>vafgot@vultukir.org</span>
            </li>
            <li class="mb-2">
              <span class="h6">Status:</span>
              <span>Active</span>
            </li>
            <li class="mb-2">
              <span class="h6">Role:</span>
              <span>Author</span>
            </li>
            <li class="mb-2">
              <span class="h6">Tax id:</span>
              <span>Tax-8965</span>
            </li>
            <li class="mb-2">
              <span class="h6">Contact:</span>
              <span>(123) 456-7890</span>
            </li>
            <li class="mb-2">
              <span class="h6">Languages:</span>
              <span>French</span>
            </li>
            <li class="mb-2">
              <span class="h6">Country:</span>
              <span>England</span>
            </li>
          </ul>
          <div class="d-flex justify-content-center">
            <a href="javascript:;" class="btn btn-primary me-4" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
            <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspend</a>
          </div>
        </div>
      </div>
    </div>
    <!-- /User Card -->
    <!-- Plan Card -->
    <div class="card mb-6 border border-2 border-primary rounded primary-shadow">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
          <span class="badge bg-label-primary">Standard</span>
          <div class="d-flex justify-content-center">
            <sub class="h5 pricing-currency mb-auto mt-1 text-primary">$</sub>
            <h1 class="mb-0 text-primary">99</h1>
            <sub class="h6 pricing-duration mt-auto mb-3 fw-normal">month</sub>
          </div>
        </div>
        <ul class="list-unstyled g-2 my-6">
          <li class="mb-2 d-flex align-items-center"><i class="bx bxs-circle bx-6px text-secondary me-2"></i><span>10 Users</span></li>
          <li class="mb-2 d-flex align-items-center"><i class="bx bxs-circle bx-6px text-secondary me-2"></i><span>Up to 10 GB storage</span></li>
          <li class="mb-2 d-flex align-items-center"><i class="bx bxs-circle bx-6px text-secondary me-2"></i><span>Basic Support</span></li>
        </ul>
        <div class="d-flex justify-content-between align-items-center mb-1">
          <span class="h6 mb-0">Days</span>
          <span class="h6 mb-0">26 of 30 Days</span>
        </div>
        <div class="progress mb-1">
          <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <small>4 days remaining</small>
        <div class="d-grid w-100 mt-6">
          <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Upgrade Plan</button>
        </div>
      </div>
    </div>
    <!-- /Plan Card -->
  </div>
  <!--/ User Sidebar -->


  <!-- User Content -->
  <div class="col-xl-8 col-lg-7 order-0 order-md-1">
    <!-- User Pills -->
    <div class="nav-align-top">
      <ul class="nav nav-pills flex-column flex-md-row mb-6">
        <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user bx-sm me-1_5"></i>Account</a></li>
        <li class="nav-item"><a class="nav-link" href="app-user-view-security.html"><i class="bx bx-lock-alt bx-sm me-1_5"></i>Security</a></li>
        <li class="nav-item"><a class="nav-link" href="app-user-view-billing.html"><i class="bx bx-detail bx-sm me-1_5"></i>Billing &amp; Plans</a></li>
        <li class="nav-item"><a class="nav-link" href="app-user-view-notifications.html"><i class="bx bx-bell bx-sm me-1_5"></i>Notifications</a></li>
        <li class="nav-item"><a class="nav-link" href="app-user-view-connections.html"><i class="bx bx-link bx-sm me-1_5"></i>Connections</a></li>
      </ul>
    </div>
    <!--/ User Pills -->

    <!-- Project table -->
    <div class="card mb-6">
      <h5 class="card-header pb-0 text-sm-start text-center">Projects List</h5>
      <div class="table-responsive mb-4">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="d-flex justify-content-between align-items-center flex-column flex-sm-row mx-6 row"><div class="col-sm-4 col-12 d-flex align-items-center justify-content-sm-start justify-content-center"><div class="dataTables_length" id="DataTables_Table_0_length"><label><select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select mx-0"><option value="7">7</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="75">75</option><option value="100">100</option></select></label></div></div><div class="col-sm-8 col-12 d-flex align-items-center justify-content-sm-end justify-content-center mt-sm-0 mt-n6"><div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input type="search" class="form-control" placeholder="Search Project" aria-controls="DataTables_Table_0"></label></div></div></div><table class="table datatable-project dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 863px;">
          <thead class="border-top">
            <tr><th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=""></th><th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all" rowspan="1" colspan="1" style="width: 18px;" data-col="1" aria-label=""><input type="checkbox" class="form-check-input"></th><th class="sorting sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 186px;" aria-label="Project: activate to sort column ascending" aria-sort="descending">Project</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 71px;" aria-label="Leader: activate to sort column ascending">Leader</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 73px;" aria-label="Team">Team</th><th class="w-px-200 sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 200px;" aria-label="Progress: activate to sort column ascending">Progress</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 57px;" aria-label="Action">Action</th></tr>
          </thead><tbody><tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td><td class="sorting_1"><div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><span class="avatar-initial rounded-circle bg-label-info">WS</span></div></div><div class="d-flex flex-column gap-50"><span class="text-truncate fw-medium text-heading">Website SEO</span><small class="text-truncate">10 May 2021</small></div></div></td><td><span class="text-heading">Eileen</span></td><td><div class="d-flex align-items-center"><ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2"><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/10.png" alt="Avatar"></li><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/3.png" alt="Avatar"></li><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/2.png" alt="Avatar"></li><li class="avatar avatar-xs"><span class="avatar-initial rounded-circle pull-up text-heading" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="4 more">+4</span></li></ul></div></td><td><div class="d-flex align-items-center"><div class="progress w-100 me-3" style="height: 6px;"><div class="progress-bar" style="width: 38%" aria-valuenow="38%" aria-valuemin="0" aria-valuemax="100"></div></div><span class="text-heading">38%</span></div></td><td><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div></td></tr><tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td><td class="sorting_1"><div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="../../assets/img/icons/brands/social-label.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column gap-50"><span class="text-truncate fw-medium text-heading">Social Banners</span><small class="text-truncate">03 Jan 2021</small></div></div></td><td><span class="text-heading">Owen</span></td><td><div class="d-flex align-items-center"><ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2"><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/11.png" alt="Avatar"></li><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/10.png" alt="Avatar"></li><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/7.png" alt="Avatar"></li><li class="avatar avatar-xs"><span class="avatar-initial rounded-circle pull-up text-heading" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="2 more">+2</span></li></ul></div></td><td><div class="d-flex align-items-center"><div class="progress w-100 me-3" style="height: 6px;"><div class="progress-bar" style="width: 45%" aria-valuenow="45%" aria-valuemin="0" aria-valuemax="100"></div></div><span class="text-heading">45%</span></div></td><td><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div></td></tr><tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td><td class="sorting_1"><div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="../../assets/img/icons/brands/sketch-label.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column gap-50"><span class="text-truncate fw-medium text-heading">Logo Designs</span><small class="text-truncate">12 Aug 2021</small></div></div></td><td><span class="text-heading">Keith</span></td><td><div class="d-flex align-items-center"><ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2"><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar"></li><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/7.png" alt="Avatar"></li><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/12.png" alt="Avatar"></li><li class="avatar avatar-xs"><span class="avatar-initial rounded-circle pull-up text-heading" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="1 more">+1</span></li></ul></div></td><td><div class="d-flex align-items-center"><div class="progress w-100 me-3" style="height: 6px;"><div class="progress-bar" style="width: 92%" aria-valuenow="92%" aria-valuemin="0" aria-valuemax="100"></div></div><span class="text-heading">92%</span></div></td><td><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div></td></tr><tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td><td class="sorting_1"><div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="../../assets/img/icons/brands/sketch-label.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column gap-50"><span class="text-truncate fw-medium text-heading">IOS App Design</span><small class="text-truncate">19 Apr 2021</small></div></div></td><td><span class="text-heading">Merline</span></td><td><div class="d-flex align-items-center"><ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2"><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/2.png" alt="Avatar"></li><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/8.png" alt="Avatar"></li><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar"></li><li class="avatar avatar-xs"><span class="avatar-initial rounded-circle pull-up text-heading" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="1 more">+1</span></li></ul></div></td><td><div class="d-flex align-items-center"><div class="progress w-100 me-3" style="height: 6px;"><div class="progress-bar" style="width: 56%" aria-valuenow="56%" aria-valuemin="0" aria-valuemax="100"></div></div><span class="text-heading">56%</span></div></td><td><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div></td></tr><tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td><td class="sorting_1"><div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="../../assets/img/icons/brands/figma-label.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column gap-50"><span class="text-truncate fw-medium text-heading">Figma Dashboards</span><small class="text-truncate">08 Apr 2021</small></div></div></td><td><span class="text-heading">Harmonia</span></td><td><div class="d-flex align-items-center"><ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2"><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/9.png" alt="Avatar"></li><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/2.png" alt="Avatar"></li><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/4.png" alt="Avatar"></li></ul></div></td><td><div class="d-flex align-items-center"><div class="progress w-100 me-3" style="height: 6px;"><div class="progress-bar" style="width: 25%" aria-valuenow="25%" aria-valuemin="0" aria-valuemax="100"></div></div><span class="text-heading">25%</span></div></td><td><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div></td></tr><tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td><td class="sorting_1"><div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="../../assets/img/icons/brands/html-label.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column gap-50"><span class="text-truncate fw-medium text-heading">Crypto Admin</span><small class="text-truncate">29 Sept 2021</small></div></div></td><td><span class="text-heading">Allyson</span></td><td><div class="d-flex align-items-center"><ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2"><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/7.png" alt="Avatar"></li><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/3.png" alt="Avatar"></li><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/7.png" alt="Avatar"></li><li class="avatar avatar-xs"><span class="avatar-initial rounded-circle pull-up text-heading" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="1 more">+1</span></li></ul></div></td><td><div class="d-flex align-items-center"><div class="progress w-100 me-3" style="height: 6px;"><div class="progress-bar" style="width: 36%" aria-valuenow="36%" aria-valuemin="0" aria-valuemax="100"></div></div><span class="text-heading">36%</span></div></td><td><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div></td></tr><tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td><td class="sorting_1"><div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="../../assets/img/icons/brands/react-label.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column gap-50"><span class="text-truncate fw-medium text-heading">Create Website</span><small class="text-truncate">20 Mar 2021</small></div></div></td><td><span class="text-heading">Georgie</span></td><td><div class="d-flex align-items-center"><ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2"><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/2.png" alt="Avatar"></li><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar"></li><li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Kim Karlos" data-bs-original-title="Kim Karlos"><img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar"></li><li class="avatar avatar-xs"><span class="avatar-initial rounded-circle pull-up text-heading" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="3 more">+3</span></li></ul></div></td><td><div class="d-flex align-items-center"><div class="progress w-100 me-3" style="height: 6px;"><div class="progress-bar" style="width: 72%" aria-valuenow="72%" aria-valuemin="0" aria-valuemax="100"></div></div><span class="text-heading">72%</span></div></td><td><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div></td></tr></tbody>
        </table><div class="d-flex justify-content-between mx-6 row"><div class="col-sm-12 col-md-6"><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 7 of 10 entries</div></div><div class="col-sm-12 col-md-6"><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1" class="page-link"><i class="bx bx-chevron-left bx-18px"></i></a></li><li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="next" tabindex="0" class="page-link"><i class="bx bx-chevron-right bx-18px"></i></a></li></ul></div></div></div><div style="width: 1%;"></div></div>
      </div>
    </div>
    <!-- /Project table -->

    <!-- Activity Timeline -->
    <div class="card mb-6">
      <h5 class="card-header">User Activity Timeline</h5>
      <div class="card-body pt-1">
        <ul class="timeline mb-0">
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-primary"></span>
            <div class="timeline-event">
              <div class="timeline-header mb-3">
                <h6 class="mb-0">12 Invoices have been paid</h6>
                <small class="text-muted">12 min ago</small>
              </div>
              <p class="mb-2">
                Invoices have been paid to the company
              </p>
              <div class="d-flex align-items-center mb-2">
                <div class="badge bg-lighter rounded d-flex align-items-center">
                  <img src="../../assets//img/icons/misc/pdf.png" alt="img" width="15" class="me-2">
                  <span class="h6 mb-0 text-body">invoices.pdf</span>
                </div>
              </div>
            </div>
          </li>
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-success"></span>
            <div class="timeline-event">
              <div class="timeline-header mb-3">
                <h6 class="mb-0">Client Meeting</h6>
                <small class="text-muted">45 min ago</small>
              </div>
              <p class="mb-2">
                Project meeting with john @10:15am
              </p>
              <div class="d-flex justify-content-between flex-wrap gap-2 mb-2">
                <div class="d-flex flex-wrap align-items-center mb-50">
                  <div class="avatar avatar-sm me-2">
                    <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                  </div>
                  <div>
                    <p class="mb-0 small fw-medium">Lester McCarthy (Client)</p>
                    <small>CEO of ThemeSelection</small>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-point timeline-point-info"></span>
            <div class="timeline-event">
              <div class="timeline-header mb-3">
                <h6 class="mb-0">Create a new project for client</h6>
                <small class="text-muted">2 Day Ago</small>
              </div>
              <p class="mb-2">
                6 team members in a project
              </p>
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
                  <div class="d-flex flex-wrap align-items-center">
                    <ul class="list-unstyled users-list d-flex align-items-center avatar-group m-0 me-2">
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                        <img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar">
                      </li>
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Allen Rieske" data-bs-original-title="Allen Rieske">
                        <img class="rounded-circle" src="../../assets/img/avatars/12.png" alt="Avatar">
                      </li>
                      <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up" aria-label="Julee Rossignol" data-bs-original-title="Julee Rossignol">
                        <img class="rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar">
                      </li>
                      <li class="avatar">
                        <span class="avatar-initial rounded-circle pull-up text-heading" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="3 more">+3</span>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <!-- /Activity Timeline -->

    <!-- Invoice table -->
    <div class="card mb-4">
      <div class="card-datatable table-responsive">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row mx-6"><div class="col-sm-6 col-12 d-flex align-items-center justify-content-center justify-content-sm-start mt-6 mt-sm-0"><div class="head-label"><h5 class="card-title mb-0">Invoice List</h5></div></div><div class="col-sm-6 col-12 d-flex justify-content-center justify-content-md-end align-items-baseline"><div class="dt-action-buttons d-flex justify-content-center flex-md-row align-items-baseline gap-4"><div class="dataTables_length" id="DataTables_Table_1_length"><label><select name="DataTables_Table_1_length" aria-controls="DataTables_Table_1" class="form-select mx-0"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></label></div><div class="dt-buttons btn-group flex-wrap"><div class="btn-group"><button class="btn btn-secondary buttons-collection dropdown-toggle btn-label-secondary float-sm-end mb-3 mb-sm-0" tabindex="0" aria-controls="DataTables_Table_1" type="button" aria-haspopup="dialog" aria-expanded="false"><span><i class="bx bx-export bx-sm me-2"></i>Export</span></button></div> </div></div></div></div><table class="table datatable-invoice dataTable no-footer dtr-column" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info" style="width: 865px;">
          <thead>
            <tr><th class="control sorting dtr-hidden" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=": activate to sort column ascending"></th><th class="sorting sorting_desc" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 88px;" aria-label="#: activate to sort column ascending" aria-sort="descending">#</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 104px;" aria-label="Status: activate to sort column ascending">Status</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 91px;" aria-label="Total: activate to sort column ascending">Total</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 159px;" aria-label="Issued Date: activate to sort column ascending">Issued Date</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 203px;" aria-label="Actions">Actions</th></tr>
          </thead><tbody><tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><a href="app-invoice-preview.html"><span>#5089</span></a></td><td><span class="d-inline-block" data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Sent<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 05/09/2020</span>" data-bs-original-title="<span>Sent<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 05/09/2020</span>"><span class="badge badge-center d-flex align-items-center justify-content-center rounded-pill bg-label-success w-px-30 h-px-30"><i class="bx bx-check bx-xs"></i></span></span></td><td>$3077</td><td>05/02/2020</td><td><div class="d-flex align-items-center"><a href="javascript:;" class="btn btn-icon delete-record"><i class="bx bx-trash bx-md"></i></a><a href="app-invoice-preview.html" class="btn btn-icon" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show bx-md"></i></a><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Download</a><a href="app-invoice-edit.html" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Duplicate</a></div></div></div></td></tr><tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><a href="app-invoice-preview.html"><span>#5041</span></a></td><td><span class="d-inline-block" data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Sent<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 11/19/2020</span>" data-bs-original-title="<span>Sent<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 11/19/2020</span>"><span class="badge badge-center d-flex align-items-center justify-content-center rounded-pill bg-label-success w-px-30 h-px-30"><i class="bx bx-check bx-xs"></i></span></span></td><td>$2230</td><td>02/01/2021</td><td><div class="d-flex align-items-center"><a href="javascript:;" class="btn btn-icon delete-record"><i class="bx bx-trash bx-md"></i></a><a href="app-invoice-preview.html" class="btn btn-icon" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show bx-md"></i></a><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Download</a><a href="app-invoice-edit.html" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Duplicate</a></div></div></div></td></tr><tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><a href="app-invoice-preview.html"><span>#5027</span></a></td><td><span class="d-inline-block" data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 09/25/2020</span>" data-bs-original-title="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 09/25/2020</span>"><span class="badge badge-center d-flex align-items-center justify-content-center rounded-pill bg-label-secondary w-px-30 h-px-30"><i class="bx bx-envelope bx-xs"></i></span></span></td><td>$2787</td><td>09/28/2020</td><td><div class="d-flex align-items-center"><a href="javascript:;" class="btn btn-icon delete-record"><i class="bx bx-trash bx-md"></i></a><a href="app-invoice-preview.html" class="btn btn-icon" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show bx-md"></i></a><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Download</a><a href="app-invoice-edit.html" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Duplicate</a></div></div></div></td></tr><tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><a href="app-invoice-preview.html"><span>#5024</span></a></td><td><span class="d-inline-block" data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> -$202<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 08/02/2020</span>" data-bs-original-title="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> -$202<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 08/02/2020</span>"><span class="badge badge-center d-flex align-items-center justify-content-center rounded-pill bg-label-secondary w-px-30 h-px-30"><i class="bx bx-envelope bx-xs"></i></span></span></td><td>$5285</td><td>06/30/2020</td><td><div class="d-flex align-items-center"><a href="javascript:;" class="btn btn-icon delete-record"><i class="bx bx-trash bx-md"></i></a><a href="app-invoice-preview.html" class="btn btn-icon" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show bx-md"></i></a><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Download</a><a href="app-invoice-edit.html" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Duplicate</a></div></div></div></td></tr><tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><a href="app-invoice-preview.html"><span>#5020</span></a></td><td><span class="d-inline-block" data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Downloaded<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 12/15/2020</span>" data-bs-original-title="<span>Downloaded<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 12/15/2020</span>"><span class="badge badge-center d-flex align-items-center justify-content-center rounded-pill bg-label-info w-px-30 h-px-30"><i class="bx bx-down-arrow-alt bx-xs"></i></span></span></td><td>$5219</td><td>07/17/2020</td><td><div class="d-flex align-items-center"><a href="javascript:;" class="btn btn-icon delete-record"><i class="bx bx-trash bx-md"></i></a><a href="app-invoice-preview.html" class="btn btn-icon" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show bx-md"></i></a><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Download</a><a href="app-invoice-edit.html" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Duplicate</a></div></div></div></td></tr><tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><a href="app-invoice-preview.html"><span>#4995</span></a></td><td><span class="d-inline-block" data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 06/09/2020</span>" data-bs-original-title="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 06/09/2020</span>"><span class="badge badge-center d-flex align-items-center justify-content-center rounded-pill bg-label-secondary w-px-30 h-px-30"><i class="bx bx-envelope bx-xs"></i></span></span></td><td>$3313</td><td>08/21/2020</td><td><div class="d-flex align-items-center"><a href="javascript:;" class="btn btn-icon delete-record"><i class="bx bx-trash bx-md"></i></a><a href="app-invoice-preview.html" class="btn btn-icon" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show bx-md"></i></a><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Download</a><a href="app-invoice-edit.html" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Duplicate</a></div></div></div></td></tr><tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><a href="app-invoice-preview.html"><span>#4993</span></a></td><td><span class="d-inline-block" data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 10/22/2020</span>" data-bs-original-title="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 10/22/2020</span>"><span class="badge badge-center d-flex align-items-center justify-content-center rounded-pill bg-label-secondary w-px-30 h-px-30"><i class="bx bx-envelope bx-xs"></i></span></span></td><td>$4836</td><td>07/10/2020</td><td><div class="d-flex align-items-center"><a href="javascript:;" class="btn btn-icon delete-record"><i class="bx bx-trash bx-md"></i></a><a href="app-invoice-preview.html" class="btn btn-icon" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show bx-md"></i></a><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Download</a><a href="app-invoice-edit.html" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Duplicate</a></div></div></div></td></tr><tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><a href="app-invoice-preview.html"><span>#4989</span></a></td><td><span class="d-inline-block" data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Past Due<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 08/01/2020</span>" data-bs-original-title="<span>Past Due<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 08/01/2020</span>"><span class="badge badge-center d-flex align-items-center justify-content-center rounded-pill bg-label-danger w-px-30 h-px-30"><i class="bx bx-error bx-xs"></i></span></span></td><td>$5293</td><td>07/30/2020</td><td><div class="d-flex align-items-center"><a href="javascript:;" class="btn btn-icon delete-record"><i class="bx bx-trash bx-md"></i></a><a href="app-invoice-preview.html" class="btn btn-icon" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show bx-md"></i></a><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Download</a><a href="app-invoice-edit.html" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Duplicate</a></div></div></div></td></tr><tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><a href="app-invoice-preview.html"><span>#4989</span></a></td><td><span class="d-inline-block" data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Downloaded<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 09/23/2020</span>" data-bs-original-title="<span>Downloaded<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 09/23/2020</span>"><span class="badge badge-center d-flex align-items-center justify-content-center rounded-pill bg-label-info w-px-30 h-px-30"><i class="bx bx-down-arrow-alt bx-xs"></i></span></span></td><td>$3623</td><td>12/01/2020</td><td><div class="d-flex align-items-center"><a href="javascript:;" class="btn btn-icon delete-record"><i class="bx bx-trash bx-md"></i></a><a href="app-invoice-preview.html" class="btn btn-icon" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show bx-md"></i></a><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Download</a><a href="app-invoice-edit.html" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Duplicate</a></div></div></div></td></tr><tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><a href="app-invoice-preview.html"><span>#4965</span></a></td><td><span class="d-inline-block" data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> $666<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 03/18/2021</span>" data-bs-original-title="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> $666<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 03/18/2021</span>"><span class="badge badge-center d-flex align-items-center justify-content-center rounded-pill bg-label-secondary w-px-30 h-px-30"><i class="bx bx-envelope bx-xs"></i></span></span></td><td>$3789</td><td>09/27/2020</td><td><div class="d-flex align-items-center"><a href="javascript:;" class="btn btn-icon delete-record"><i class="bx bx-trash bx-md"></i></a><a href="app-invoice-preview.html" class="btn btn-icon" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show bx-md"></i></a><div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Download</a><a href="app-invoice-edit.html" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Duplicate</a></div></div></div></td></tr></tbody>
        </table><div class="row mx-6"><div class="col-sm-12 col-xxl-6 text-center text-xxl-start pb-md-2 pb-xxl-0"><div class="dataTables_info" id="DataTables_Table_1_info" role="status" aria-live="polite">Showing 1 to 10 of 50 entries</div></div><div class="col-sm-12 col-xxl-6 d-md-flex justify-content-xxl-end justify-content-center"><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="DataTables_Table_1_previous"><a aria-controls="DataTables_Table_1" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1" class="page-link"><i class="bx bx-chevron-left bx-18px"></i></a></li><li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_1" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_1" role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_1" role="link" data-dt-idx="2" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_1" role="link" data-dt-idx="3" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_1" role="link" data-dt-idx="4" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item next" id="DataTables_Table_1_next"><a href="#" aria-controls="DataTables_Table_1" role="link" data-dt-idx="next" tabindex="0" class="page-link"><i class="bx bx-chevron-right bx-18px"></i></a></li></ul></div></div></div></div>
      </div>
    </div>
    <!-- /Invoice table -->
  </div>
  <!--/ User Content -->
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
