@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
           <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Categories</h4>
                    <p class="card-description">
                      Add class <code>.table-bordered</code>
                    </p>

                    <a href="{{ url('admin/add-edit-category') }}" class="btn btn-icon-text btn-primary" style="float: right;"> <i class="ti-file btn-icon-prepend"></i>Add Category</a>

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
                              Category Id
                            </th>
                            <th>
                              Category
                            </th>
                            <th>
                                Parent Category
                            </th>
                            <th>
                              Section
                            </th>
                            <th>
                                URL
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
                            @foreach ($categories as $category )

                            @if(isset($category['parent']['category_name'])&&!empty($category['parent']['category_name']))
                            @php
                                $parent_category=$category['parent']['category_name'];
                            @endphp
                            @else
                            @php
                                $parent_category="Root";
                            @endphp
                            @endif
                            <tr>
                                <td>
                                  {{ $category['id'] }}
                                </td>
                                <td>
                                    {{ $category['category_name'] }}
                                </td>
                                <td>
                                    {{ $parent_category }}
                                </td>
                                <td>
                                    {{ $category['section']['name'] }}
                                </td>
                                <td>
                                    {{ $category['url'] }}
                                </td>


                                <td>
                                    @if ($category['status']==1)
                                    <a class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id=" {{ $category['id'] }}" href="javascript:void(0)">
                                        <i style="font-size: 25px;  color: #1982c4; text-align: center; display: inline;" class="mdi mdi-bookmark-check" status="Active"></i>
                                    </a>
                                    @else
                                    <a class="updateCategoryStatus" id="category-{{ $category['id'] }}" category_id=" {{ $category['id'] }}" href="javascript:void(0)">
                                        <i  style="font-size: 25px; color: #6c757d; text-align: center; display: inline;" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                    </a>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ url('admin/add-edit-category/'.$category['id']) }}">
                                        <i style="font-size: 25px; color: #1982c4; text-align: center; display: inline;"  class="mdi mdi-pencil-box "></i>
                                      </a>
                                    {{-- <a title="Section" class="confirmDelete" href="{{ url('admin/delete-section/'.$category['id']) }}">
                                        <i style="font-size: 25px; color: #ff595e; text-align: center; display: inline;"  class="mdi mdi-close-box "></i>
                                      </a> --}}
                                    <a module_id="{{$category['id']}}"  class="confirmDeleteCategory" href="javascript:void(0)">
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






