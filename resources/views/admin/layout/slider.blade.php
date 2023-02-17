<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a @if (Session::get('page')=='dashboard')
        style="background: #4B49AC !important; color: white !important;"
        @endif
        class="nav-link" href="{{ url('admin/dashboard') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      @if(Auth::guard('admin')->user()->type=='vendors')
      <li class="nav-item">
        <a
         @if (Session::get('page')=='update_vendor_personal'  || Session::get('page')=="update_vendor_business" || Session::get('page')=="update_vendor_bank")
             style="background: #4B49AC !important; color: white !important;"
         @endif
        class="nav-link" data-toggle="collapse" href="#ui-vendors" aria-expanded="false" aria-controls="ui-vendors">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Vendor Details</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-vendors">
          <ul class="nav flex-column sub-menu" style="background: white;  padding-left: 10px !important;">
            <li class="nav-item"> <a
                @if (Session::get('page')=='update_vendor_personal')
                style="background: #7DA0FA !important; color: white !important;"
                @else
                 style="background: white !important; color: #4B49AC !important;"
                 @endif
                class="nav-link" href="{{ url('admin/update-vendor-details/personal') }}">Personal Details</a></li>
            <li class="nav-item"> <a
                @if (Session::get('page')=='update_vendor_business')
                style="background: #7DA0FA !important; color: white !important;"
                @else
                 style="background: white !important; color: #4B49AC !important;"
                 @endif
                class="nav-link" href="{{ url('admin/update-vendor-details/business') }}">Business Details</a></li>
            <li class="nav-item"> <a
                @if (Session::get('page')=='update_vendor_bank')
                style="background: #7DA0FA !important; color: white !important;"
                @else
                 style="background: white !important; color: #4B49AC !important;"
                 @endif
                class="nav-link" href="{{ url('admin/update-vendor-details/bank') }}">Bank Details</a></li>
            {{-- <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li> --}}
          </ul>
        </div>
      </li>
      @else
      <li class="nav-item">
        <a
        @if (Session::get('page')=='update_admin_password'  || Session::get('page')=="update_admin_details" )
            style="background: #4B49AC !important; color: white !important;"
        @endif
         class="nav-link" data-toggle="collapse" href="#ui-setting" aria-expanded="false" aria-controls="ui-setting">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Setting</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-setting">
          <ul class="nav flex-column sub-menu" style="background: white;  padding-left: 10px !important;">
            <li class="nav-item"> <a
                @if (Session::get('page')=='update_admin_password')
                style="background: #7DA0FA !important; color: white !important;"
                @else
                 style="background: white !important; color: #4B49AC !important;"
                 @endif
                class="nav-link" href="{{ url('admin/update-admin-password') }}">Update Password</a></li>
            <li class="nav-item"> <a
                @if (Session::get('page')=='update_admin_details')
                style="background: #7DA0FA !important; color: white !important;"
                @else
                 style="background: white !important; color: #4B49AC !important;"
                 @endif
                class="nav-link" href="{{ url('admin/update-admin-details') }}">Update Details</a></li>
            {{-- <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li> --}}
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a
            @if (Session::get('page')=='sections'  || Session::get('page')=="categories" || Session::get('page')=="products")
            style="background: #4B49AC !important; color: white !important;"
        @endif
        class="nav-link" data-toggle="collapse" href="#ui-catalogue" aria-expanded="false" aria-controls="ui-catalogue">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Catalogue Manag</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-catalogue">
          <ul class="nav flex-column sub-menu" style="background: white;  padding-left: 10px !important;">
            <li class="nav-item"> <a
                @if (Session::get('page')=='sections')
                style="background: #7DA0FA !important; color: white !important;"
                @else
                 style="background: white !important; color: #4B49AC !important;"
                @endif
                class="nav-link" href="{{ url('admin/sections') }}">Sections</a></li>
            <li class="nav-item"> <a
                @if (Session::get('page')=='categories')
                style="background: #7DA0FA !important; color: white !important;"
                @else
                 style="background: white !important; color: #4B49AC !important;"
                @endif
                class="nav-link" href="{{ url('admin/categories') }}">Categories</a></li>
                <li class="nav-item"> <a
                    @if (Session::get('page')=='brands')
                    style="background: #7DA0FA !important; color: white !important;"
                    @else
                     style="background: white !important; color: #4B49AC !important;"
                    @endif
                    class="nav-link" href="{{ url('admin/brands') }}">Brands</a></li>
            <li class="nav-item"> <a
                @if (Session::get('page')=='products')
                style="background: #7DA0FA !important; color: white !important;"
                @else
                 style="background: white !important; color: #4B49AC !important;"
                @endif
                class="nav-link" href="{{ url('admin/products') }}">Products</a></li>
            {{-- <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li> --}}
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a
        @if (Session::get('page')=='view_superadmin'  || Session::get('page')=="view_subadmin" || Session::get('page')=="view_vendors" ||  Session::get('page')=="view_all")
         style="background: #4B49AC !important; color: white !important;"
        @endif
        class="nav-link" data-toggle="collapse" href="#ui-admins-management" aria-expanded="false" aria-controls="ui-admins-management">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Admin Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-admins-management">
          <ul class="nav flex-column sub-menu" style="background: white;  padding-left: 10px !important;">
            <li class="nav-item"> <a
                @if (Session::get('page')=='view_superadmin')
                style="background: #7DA0FA !important; color: white !important;"
                @else
                 style="background: white !important; color: #4B49AC !important;"
                @endif
                class="nav-link" href="{{ url('admin/admins/superadmin') }}">Admins</a></li>
            <li class="nav-item"> <a
                @if (Session::get('page')=='view_subadmin')
                style="background: #7DA0FA !important; color: white !important;"
                @else
                 style="background: white !important; color: #4B49AC !important;"
                @endif
                class="nav-link" href="{{ url('admin/admins/subadmin') }}">Subadmins</a></li>
            <li class="nav-item"> <a
                @if (Session::get('page')=='view_vendors')
                style="background: #7DA0FA !important; color: white !important;"
                @else
                 style="background: white !important; color: #4B49AC !important;"
                @endif
                class="nav-link" href="{{ url('admin/admins/vendors') }}">Vendors</a></li>
            <li class="nav-item"> <a
                @if (Session::get('page')=='view_all')
                style="background: #7DA0FA !important; color: white !important;"
                @else
                 style="background: white !important; color: #4B49AC !important;"
                @endif
                class="nav-link" href="{{ url('admin/admins/') }}">All Admin</a></li>
            {{-- <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li> --}}
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-users" aria-expanded="false" aria-controls="ui-users">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">User Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-users">
          <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ url('admin/users') }}">Users</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ url('admin/subscribers') }}">Subscribers</a></li>
            {{-- <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li> --}}
          </ul>
        </div>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <i class="icon-columns menu-icon"></i>
          <span class="menu-title">Form elements</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
          <i class="icon-bar-graph menu-icon"></i>
          <span class="menu-title">Charts</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="charts">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
          <i class="icon-grid-2 menu-icon"></i>
          <span class="menu-title">Tables</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <i class="icon-contract menu-icon"></i>
          <span class="menu-title">Icons</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="icon-head menu-icon"></i>
          <span class="menu-title">User Pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
          <i class="icon-ban menu-icon"></i>
          <span class="menu-title">Error pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="error">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/documentation/documentation.html">
          <i class="icon-paper menu-icon"></i>
          <span class="menu-title">Documentation</span>
        </a>
      </li>
    </ul>
  </nav>
