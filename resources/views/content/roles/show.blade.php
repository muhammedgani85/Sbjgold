@extends('layouts/contentNavbarLayout')

@section('title', 'Basic Inputs - Forms')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Customer/</span> View
</h4>

<div class="row">
  <!-- User Sidebar -->
  <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
    <!-- User Card -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="user-avatar-section">
          <div class=" d-flex align-items-center flex-column">
            <img class="img-fluid rounded my-4" src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/10.png" height="110" width="110" alt="User avatar">
            <div class="user-info text-center">
              <h4 class="mb-2">Violet Mendoza</h4>
              <span class="badge bg-label-secondary">Author</span>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-around flex-wrap my-4 py-3">
          <div class="d-flex align-items-start me-4 mt-3 gap-3">
            <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-check bx-sm"></i></span>
            <div>
              <h5 class="mb-0">1.23k</h5>
              <span>Total Amount</span>
            </div>
          </div>
          <div class="d-flex align-items-start mt-3 gap-3">
            <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-customize bx-sm"></i></span>
            <div>
              <h5 class="mb-0">4</h5>
              <span>Loans</span>
            </div>
          </div>
        </div>
        <h5 class="pb-2 border-bottom mb-4">Details</h5>
        <div class="info-container">
          <ul class="list-unstyled">
            <li class="mb-3">
              <span class="fw-medium me-2">Username:</span>
              <span>Kadher Batcha</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">Email:</span>
              <span>vafgot@vultukir.org</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">Status:</span>
              <span class="badge bg-label-success">Active</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">Role:</span>
              <span>Customer</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">Tax id:</span>
              <span>Tax-8965</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">Contact:</span>
              <span>(123) 456-7890</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">Languages:</span>
              <span>French</span>
            </li>
            <li class="mb-3">
              <span class="fw-medium me-2">Country:</span>
              <span>England</span>
            </li>
          </ul>
          <div class="d-flex justify-content-center pt-3">
            <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
            <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspended</a>
          </div>
        </div>
      </div>
    </div>
    <!-- /User Card -->

  </div>
  <!--/ User Sidebar -->


  <!-- User Content -->
  <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
    <!-- User Pills -->
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i>Account</a></li>
      <li class="nav-item"><a class="nav-link" href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/user/view/security"><i class="bx bx-lock-alt me-1"></i>Invoice</a></li>
      <li class="nav-item"><a class="nav-link" href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/user/view/billing"><i class="bx bx-detail me-1"></i>Interest Dues &nbsp;<span style='color:red;'>(2)</span></a></li>

    </ul>
    <!--/ User Pills -->

    <!-- Project table -->
    <div class="card mb-4">
      <h5 class="card-header">Loan List</h5>
      <div class="table-responsive mb-3">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="d-flex justify-content-between align-items-center flex-column flex-sm-row mx-4 row">
            <div class="col-sm-4 col-12 d-flex align-items-center justify-content-sm-start justify-content-center">
              <div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select">
                    <option value="7">7</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="75">75</option>
                    <option value="100">100</option>
                  </select></label></div>
            </div>
            <div class="col-sm-8 col-12 d-flex align-items-center justify-content-sm-end justify-content-center">
              <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control" placeholder="Search Project" aria-controls="DataTables_Table_0"></label></div>
            </div>
          </div>
          <table class="table datatable-project border-top dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 863px;">
            <thead>
              <tr>
                <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=""></th>
                <th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all" rowspan="1" colspan="1" style="width: 18px;" data-col="1" aria-label=""><input type="checkbox" class="form-check-input"></th>
                <th class="sorting sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 300px;" aria-label="Project: activate to sort column ascending" aria-sort="descending">Asset Name</th>
                <th class="text-nowrap sorting_disabled" rowspan="1" colspan="1" style="width: 126px;" aria-label="Total Task">Amount</th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 117px;" aria-label="Progress: activate to sort column ascending">Days</th>
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 90px;" aria-label="Hours">Interest</th>
              </tr>
            </thead>
            <tbody>
              <tr class="odd">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
                <td class="sorting_1">
                  <div class="d-flex justify-content-left align-items-center">
                    <div class="avatar-wrapper">
                      <div class="avatar avatar-sm me-3"><img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/icons/brands/vue-label.png" alt="Project Image" class="rounded-circle"></div>
                    </div>
                    <div class="d-flex flex-column"><span class="text-truncate fw-medium">Vue Admin template</span><small class="text-muted">Vuejs Project</small></div>
                  </div>
                </td>
                <td>214/627</td>
                <td>
                  <div class="d-flex flex-column"><small class="mb-1">78%</small>
                    <div class="progress w-100 me-3" style="height: 6px;">
                      <div class="progress-bar bg-success" style="width: 78%" aria-valuenow="78%" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
                <td>88:19h</td>
              </tr>
              <tr class="even">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
                <td class="sorting_1">
                  <div class="d-flex justify-content-left align-items-center">
                    <div class="avatar-wrapper">
                      <div class="avatar avatar-sm me-3"><img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/icons/brands/event-label.png" alt="Project Image" class="rounded-circle"></div>
                    </div>
                    <div class="d-flex flex-column"><span class="text-truncate fw-medium">Online Webinar</span><small class="text-muted">Official Event</small></div>
                  </div>
                </td>
                <td>12/20</td>
                <td>
                  <div class="d-flex flex-column"><small class="mb-1">69%</small>
                    <div class="progress w-100 me-3" style="height: 6px;">
                      <div class="progress-bar bg-info" style="width: 69%" aria-valuenow="69%" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
                <td>12:12h</td>
              </tr>
              <tr class="odd">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
                <td class="sorting_1">
                  <div class="d-flex justify-content-left align-items-center">
                    <div class="avatar-wrapper">
                      <div class="avatar avatar-sm me-3"><img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/icons/brands/html-label.png" alt="Project Image" class="rounded-circle"></div>
                    </div>
                    <div class="d-flex flex-column"><span class="text-truncate fw-medium">Hoffman Website</span><small class="text-muted">HTML Project</small></div>
                  </div>
                </td>
                <td>56/183</td>
                <td>
                  <div class="d-flex flex-column"><small class="mb-1">43%</small>
                    <div class="progress w-100 me-3" style="height: 6px;">
                      <div class="progress-bar bg-warning" style="width: 43%" aria-valuenow="43%" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
                <td>76h</td>
              </tr>
              <tr class="even">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
                <td class="sorting_1">
                  <div class="d-flex justify-content-left align-items-center">
                    <div class="avatar-wrapper">
                      <div class="avatar avatar-sm me-3"><img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/icons/brands/sketch-label.png" alt="Project Image" class="rounded-circle"></div>
                    </div>
                    <div class="d-flex flex-column"><span class="text-truncate fw-medium">Foodista mobile app</span><small class="text-muted">iPhone Project</small></div>
                  </div>
                </td>
                <td>12/86</td>
                <td>
                  <div class="d-flex flex-column"><small class="mb-1">49%</small>
                    <div class="progress w-100 me-3" style="height: 6px;">
                      <div class="progress-bar bg-warning" style="width: 49%" aria-valuenow="49%" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
                <td>45h</td>
              </tr>
              <tr class="odd">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
                <td class="sorting_1">
                  <div class="d-flex justify-content-left align-items-center">
                    <div class="avatar-wrapper">
                      <div class="avatar avatar-sm me-3"><img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/icons/brands/xd-label.png" alt="Project Image" class="rounded-circle"></div>
                    </div>
                    <div class="d-flex flex-column"><span class="text-truncate fw-medium">Falcon Logo Design</span><small class="text-muted">UI/UX Project</small></div>
                  </div>
                </td>
                <td>9/50</td>
                <td>
                  <div class="d-flex flex-column"><small class="mb-1">15%</small>
                    <div class="progress w-100 me-3" style="height: 6px;">
                      <div class="progress-bar bg-danger" style="width: 15%" aria-valuenow="15%" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
                <td>89h</td>
              </tr>
              <tr class="even">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
                <td class="sorting_1">
                  <div class="d-flex justify-content-left align-items-center">
                    <div class="avatar-wrapper">
                      <div class="avatar avatar-sm me-3"><img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/icons/brands/react-label.png" alt="Project Image" class="rounded-circle"></div>
                    </div>
                    <div class="d-flex flex-column"><span class="text-truncate fw-medium">Dojo React Project</span><small class="text-muted">React Project</small></div>
                  </div>
                </td>
                <td>234/378</td>
                <td>
                  <div class="d-flex flex-column"><small class="mb-1">73%</small>
                    <div class="progress w-100 me-3" style="height: 6px;">
                      <div class="progress-bar bg-info" style="width: 73%" aria-valuenow="73%" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
                <td>67:10h</td>
              </tr>
              <tr class="odd">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
                <td class="sorting_1">
                  <div class="d-flex justify-content-left align-items-center">
                    <div class="avatar-wrapper">
                      <div class="avatar avatar-sm me-3"><img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/icons/brands/vue-label.png" alt="Project Image" class="rounded-circle"></div>
                    </div>
                    <div class="d-flex flex-column"><span class="text-truncate fw-medium">Dashboard Design</span><small class="text-muted">Vuejs Project</small></div>
                  </div>
                </td>
                <td>100/190</td>
                <td>
                  <div class="d-flex flex-column"><small class="mb-1">90%</small>
                    <div class="progress w-100 me-3" style="height: 6px;">
                      <div class="progress-bar bg-success" style="width: 90%" aria-valuenow="90%" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
                <td>129:45h</td>
              </tr>
            </tbody>
          </table>
          <div class="d-flex justify-content-between mx-4 row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 7 of 11 entries</div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                <ul class="pagination">
                  <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="0" class="page-link">Previous</a></li>
                  <li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                  <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a></li>
                  <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="next" tabindex="0" class="page-link">Next</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Project table -->



    <!-- Invoice table -->
    <div class="card mb-4">
      <div class="table-responsive mb-3">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
          <div class="row mx-4">
            <div class="col-sm-6 col-12 d-flex align-items-center justify-content-center justify-content-sm-start mb-3 mb-md-0">
              <div class="dataTables_length" id="DataTables_Table_1_length"><label><select name="DataTables_Table_1_length" aria-controls="DataTables_Table_1" class="form-select">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select></label></div>
            </div>
            <div class="col-sm-6 col-12 d-flex align-items-center justify-content-center justify-content-sm-end">
              <div class="dt-buttons"><button class="dt-button buttons-collection dropdown-toggle btn btn-label-secondary float-sm-end mb-3 mb-sm-0" tabindex="0" aria-controls="DataTables_Table_1" type="button" aria-haspopup="dialog" aria-expanded="false"><span><i class="bx bx-upload me-2"></i>Export</span><span class="dt-down-arrow">▼</span></button> </div>
            </div>
          </div>
          <table class="table datatable-invoice border-top dataTable no-footer dtr-column" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info" style="width: 863px;">
            <thead>
              <tr>
                <th class="control sorting dtr-hidden" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=": activate to sort column ascending"></th>
                <th class="sorting sorting_desc" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 104px;" aria-label="ID: activate to sort column ascending" aria-sort="descending">ID</th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 75px;" aria-label=": activate to sort column ascending"><i class="bx bx-trending-up"></i></th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 108px;" aria-label="Total: activate to sort column ascending">Total</th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 186px;" aria-label="Issued Date: activate to sort column ascending">Issued Date</th>
                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 166px;" aria-label="Actions">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr class="odd">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="sorting_1"><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview"><span class="fw-medium">#5089</span></a></td>
                <td><span data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Sent<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 05/09/2020</span>" data-bs-original-title="<span>Sent<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 05/09/2020</span>"><span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 "><i class="bx bx-mail-send bx-xs"></i></span></span></td>
                <td>$3077</td>
                <td>05/02/2020</td>
                <td>
                  <div class="d-flex align-items-center"><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Send Mail" data-bs-original-title="Send Mail"><i class="bx bx-paper-plane mx-1"></i></a><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview" class="text-body" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show-alt mx-1"></i></a><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Download" data-bs-original-title="Download"><i class="bx bx-download mx-1"></i></a></div>
                </td>
              </tr>
              <tr class="even">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="sorting_1"><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview"><span class="fw-medium">#5041</span></a></td>
                <td><span data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Sent<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 11/19/2020</span>" data-bs-original-title="<span>Sent<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 11/19/2020</span>"><span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 "><i class="bx bx-mail-send bx-xs"></i></span></span></td>
                <td>$2230</td>
                <td>02/01/2021</td>
                <td>
                  <div class="d-flex align-items-center"><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Send Mail" data-bs-original-title="Send Mail"><i class="bx bx-paper-plane mx-1"></i></a><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview" class="text-body" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show-alt mx-1"></i></a><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Download" data-bs-original-title="Download"><i class="bx bx-download mx-1"></i></a></div>
                </td>
              </tr>
              <tr class="odd">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="sorting_1"><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview"><span class="fw-medium">#5027</span></a></td>
                <td><span data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 09/25/2020</span>" data-bs-original-title="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 09/25/2020</span>"><span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30"><i class="bx bx-adjust bx-xs"></i></span></span></td>
                <td>$2787</td>
                <td>09/28/2020</td>
                <td>
                  <div class="d-flex align-items-center"><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Send Mail" data-bs-original-title="Send Mail"><i class="bx bx-paper-plane mx-1"></i></a><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview" class="text-body" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show-alt mx-1"></i></a><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Download" data-bs-original-title="Download"><i class="bx bx-download mx-1"></i></a></div>
                </td>
              </tr>
              <tr class="even">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="sorting_1"><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview"><span class="fw-medium">#5024</span></a></td>
                <td><span data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> -$202<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 08/02/2020</span>" data-bs-original-title="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> -$202<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 08/02/2020</span>"><span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30"><i class="bx bx-adjust bx-xs"></i></span></span></td>
                <td>$5285</td>
                <td>06/30/2020</td>
                <td>
                  <div class="d-flex align-items-center"><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Send Mail" data-bs-original-title="Send Mail"><i class="bx bx-paper-plane mx-1"></i></a><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview" class="text-body" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show-alt mx-1"></i></a><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Download" data-bs-original-title="Download"><i class="bx bx-download mx-1"></i></a></div>
                </td>
              </tr>
              <tr class="odd">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="sorting_1"><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview"><span class="fw-medium">#5020</span></a></td>
                <td><span data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Downloaded<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 12/15/2020</span>" data-bs-original-title="<span>Downloaded<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 12/15/2020</span>"><span class="badge badge-center rounded-pill bg-label-info w-px-30 h-px-30"><i class="bx bx-down-arrow-circle bx-xs"></i></span></span></td>
                <td>$5219</td>
                <td>07/17/2020</td>
                <td>
                  <div class="d-flex align-items-center"><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Send Mail" data-bs-original-title="Send Mail"><i class="bx bx-paper-plane mx-1"></i></a><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview" class="text-body" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show-alt mx-1"></i></a><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Download" data-bs-original-title="Download"><i class="bx bx-download mx-1"></i></a></div>
                </td>
              </tr>
              <tr class="even">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="sorting_1"><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview"><span class="fw-medium">#4995</span></a></td>
                <td><span data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 06/09/2020</span>" data-bs-original-title="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 06/09/2020</span>"><span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30"><i class="bx bx-adjust bx-xs"></i></span></span></td>
                <td>$3313</td>
                <td>08/21/2020</td>
                <td>
                  <div class="d-flex align-items-center"><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Send Mail" data-bs-original-title="Send Mail"><i class="bx bx-paper-plane mx-1"></i></a><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview" class="text-body" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show-alt mx-1"></i></a><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Download" data-bs-original-title="Download"><i class="bx bx-download mx-1"></i></a></div>
                </td>
              </tr>
              <tr class="odd">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="sorting_1"><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview"><span class="fw-medium">#4993</span></a></td>
                <td><span data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 10/22/2020</span>" data-bs-original-title="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 10/22/2020</span>"><span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30"><i class="bx bx-adjust bx-xs"></i></span></span></td>
                <td>$4836</td>
                <td>07/10/2020</td>
                <td>
                  <div class="d-flex align-items-center"><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Send Mail" data-bs-original-title="Send Mail"><i class="bx bx-paper-plane mx-1"></i></a><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview" class="text-body" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show-alt mx-1"></i></a><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Download" data-bs-original-title="Download"><i class="bx bx-download mx-1"></i></a></div>
                </td>
              </tr>
              <tr class="even">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="sorting_1"><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview"><span class="fw-medium">#4989</span></a></td>
                <td><span data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Past Due<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 08/01/2020</span>" data-bs-original-title="<span>Past Due<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 08/01/2020</span>"><span class="badge badge-center rounded-pill bg-label-danger w-px-30 h-px-30"><i class="bx bx-info-circle bx-xs"></i></span></span></td>
                <td>$5293</td>
                <td>07/30/2020</td>
                <td>
                  <div class="d-flex align-items-center"><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Send Mail" data-bs-original-title="Send Mail"><i class="bx bx-paper-plane mx-1"></i></a><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview" class="text-body" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show-alt mx-1"></i></a><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Download" data-bs-original-title="Download"><i class="bx bx-download mx-1"></i></a></div>
                </td>
              </tr>
              <tr class="odd">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="sorting_1"><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview"><span class="fw-medium">#4989</span></a></td>
                <td><span data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Downloaded<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 09/23/2020</span>" data-bs-original-title="<span>Downloaded<br> <span class=&quot;fw-medium&quot;>Balance:</span> 0<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 09/23/2020</span>"><span class="badge badge-center rounded-pill bg-label-info w-px-30 h-px-30"><i class="bx bx-down-arrow-circle bx-xs"></i></span></span></td>
                <td>$3623</td>
                <td>12/01/2020</td>
                <td>
                  <div class="d-flex align-items-center"><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Send Mail" data-bs-original-title="Send Mail"><i class="bx bx-paper-plane mx-1"></i></a><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview" class="text-body" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show-alt mx-1"></i></a><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Download" data-bs-original-title="Download"><i class="bx bx-download mx-1"></i></a></div>
                </td>
              </tr>
              <tr class="even">
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="sorting_1"><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview"><span class="fw-medium">#4965</span></a></td>
                <td><span data-bs-toggle="tooltip" data-bs-html="true" aria-label="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> $666<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 03/18/2021</span>" data-bs-original-title="<span>Partial Payment<br> <span class=&quot;fw-medium&quot;>Balance:</span> $666<br> <span class=&quot;fw-medium&quot;>Due Date:</span> 03/18/2021</span>"><span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30"><i class="bx bx-adjust bx-xs"></i></span></span></td>
                <td>$3789</td>
                <td>09/27/2020</td>
                <td>
                  <div class="d-flex align-items-center"><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Send Mail" data-bs-original-title="Send Mail"><i class="bx bx-paper-plane mx-1"></i></a><a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview" class="text-body" data-bs-toggle="tooltip" aria-label="Preview" data-bs-original-title="Preview"><i class="bx bx-show-alt mx-1"></i></a><a href="javascript:;" class="text-body" data-bs-toggle="tooltip" aria-label="Download" data-bs-original-title="Download"><i class="bx bx-download mx-1"></i></a></div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="row mx-4">
            <div class="col-md-12 col-lg-6 text-center text-lg-start pb-md-2 pb-lg-0">
              <div class="dataTables_info" id="DataTables_Table_1_info" role="status" aria-live="polite">Showing 1 to 10 of 50 entries</div>
            </div>
            <div class="col-md-12 col-lg-6 d-flex justify-content-center justify-content-lg-end">
              <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_1_paginate">
                <ul class="pagination">
                  <li class="paginate_button page-item previous disabled" id="DataTables_Table_1_previous"><a aria-controls="DataTables_Table_1" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="0" class="page-link">Previous</a></li>
                  <li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_1" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                  <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_1" role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a></li>
                  <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_1" role="link" data-dt-idx="2" tabindex="0" class="page-link">3</a></li>
                  <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_1" role="link" data-dt-idx="3" tabindex="0" class="page-link">4</a></li>
                  <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_1" role="link" data-dt-idx="4" tabindex="0" class="page-link">5</a></li>
                  <li class="paginate_button page-item next" id="DataTables_Table_1_next"><a href="#" aria-controls="DataTables_Table_1" role="link" data-dt-idx="next" tabindex="0" class="page-link">Next</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Invoice table -->
  </div>
  <!--/ User Content -->
</div>
@endsection