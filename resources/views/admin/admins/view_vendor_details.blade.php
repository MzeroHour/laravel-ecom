@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Vendor Details</h3>
                            <h6 class="font-weight-normal mb-0"> <a href="{{ url('admin/admins/vendor') }}"> Back to Vendor </a></h6>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                        id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                        <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <a class="dropdown-item" href="#">January - March</a>
                                        <a class="dropdown-item" href="#">March - June</a>
                                        <a class="dropdown-item" href="#">June - August</a>
                                        <a class="dropdown-item" href="#">August - November</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                {{-- vendor details --}}
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Personal Information</h4>
                            <p class="card-description">
                                Basic form layout
                            </p>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Vendor Email</label>
                                    <input type="text" name="vendor_email" class="form-control" value="{{ $vendorDetails['vendor_personal']['email']}}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="vendor_name"
                                        placeholder="Enter Your Name" name="vendor_name" value="{{ $vendorDetails['vendor_personal']['name'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text" class="form-control" id="vendor_address"
                                        name="vendor_address" value="{{ $vendorDetails['vendor_personal']['address'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="account_number"
                                         name="account_number" value="{{ $vendorDetails['vendor_personal']['city'] }}" >
                                </div>

                                <div class="form-group">
                                    <label for="name">State</label>
                                    <input type="text" class="form-control" id="bank_ifsc_code"
                                         name="bank_ifsc_code" value="{{ $vendorDetails['vendor_personal']['state'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="name">Country</label>
                                    <input type="text" class="form-control" id="vendor_counrty"
                                         name="vendor_country" value="{{ $vendorDetails['vendor_personal']['country'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="name">Pincode</label>
                                    <input type="text" class="form-control" id="vendor_pincode"
                                         name="vendor_pincode" value="{{ $vendorDetails['vendor_personal']['pincode'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="vendor_mobile">Mobile</label>
                                    <input type="phone" class="form-control" id="vendor_mobile"
                                        name="vendor_mobile" value="{{ $vendorDetails['vendor_personal']['mobile'] }}" minlength="7" maxlength="12" >
                                </div>
                                {{-- <div class="form-group">
                                    <label for="admin_mobile">Status</label>
                                    <input type="phone" class="form-control" id="status"
                                        name="status" value="{{ $vendorDetails['status'] }}">
                                </div> --}}

                                <div class="form-group">
                                    <label for="vendor_image">Admin Photo</label><br>
                                    @if (!empty($vendorDetails['image']))
                                        <img width="200px" src="{{ url('admin/images/photos/'.$vendorDetails['image']) }}"></img>

                                    @endif
                                </div>



                        </div>
                    </div>
                </div>

                {{-- vendor business --}}
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Business Information</h4>
                            <p class="card-description">
                                Basic form layout
                            </p>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Shop Name</label>
                                    <input type="text" name="shop_name" class="form-control" value="{{ $vendorDetails['vendor_business']['shop_name']}}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Shop Address</label>
                                    <input type="text" class="form-control" id="vendor_name"
                                        placeholder="Enter Your Name" name="vendor_name" value="{{ $vendorDetails['vendor_business']['shop_address'] }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Shop City</label>
                                    <input type="text" class="form-control" id="vendor_address"
                                        name="vendor_address" value="{{ $vendorDetails['vendor_business']['shop_city'] }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="city">Shop State</label>
                                    <input type="text" class="form-control" id="account_number"
                                         name="account_number" value="{{ $vendorDetails['vendor_business']['shop_state'] }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="name">Shop Country</label>
                                    <input type="text" class="form-control" id="bank_ifsc_code"
                                         name="bank_ifsc_code" value="{{ $vendorDetails['vendor_business']['shop_country'] }}" readonly >
                                </div>
                                <div class="form-group">
                                    <label for="name">Shop Pincode</label>
                                    <input type="text" class="form-control" id="vendor_counrty"
                                         name="vendor_country" value="{{ $vendorDetails['vendor_business']['shop_pincode'] }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Shop Mobile</label>
                                    <input type="text" class="form-control" id="vendor_pincode"
                                         name="vendor_pincode" value="{{ $vendorDetails['vendor_business']['shop_mobile'] }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="vendor_mobile">Shop Website</label>
                                    <input type="phone" class="form-control" id="vendor_mobile"
                                        name="vendor_mobile" value="{{ $vendorDetails['vendor_business']['shop_website'] }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="vendor_mobile">Address Proof</label>
                                    <input type="phone" class="form-control" id="vendor_mobile"
                                        name="vendor_mobile" value="{{ $vendorDetails['vendor_business']['address_proof'] }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="vendor_mobile">License Number</label>
                                    <input type="phone" class="form-control" id="vendor_mobile"
                                        name="vendor_mobile" value="{{ $vendorDetails['vendor_business']['business_license_number'] }}" readonly>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="admin_mobile">Status</label>
                                    <input type="phone" class="form-control" id="status"
                                        name="status" value="{{ $vendorDetails['status'] }}">
                                </div> --}}

                                <div class="form-group">
                                    <label for="vendor_image">Admin Photo</label><br>
                                    @if (!empty($vendorDetails['vendor_business']['address_proof_image']))
                                        <img width="200px" width="200px" src="{{ url('admin/images/proofs/'.$vendorDetails['vendor_business']['address_proof_image']) }}"></img>

                                    @endif
                                </div>



                        </div>
                    </div>
                </div>

                 {{-- vendor Bank --}}
                 <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Bank Information</h4>
                            <p class="card-description">
                                Basic form layout
                            </p>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Account Name</label>
                                    <input type="text" name="shop_name" class="form-control" value="{{ $vendorDetails['vendor_bank']['account_holder_name']}}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Bank Name</label>
                                    <input type="text" class="form-control" id="vendor_name"
                                        placeholder="Enter Your Name" name="vendor_name" value="{{ $vendorDetails['vendor_bank']['bank_name'] }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Account Number</label>
                                    <input type="text" class="form-control" id="vendor_address"
                                        name="vendor_address" value="{{ $vendorDetails['vendor_bank']['account_number'] }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="city">Bank IFSC Code</label>
                                    <input type="text" class="form-control" id="account_number"
                                         name="account_number" value="{{ $vendorDetails['vendor_bank']['bank_ifsc_code'] }}" readonly>
                                </div>
                        </div>
                    </div>
                </div>

            </div>





        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin.layout.footer')
        <!-- partial -->
    </div>
@endsection
