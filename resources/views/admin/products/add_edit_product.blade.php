@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Catalogue</h3>
                            <h6 class="font-weight-normal mb-0">Update Prodcut Details</h6>
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
                            <h4 class="card-title">{{ $title }}</h4>
                            <p class="card-description">
                                Basic form layout
                            </p>
                            <form class="forms-sample"
                            @if (empty($product['id']))
                            action="{{ url('admin/add-edit-product') }}"
                            @else
                            action="{{ url('admin/add-edit-product/'.$product['id']) }}"
                            @endif
                            method="POST" enctype="multipart/form-data">

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
                                    <label for="category_id">Select Category</label>
                                    <select name="category_id" id="category_id" class="form-control"  style="color: black !important">
                                        <option value="">Select</option>

                                        @foreach ($categories as $section)
                                            <optgroup label="{{ $section['name'] }}"> </optgroup>
                                            @foreach ($section['categories'] as $category)
                                                <option style="font-weight: 600; color: #777;"
                                                @if(!empty($product['category_id']==$category['id']))
                                                    selected=""
                                                @endif
                                                value="{{ $category['id'] }}">&nbsp;&nbsp;&nbsp;
                                                    &nbsp;{{ $category['category_name'] }}
                                                </option>
                                                @foreach ($category['subcategories'] as $subcategory)
                                                <option
                                                @if(!empty($product['category_id']==$subcategory['id']))
                                                    selected=""
                                                @endif
                                                value="{{ $subcategory['id'] }}">&nbsp;&nbsp;&nbsp;&emsp;
                                                    --&nbsp;{{ $subcategory['category_name'] }}
                                                </option>
                                                @endforeach
                                        @endforeach
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="brand_id">Select Brand</label>
                                    <select name="brand_id" id="brand_id" class="form-control"  style="color: black !important">
                                        <option value="">Select</option>

                                        @foreach ($brands as $brand)
                                            <option
                                            @if(!empty($product['brand_id']==$brand['id']))
                                                selected=""
                                            @endif
                                            value="{{ $brand['id'] }}">{{ $brand['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="product_name">Prodcut Name</label>
                                    <input type="text" class="form-control" name="product_name", id="product_name" placeholder="Enter Product Name"
                                    @if (!empty($product['product_name']))
                                    value="{{ $product['product_name'] }}"
                                    @else
                                    value="{{ old('product_name') }}"
                                    @endif
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="product_code">Prodcut Code</label>
                                    <input type="text" class="form-control" name="product_code", id="product_code" placeholder="Enter Product Code"
                                    @if (!empty($product['product_code']))
                                    value="{{ $product['product_code'] }}"
                                    @else
                                    value="{{ old('product_code') }}"
                                    @endif
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="product_color">Prodcut Color</label>
                                    <input type="text" class="form-control" name="product_color", id="product_color" placeholder="Enter Product Color"
                                    @if (!empty($product['product_color']))
                                    value="{{ $product['product_color'] }}"
                                    @else
                                    value="{{ old('product_color') }}"
                                    @endif
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="product_price">Prodcut Price</label>
                                    <input type="text" class="form-control" name="product_price", id="product_price" placeholder="Enter Product Price"
                                    @if (!empty($product['product_price']))
                                    value="{{ $product['product_price'] }}"
                                    @else
                                    value="{{ old('product_price') }}"
                                    @endif
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="product_discount">Prodcut Discount (%)</label>
                                    <input type="text" class="form-control" name="product_discount", id="product_discount" placeholder="Enter Product Discount"
                                    @if (!empty($product['product_discount']))
                                    value="{{ $product['product_discount'] }}"
                                    @else
                                    value="{{ old('product_discount') }}"
                                    @endif
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="product_weight">Prodcut Weight</label>
                                    <input type="text" class="form-control" name="product_weight", id="product_weight" placeholder="Enter Product Weight"
                                    @if (!empty($product['product_weight']))
                                    value="{{ $product['product_weight'] }}"
                                    @else
                                    value="{{ old('product_weight') }}"
                                    @endif
                                    >
                                </div>


                                {{-- <div class="appendProductLevel">
                                    @include('admin.prodcuts.append_product_level')
                                </div> --}}

                                <div class="form-group">
                                    <label for="product_image">Product Image (Recommed Size: 1000 x 1000)</label>
                                    <input type="file" class="form-control" id="product_image" name="product_image">
                                    @if (!empty($product['product_image']))
                                    <a target="_blank" href="{{ url('/admin/images/products/large/'.$product['product_image']) }}">View Image</a>&nbsp;| &nbsp;
                                    <a href="javascript:void(0)" class="confirmProductImageDelete" module="product-image" moduleid="{{ $product['id'] }}">Delete Image</a>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="product_video">Product Video (Recommed Size: Less then 20MB)</label>
                                    <input type="file" class="form-control" id="product_video" name="product_video">
                                    @if (!empty($product['product_video']))
                                    <a target="_blank" href="{{ url('/admin/video/products/'.$product['product_video']) }}">View Video</a>&nbsp;| &nbsp;
                                    <a href="javascript:void(0)" class="confirmProductVideoDelete" module="product-video" moduleid="{{ $product['id'] }}">Delete Video</a>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="product_name">Product  Description</label>
                                    <textarea type="text" class="form-control" name="description",  rows="5">{{ $product['description'] }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="meta_title">Product Meta title</label>
                                    <input type="text" class="form-control" name="meta_title"
                                        @if (!empty($product['meta_title']))
                                        value="{{ $product['meta_title'] }}"
                                        @else
                                        value="{{ old('product_title') }}"
                                        @endif
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Product Meta description</label>
                                    <input type="text" class="form-control" name="meta_description"
                                        @if (!empty($product['meta_description']))
                                        value="{{ $product['meta_description'] }}"
                                        @else
                                        value="{{ old('product_description') }}"
                                        @endif
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords">Product Meta keywords</label>
                                    <input type="text" class="form-control" name="meta_keywords"
                                        @if (!empty($product['meta_keywords']))
                                        value="{{ $product['meta_keywords'] }}"
                                        @else
                                        value="{{ old('product_keywords') }}"
                                        @endif
                                    >
                                </div>
                                 <div class="form-group">
                                    <label for="meta_keywords">Featured Item</label>
                                    <input type="checkbox" name="is_featured", id="is_featured" value="Yes"
                                    @if(!empty($product['is_featured']) && $product['is_featured'=='Yes'])
                                    checked=""
                                    @endif
                                    >

                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="button" class="btn btn-light"> <a href="{{ url()->previous() }}"  style="text-decoration: none; color:black"> Cancel</a></button>
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
