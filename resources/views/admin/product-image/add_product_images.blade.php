@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Catalogue</h3>
                            <h6 class="font-weight-normal mb-0">Product Images</h6>
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
                <div class="col-md-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Product Images</h4>
                            <p class="card-description">
                                Basic form layout
                            </p>
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

                            <form class="forms-sample"
                                action="{{ url('admin/add-product-image/' . $product['id']) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="product_name">Prodcut Name:</label>
                                    &nbsp; {{ $product['product_name'] }}
                                </div>
                                <div class="form-group">
                                    <label for="product_code">Prodcut Code:</label>
                                    &nbsp; {{ $product['product_code'] }}
                                </div>
                                <div class="form-group">
                                    <label for="product_color">Prodcut Color:</label>
                                    &nbsp; {{ $product['product_color'] }}
                                </div>
                                <div class="form-group">
                                    <label for="product_price">Prodcut Price:</label>
                                    &nbsp; {{ $product['product_price'] }}
                                </div>

                                {{-- <div class="appendProductLevel">
                                    @include('admin.prodcuts.append_product_level')
                                </div> --}}

                                <div class="form-group">

                                    @if (!empty($product['product_image']))
                                        <img style="width: 120px"
                                            src="{{ url('/admin/images/products/large/' . $product['product_image']) }}">
                                    @else
                                        <img style="width: 120px" src="{{ asset('/admin/images/products/no_image.jpg') }}">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <input type="file" name="images[]" multiple id="images">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Add Image</button>
                                <button type="button" class="btn btn-light"> <a href="{{ url()->previous() }}"
                                        style="text-decoration: none; color:black"> Cancel</a></button>
                            </form>
                            <br>
                            <hr>
                            <br>
                            <h4 class="card-title">Product Images</h4>
                            <div class="table-responsive pt-3">
                                    <table id="sections" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Product Id
                                                </th>
                                                <th>
                                                    Image
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                                <th>
                                                    Action
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product['images'] as $image)
                                                <tr>
                                                    <td>
                                                        {{ $image['id'] }}
                                                    </td>
                                                    <td>
                                                        <img style="display: block; margin: 0 auto; width: 80px; height: 80px;" src="{{ url('admin/images/products/large/'.$image['image']) }}" alt="">
                                                    </td>
                                                    <td>
                                                        @if ($image['status'] == 1)
                                                            <a class="updateProductImageStatus"
                                                                id="productImage-{{ $image['id'] }}"
                                                                image_id=" {{ $image['id'] }}"
                                                                href="javascript:void(0)">
                                                                <i style="font-size: 25px;  color: #1982c4; text-align: center; display: inline;"
                                                                    class="mdi mdi-bookmark-check" status="Active"></i>
                                                            </a>
                                                        @else
                                                            <a class="updateProductImageStatus"
                                                                id="productImage-{{ $image['id'] }}"
                                                                image_id=" {{ $image['id'] }}"
                                                                href="javascript:void(0)">
                                                                <i style="font-size: 25px; color: #6c757d; text-align: center; display: inline;"
                                                                    class="mdi mdi-bookmark-outline"
                                                                    status="Inactive"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a module_id="{{ $image['id'] }}"
                                                            class="confirmDeleteProductImage" href="javascript:void(0)">
                                                            <i style="font-size: 25px; color: #ff595e; text-align: center; display: inline;"
                                                                class="mdi mdi-close-box "></i>
                                                        </a>
                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
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
