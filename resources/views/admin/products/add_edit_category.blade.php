@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Catalogue</h3>
                            <h6 class="font-weight-normal mb-0">Update Category Details</h6>
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
                            @if (empty($category['id']))
                            action="{{ url('admin/add-edit-category') }}"
                            @else
                            action="{{ url('admin/add-edit-category/'.$category['id']) }}"
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
                                    <label for="category_name">Category Name</label>
                                    <input type="text" class="form-control" name="category_name", id="category_name" placeholder="Enter Category Name"
                                    @if (!empty($category['category_name']))
                                    value="{{ $category['category_name'] }}"
                                    @else
                                    value="{{ old('category_name') }}"
                                    @endif
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="section_id">Select Section</label>
                                    <select name="section_id" id="section_id" class="form-control"  style="color: black !important">
                                        <option value="">Select</option>
                                        @foreach ($getSection as $section )
                                            <option value="{{ $section['id'] }}"
                                            @if (!empty($category['section_id']) && $category['section_id']==$section['id'])
                                            selected=""@endif>
                                            {{ $section['name'] }}</option>

                                        @endforeach

                                    </select>
                                </div>
                                <div class="appendCategoryLevel">
                                    @include('admin.categories.append_category_level')
                                </div>

                                <div class="form-group">
                                    <label for="category_image">Category Image</label>
                                    <input type="file" class="form-control" id="category_image" name="category_image">
                                    @if (!empty($category['category_image']))
                                    <a target="_blank" href="{{ url('/admin/images/categories/'.$category['category_image']) }}">View Image</a>&nbsp;| &nbsp;
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="category_discount">Category Discount</label>
                                    <input type="text" class="form-control" name="category_discount" placeholder="Enter Category Discount"
                                        @if (!empty($category['category_discount']))
                                        value="{{ $category['category_discount'] }}"
                                        @else
                                        value="{{ old('category_discount') }}"
                                        @endif
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="category_name">Category  Description</label>
                                    <textarea type="text" class="form-control" name="description", id="description" rows="5">{{ $category['description'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category_url">Category URL</label>
                                    <input type="text" class="form-control" name="category_url" placeholder="Enter Category Url"
                                        @if (!empty($category['url']))
                                        value="{{ $category['url'] }}"
                                        @else
                                        value="{{ old('url') }}"
                                        @endif
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="meta_title">Category title</label>
                                    <input type="text" class="form-control" name="meta_title"
                                        @if (!empty($category['meta_title']))
                                        value="{{ $category['meta_title'] }}"
                                        @else
                                        value="{{ old('category_title') }}"
                                        @endif
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Category Meta description</label>
                                    <input type="text" class="form-control" name="meta_description"
                                        @if (!empty($category['meta_description']))
                                        value="{{ $category['meta_description'] }}"
                                        @else
                                        value="{{ old('category_description') }}"
                                        @endif
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords">Category Meta keywords</label>
                                    <input type="text" class="form-control" name="meta_keywords"
                                        @if (!empty($category['meta_keywords']))
                                        value="{{ $category['meta_keywords'] }}"
                                        @else
                                        value="{{ old('category_keywords') }}"
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
