@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
           <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Products</h4>
                    <p class="card-description">
                      Add class <code>.table-bordered</code>
                    </p>

                    <a href="{{ url('admin/add-edit-product') }}" class="btn btn-icon-text btn-primary" style="float: right;"> <i class="ti-file btn-icon-prepend"></i>Add Product</a>

                    @if (Session::has('success_message'))
                    <div class="alert alert-success alert-dismissble fade show" style="width: 50%">
                        <strong> Success: </strong>{{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    @endif
                    <div class="table-responsive pt-3">
                      <table id="sections" class="table table-bordered">
                        <thead>
                          <tr>
                            <th>
                              Product Id
                            </th>
                            <th>
                              Product Name
                            </th>
                            <th>
                                Product Code
                            </th>
                            <th>
                              Product Color
                            </th>
                            <th>
                                Product Image
                            </th>
                            <th>
                              Section
                            </th>
                            <th>
                                Category Name
                              </th>
                            <th>
                              Added By
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
                            @foreach ($products as $product )
                            <tr>
                                <td>
                                  {{ $product['id'] }}
                                </td>
                                <td>
                                    {{ $product['product_name'] }}
                                </td>
                                <td>
                                    {{ $product['product_code'] }}
                                </td>
                                <td>
                                    {{ $product['product_color']}}
                                </td>
                                <td>
                                    @if (!empty($product['product_image']))
                                    <img style="display: block; margin: 0 auto; width: 80px; height: 80px;" src="{{ asset('admin/images/products/small/'.$product['product_image']) }}" alt="{{ $product['product_image'] }}">
                                    @else
                                      <img  style="display: block; margin: 0 auto; width: 80px; height: 80px;"  src="{{ asset('admin/images/products/no_image.jpg') }}" alt="{{ asset('admin/images/products/no_image.png') }}">
                                    @endif
                                </td>
                                <td>
                                    {{ $product['section']['name']}}
                                </td>
                                <td>
                                    {{ $product['category']['category_name']}}
                                </td>
                                <td>
                                    @if($product['admin_type']=='vendor')
                                        <a target="_blank" href="{{ url('admin/view-vendor-details/'.$product['admin_id']) }}">{{ ucfirst($product['admin_type'])  }}</a>
                                    @else
                                        {{ ucfirst($product['admin_type'])}}
                                    @endif
                                </td>

                                <td>
                                    @if ($product['status']==1)
                                    <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id=" {{ $product['id'] }}" href="javascript:void(0)">
                                        <i style="font-size: 25px;  color: #1982c4; text-align: center; display: inline;" class="mdi mdi-bookmark-check" status="Active"></i>
                                    </a>
                                    @else
                                    <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id=" {{ $product['id'] }}" href="javascript:void(0)">
                                        <i  style="font-size: 25px; color: #6c757d; text-align: center; display: inline;" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                    </a>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ url('admin/add-edit-product/'.$product['id']) }}">
                                        <i style="font-size: 25px; color: #1982c4; text-align: center; display: inline;"  class="mdi mdi-pencil-box "></i>
                                      </a>
                                    {{-- <a title="Section" class="confirmDelete" href="{{ url('admin/delete-section/'.$product['id']) }}">
                                        <i style="font-size: 25px; color: #ff595e; text-align: center; display: inline;"  class="mdi mdi-close-box "></i>
                                      </a> --}}
                                    <a module_id="{{$product['id']}}"  class="confirmDeleteProduct" href="javascript:void(0)">
                                        <i style="font-size: 25px; color: #ff595e; text-align: center; display: inline;"  class="mdi mdi-close-box "></i>
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






