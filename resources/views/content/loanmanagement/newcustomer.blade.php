@extends('layouts/contentNavbarLayout')

@section('title', 'Input groups - Forms')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Customer /</span> New</h4>

<div class="row">
  <!-- Basic -->
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">Basic Details</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">

        <div class="input-group">
          <label class="form-label" for="basic-default-password12">Customer ID</label>
          <div class="input-group">
            <input type="text" class="form-control" id="basic-default-password12" placeholder="CF0001" aria-describedby="basic-default-password2" />

          </div>
        </div>

        <div class="input-group">
          <label class="form-label" for="basic-default-password12">Name <span style='color:red;'>*</span></label>
          <div class="input-group">
            <input type="text" class="form-control" id="basic-default-password12" placeholder="Customer Name" aria-describedby="basic-default-password2" />

          </div>
        </div>

        <div class="input-group">
          <label class="form-label" for="basic-default-password12">Father / Spouse / Guardian<span style='color:red;'>*</span></label>
          <div class="input-group">
            <input type="text" class="form-control" id="basic-default-password12" placeholder="Customer Name" aria-describedby="basic-default-password2" />

          </div>
        </div>


        <div class="input-group">
          <label class="form-label" for="basic-default-password12">Mobile / Phone <span style='color:red;'>*</span></label>
          <div class="input-group">
            <input type="text" class="form-control" id="basic-default-password12" placeholder="Mobile / Phone" aria-describedby="basic-default-password2" />

          </div>
        </div>

        <div class="input-group">
          <label class="form-label" for="basic-default-password12">Emergency Contact Number </label>
          <div class="input-group">
            <input type="text" class="form-control" id="basic-default-password12" placeholder="Mobile / Phone" aria-describedby="basic-default-password2" />

          </div>
        </div>

        <div class="input-group">
          <label class="form-label" for="basic-default-password12">City <span style='color:red;'>*</span></label>
          <div class="input-group">
            <input type="text" class="form-control" id="basic-default-password12" placeholder="Aadhar Number" aria-describedby="basic-default-password2" />

          </div>
        </div>

        <div class="input-group">
          <label class="form-label" for="basic-default-password12">Aadhaar Number <span style='color:red;'>*</span></label>
          <div class="input-group">
            <input type="text" class="form-control" id="basic-default-password12" placeholder="Aadhar Number" aria-describedby="basic-default-password2" />

          </div>
        </div>

        <div class="input-group">
          <label class="form-label" for="basic-default-password12">Land Mark </label>
          <div class="input-group">
            <input type="text" class="form-control" id="basic-default-password12" placeholder="Land Mark" aria-describedby="basic-default-password2" />

          </div>
        </div>

        <div class="input-group">
          <label class="form-label" for="basic-default-password12">Refer By </label>
          <div class="input-group">
            <input type="text" class="form-control" id="basic-default-password12" placeholder="Refer By" aria-describedby="basic-default-password2" />

          </div>
        </div>


        <div class="input-group">
          <span class="input-group-text">Address<span style='color:red;'>*</span></span>
          <textarea class="form-control" aria-label="With textarea" placeholder="Address"></textarea>
        </div>




      </div>
    </div>
  </div>

  <!-- Merged -->
  <div class="col-md-6">
    <div class="card">
      <h5 class="card-header">Identity Details</h5>
      <div class="card-body demo-vertical-spacing demo-only-element">
        <div class="input-group">
          <label class="input-group-text" for="inputGroupFile01">Aadhaar Upload</label>
          <input type="file" class="form-control" id="inputGroupFile01">
        </div>


        <div class="input-group">
          <label class="input-group-text" for="inputGroupFile01">Photo Upload</label>
          <input type="file" class="form-control" id="inputGroupFile01">
        </div>

        <div class="demo-inline-spacing">

          <button type="button" class="btn rounded-pill btn-success">Save</button>
          <button type="button" class="btn rounded-pill btn-danger">Reset</button>

        </div>

      </div>
    </div>
  </div>



</div>








@endsection