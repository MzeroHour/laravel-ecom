@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Setting</h3>
                            <h6 class="font-weight-normal mb-0">Update Admin Details</h6>
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

            @if ($slug=='personal')

            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Personal Information</h4>
                            <p class="card-description">
                                Basic form layout
                            </p>
                            <form class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (Session::has('error_message'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> {{ Session::get('error_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                 @endif
                                 @if ($errors->any())
                                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                     <ul>
                                         @foreach ($errors->all() as $error)
                                             <li>{{ $error }}</li>
                                         @endforeach
                                     </ul>
                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 @endif
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Vendor Name/Email</label>
                                    <input type="text" name="vendor_email" class="form-control" value="{{ $vendorDetails['email']}}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="vendor_name"
                                        placeholder="Enter Your Name" name="vendor_name" value="{{ $vendorDetails['name'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text" class="form-control" id="vendor_address"
                                        name="vendor_address" value="{{ $vendorDetails['address'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="vendor_city"
                                         name="vendor_city" value="{{ $vendorDetails['city'] }}" >
                                </div>

                                <div class="form-group">
                                    <label for="name">State</label>
                                    <input type="text" class="form-control" id="vendor_state"
                                         name="vendor_state" value="{{ $vendorDetails['state'] }}" >
                                </div>
                                <div class="form-group">
                                    {{-- <label for="name">Country</label>
                                    <input type="text" class="form-control" id="vendor_counrty"
                                         name="vendor_country" value="{{ $vendorDetails['country'] }}" > --}}
                                    <select class="form-control" name="vendor_country" id="vendor_counrty" style="color: #495057 !important">
                                        <option value="">Select Country</option>
                                        @foreach ( $countries as $country)
                                        <option value="{{ $country['country_name'] }}" @if ($country['country_name']==$vendorDetails['country']) selected @endif>
                                            {{ $country['country_name']}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Pincode</label>
                                    <input type="text" class="form-control" id="vendor_pincode"
                                         name="vendor_pincode" value="{{ $vendorDetails['pincode'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="vendor_mobile">Mobile</label>
                                    <input type="phone" class="form-control" id="vendor_mobile"
                                        name="vendor_mobile" value="{{ $vendorDetails['mobile'] }}" minlength="7" maxlength="12" >
                                </div>
                                {{-- <div class="form-group">
                                    <label for="admin_mobile">Status</label>
                                    <input type="phone" class="form-control" id="status"
                                        name="status" value="{{ $vendorDetails['status'] }}">
                                </div> --}}

                                <div class="form-group">
                                    <label for="vendor_image">Admin Photo</label>
                                    <input type="file" class="form-control" id="vendor_image" name="vendor_image">
                                    @if (!empty(Auth::guard('admin')->user()->image))
                                        <a target="_blank" href="{{ url('admin/images/photos/'.Auth::guard('admin')->user()->image) }}">Image View</a>
                                        <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}">
                                    @endif
                                </div>
                                <div class="form-check form-check-flat form-check-primary">
                                    {{-- <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Remember me
                  </label> --}}
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            @elseif($slug=='business')

            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Business Information</h4>
                            <p class="card-description">
                                Basic form layout
                            </p>
                            <form class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (Session::has('error_message'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> {{ Session::get('error_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                 @endif
                                 @if ($errors->any())
                                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                     <ul>
                                         @foreach ($errors->all() as $error)
                                             <li>{{ $error }}</li>
                                         @endforeach
                                     </ul>
                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 @endif
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Shop Name</label>
                                    <input type="text" name="shop_name" class="form-control" value="{{ $vendorDetails['shop_name']}}"
                                        >
                                </div>
                                <div class="form-group">
                                    <label for="shop_address">Shop Address</label>
                                    <input type="text" class="form-control" id="shop_address"
                                        placeholder="Enter Your Name" name="shop_address" value="{{ $vendorDetails['shop_address'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="name">Shop City</label>
                                    <input type="text" class="form-control" id="shop_city"
                                        name="shop_city" value="{{ $vendorDetails['shop_city'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="city">Shop State</label>
                                    <input type="text" class="form-control" id="shop_state"
                                         name="shop_state" value="{{ $vendorDetails['shop_state'] }}" >
                                </div>

                                {{-- <div class="form-group">
                                    <label for="name">Shop Country</label>
                                    <input type="text" class="form-control" id="shop_country"
                                         name="shop_country" value="{{ $vendorDetails['shop_country'] }}" >
                                </div> --}}

                                <select class="form-control" name="shop_country" id="shop_country" style="color: #495057 !important">
                                    <option value="">Select Country</option>
                                    @foreach ( $countries as $country)
                                    <option  value="{{ $country['country_name'] }}" @if ($country['country_name']==$vendorDetails['shop_country']) selected @endif>
                                        {{ $country['country_name']}}
                                    </option>
                                    @endforeach
                                </select>

                                <div class="form-group">
                                    <label for="name">Shop Pincode</label>
                                    <input type="text" class="form-control" id="shop_pincode"
                                         name="shop_pincode" value="{{ $vendorDetails['shop_pincode'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="name">Shop Mobile</label>
                                    <input type="phone" class="form-control" id="shop_mobile"
                                         name="shop_mobile" value="{{ $vendorDetails['shop_mobile'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="vendor_mobile">Shop Email</label>
                                    <input type="text" class="form-control" id="shop_email"
                                        name="shop_email" value="{{ $vendorDetails['shop_email'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="Business_detail">Shop Website</label>
                                    <input type="text" class="form-control" id="shop_website"
                                        name="shop_website" value="{{ $vendorDetails['shop_website'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="Business_detail">Address Proof</label>
                                    <select class="form-control" name="address_proof" id="address_proof" style="color: #495057 !important">
                                        <option value="Passport"
                                        @if ($vendorDetails['address_proof']=='Passport') selected
                                        @endif>Passport</option>

                                        <option value="Voting Card"
                                        @if ($vendorDetails['address_proof']=='Voting Card') selected
                                        @endif>Voting Card</option>

                                        <option value="PAN"
                                        @if ($vendorDetails['address_proof']=='PAN') selected
                                        @endif>PAN</option>

                                        <option value="Driving Lincense"
                                        @if ($vendorDetails['address_proof']=='Driving Lincense') selected
                                        @endif>Driving Lincense</option>

                                        <option value="NRC Card"
                                        @if ($vendorDetails['address_proof']=='NRC Card') selected
                                        @endif>NRC Card</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="business_license_number">Business Lincense Number</label>
                                    <input type="text" class="form-control" id="business_license_number"
                                        name="business_license_number" value="{{ $vendorDetails['business_license_number'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="gst_number">GST Number</label>
                                    <input type="text" class="form-control" id="gst_number"
                                        name="gst_number" value="{{ $vendorDetails['gst_number'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="pan_number">Pan Number</label>
                                    <input type="text" class="form-control" id="pan_number"
                                        name="pan_number" value="{{ $vendorDetails['pan_number'] }}">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="admin_mobile">Status</label>
                                    <input type="phone" class="form-control" id="status"
                                        name="status" value="{{ $vendorDetails['status'] }}">
                                </div> --}}

                                <div class="form-group">
                                    <label for="address_proof_image">Address Proof Image</label>
                                    <input type="file" class="form-control" id="address_proof_image" name="address_proof_image">
                                    @if (!empty(Auth::guard('admin')->user()->image))
                                        <a target="_blank" href="{{ url('admin/images/proofs/'.$vendorDetails['address_proof_image']) }}">Image View</a>
                                        <input type="hidden" name="current_vendor_image" value="{{ $vendorDetails['address_proof_image'] }}">
                                    @endif
                                </div>
                                <div class="form-check form-check-flat form-check-primary">
                                    {{-- <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Remember me
                  </label> --}}
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            @elseif($slug=='bank')
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Bank Information</h4>
                            <p class="card-description">
                                Basic form layout
                            </p>
                            <form class="forms-sample" action="{{ url('admin/update-vendor-details/bank') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (Session::has('error_message'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> {{ Session::get('error_message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                 @endif
                                 @if ($errors->any())
                                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                     <ul>
                                         @foreach ($errors->all() as $error)
                                             <li>{{ $error }}</li>
                                         @endforeach
                                     </ul>
                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 @endif
                                 <div class="form-group">
                                    <label for="exampleInputUsername1">Vendor Name/Email</label>
                                    <input type="text" name="vendor_email" class="form-control" value="{{ Auth::guard('admin')->user()->email}}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Account Holder Name</label>
                                    <input type="text" class="form-control" id="account_holder_name"
                                        placeholder="Enter Your Name" name="account_holder_name" value="{{ $vendorDetails['account_holder_name'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="name">Bank Name</label>
                                    <input type="text" class="form-control" id="bank_name"
                                        name="bank_name" value="{{ $vendorDetails['bank_name'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="city">Account Number</label>
                                    <input type="text" class="form-control" id="account_number"
                                         name="account_number" value="{{ $vendorDetails['account_number'] }}" >
                                </div>

                                <div class="form-group">
                                    <label for="name">Bank ifsc Code</label>
                                    <input type="text" class="form-control" id="bank_ifsc_code"
                                         name="bank_ifsc_code" value="{{ $vendorDetails['bank_ifsc_code'] }}" >
                                </div>

                                {{-- <div class="form-group">
                                    <label for="admin_mobile">Status</label>
                                    <input type="phone" class="form-control" id="status"
                                        name="status" value="{{ $vendorDetails['status'] }}">
                                </div> --}}

                                <div class="form-check form-check-flat form-check-primary">
                                    {{-- <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Remember me
                  </label> --}}
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            @endif
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin.layout.footer')
        <!-- partial -->
    </div>
@endsection
