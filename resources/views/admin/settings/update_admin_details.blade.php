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

            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Admin Details</h4>
                            <p class="card-description">
                                Basic form layout
                            </p>
                            <form class="forms-sample" action="{{ url('admin/update-admin-details') }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="exampleInputUsername1">Admin Name/Email</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->email}}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Admin Type</label>
                                    <input class="form-control" value="{{ Auth::guard('admin')->user()->type }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="Enter Your Name" name="name" value="{{ Auth::guard('admin')->user()->name }}" >
                                </div>
                                <div class="form-group">
                                    <label for="admin_mobile">Mobile</label>
                                    <input type="phone" class="form-control" id="admin_mobile"
                                        placeholder="Enter Digit Mobile Number" name="admin_mobile" value="{{ Auth::guard('admin')->user()->mobile }}" minlength="7" maxlength="12" >
                                </div>
                                <div class="form-group">
                                    <label for="admin_image">Admin Photo</label>
                                    <input type="file" class="form-control" id="admin_image" name="admin_image">
                                    @if (!empty(Auth::guard('admin')->user()->image))
                                        <a target="_blank" href="{{ url('admin/images/photos/'.Auth::guard('admin')->user()->image) }}">Image View</a>
                                        <input type="hidden" name="current_image" value="{{ Auth::guard('admin')->user()->image }}">
                                    @endif
                                </div>
                                <div class="form-check form-check-flat form-check-primary">
                                    {{-- <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Remember me
                  </label> --}}
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button class="btn btn-light"><a href="{{ url()->previous() }}"  style="text-decoration: none; color:black"> Cancel</a></button>
                            </form>
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
