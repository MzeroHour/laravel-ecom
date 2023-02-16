@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
           <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Section</h4>
                    <p class="card-description">
                      Add class <code>.table-bordered</code>
                    </p>

                    <a href="{{ url('admin/add-edit-section') }}" class="btn btn-icon-text btn-primary" style="float: right;"> <i class="ti-file btn-icon-prepend"></i>Add Section</a>

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
                              Section Id
                            </th>
                            <th>
                              Name
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
                            @foreach ($sections as $section )
                            <tr>
                                <td>
                                  {{ $section['id'] }}
                                </td>
                                <td>
                                    {{ $section['name'] }}
                                </td>


                                <td>
                                    @if ($section['status']==1)
                                    <a class="updateSectionStatus" id="section-{{ $section['id'] }}" section_id=" {{ $section['id'] }}" href="javascript:void(0)">
                                        <i style="font-size: 25px;  color: #1982c4; text-align: center; display: inline;" class="mdi mdi-bookmark-check" status="Active"></i>
                                    </a>
                                    @else
                                    <a class="updateSectionStatus" id="section-{{ $section['id'] }}" section_id=" {{ $section['id'] }}" href="javascript:void(0)">
                                        <i  style="font-size: 25px; color: #6c757d; text-align: center; display: inline;" class="mdi mdi-bookmark-outline" status="Inactive"></i>
                                    </a>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ url('admin/add-edit-section/'.$section['id']) }}">
                                        <i style="font-size: 25px; color: #1982c4; text-align: center; display: inline;"  class="mdi mdi-pencil-box "></i>
                                      </a>
                                    {{-- <a title="Section" class="confirmDelete" href="{{ url('admin/delete-section/'.$section['id']) }}">
                                        <i style="font-size: 25px; color: #ff595e; text-align: center; display: inline;"  class="mdi mdi-close-box "></i>
                                      </a> --}}
                                    <a module_id="{{$section['id']}}"  class="confirmDelete" href="javascript:void(0)">
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






