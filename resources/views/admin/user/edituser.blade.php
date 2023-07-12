@extends('admin.layouts.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/cpanel') }}">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
       <!-- Horizontal Form -->
      <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Edit User</h3>
              </div>
           
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                  
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{url('/cpanel/users/update',[$user->id])}}" enctype="multipart/form-data" method="POST" name="store_user_form" id="store_user_form">
                @csrf
                <div class="card-body">
                   <!-- name start -->
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control  
                      @error('name')  is-invalid  @enderror "
                     
                      @error('name')  
                      describedby="name-error" aria-invalid="true"  
                      @enderror 
                      @if ($errors->any())
                      value="{{old('name')}}" @else value="{{$user->name}}"
                      @endif
                       name="name" id="name" placeholder="Name"                    
                      >
                      @error('name')  
                      <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                    <!-- name end -->
                    
                    
                        <!-- first_name start -->
                <div class="form-group row">
                    <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control @error('first_name')  is-invalid  @enderror "
                     
                      @error('first_name')  
                      describedby="first_name-error" aria-invalid="true"  
                      @enderror 
                      @if ($errors->any())
                      value="{{old('first_name')}}" @else value="{{$user->first_name}}"
                      @endif  
                       name="first_name"   id="first_name" placeholder="first_name">
                      @error('first_name')  
                      <span id="first_name-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                    <!-- first_name end -->

                           <!-- last_name start -->
                <div class="form-group row">
                    <label for="last_name" class="col-sm-2 col-form-label">Last name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control @error('last_name')  is-invalid  @enderror "
                     
                      @error('last_name')  
                      describedby="last_name-error" aria-invalid="true"  
                      @enderror 
                      @if ($errors->any())
                      value="{{old('last_name')}}" @else value="{{$user->last_name}}"
                      @endif 
                        name="last_name" id="last_name" placeholder="last_name">
                      @error('last_name')  
                      <span id="last_name-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                    <!-- last_name end -->
                         <!-- Email start -->
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email"  name="email"    class="form-control @error('email')  is-invalid  @enderror "
                     
                      @error('email')  
                      describedby="email-error" aria-invalid="true"  
                      @enderror 
                      @if ($errors->any())
                      value="{{old('email')}}" @else value="{{$user->email}}"
                      @endif 
                       id="email" placeholder="Email">
                      @error('email')  
                      <span id="email-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                    <!-- Email end -->
                      
                    
                           <!-- address start -->
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control @error('address')  is-invalid  @enderror "
                     
                      @error('address')  
                      describedby="address-error" aria-invalid="true"  
                      @enderror 
                      @if ($errors->any())
                      value="{{old('address')}}" @else value="{{$user->address}}"
                      @endif 
                        name="address" id="address" placeholder="address">
                      @error('address')  
                      <span id="address-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                    <!-- first_name end -->
                           <!-- first_name start -->
                <div class="form-group row">
                    <label for="country" class="col-sm-2 col-form-label">Country</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control @error('country')  is-invalid  @enderror "
                     
                      @error('country')  
                      describedby="country-error" aria-invalid="true"  
                      @enderror 
                      @if ($errors->any())
                      value="{{old('country')}}" @else value="{{$user->country}}"
                      @endif 
                        name="country" id="country" placeholder="country">
                      @error('country')  
                      <span id="country-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                    <!-- first_name end -->
                           <!-- city start -->
                <div class="form-group row">
                    <label for="city" class="col-sm-2 col-form-label">city</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control @error('city')  is-invalid  @enderror "
                     
                      @error('city')  
                      describedby="city-error" aria-invalid="true"  
                      @enderror 
                      @if ($errors->any())
                      value="{{old('city')}}" @else value="{{$user->city}}"
                      @endif    name="city" id="city" placeholder="City">
                      @error('city')  
                      <span id="city-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                    <!-- city end -->
                           <!-- mobile start -->
                <div class="form-group row">
                    <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control   @error('mobile')  is-invalid  @enderror "
                     
                      @error('mobile')  
                      describedby="mobile-error" aria-invalid="true"  
                      @enderror 
                      @if ($errors->any())
                      value="{{old('mobile')}}" @else value="{{$user->mobile}}"
                      @endif 
                       name="mobile" id="mobile" placeholder="mobile">
                      @error('mobile')  
                      <span id="mobile-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                    <!-- mobile end -->
                           <!-- phone start -->
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control  @error('phone')  is-invalid  @enderror "
                     
                      @error('phone')  
                      describedby="phone-error" aria-invalid="true"  
                      @enderror 
                      @if ($errors->any()) 
                      value="{{old('phone')}}" @else value="{{$user->phone}}"
                      @endif    name="phone" id="phone" placeholder="Phone">
                      @error('phone')  
                      <span id="phone-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                    <!-- phone end -->
                           <!-- role start -->
                <div class="form-group row">
                  <label for="role" class="col-sm-2 col-form-label  @error('role')  is-invalid  @enderror "            
                  @error('role')  
                  describedby="role-error" aria-invalid="true"  
                  @enderror 
                     >Select Role</label>                             
                        <div class="col-sm-10">
                       
                        <select class="form-control"  name="role" id="role" >                       
                          <option value="admin" @if (( old('role')=='admin'))selected="selected"
                          @elseif ($user->role=='admin'&& !$errors->any()) selected="selected" @endif>Admin</option>
                          <option value="manager"  @if (($errors->any() && old('role')=='manager'))  selected="selected"
                            @elseif ($user->role=='manager'&& !$errors->any()) selected="selected" @endif >Manager</option>
                          <option value="supervisor"   @if (($errors->any() && old('role')=='supervisor'))  selected="selected"
                            @elseif ($user->role=='supervisor'&& !$errors->any()) selected="selected" @endif>Supervisor</option>
                          <option value="customer"   @if (($errors->any() && old('role')=='customer'))  selected="selected"
                            @elseif ($user->role=='customer' && !$errors->any()) selected="selected" @endif>Customer</option>                          
                        </select>
                      </div>
 
                    </div>
                    <!-- role end -->
                           <!-- first_name start -->
                           <div class="form-group">
                    <!-- <label for="customFile">Custom File</label> -->
                    <div class="form-group row">
                    <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                    <div class="col-sm-10">

                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="photo" id="photo">
                      <label class="custom-file-label" for="photo">Choose file</label>
                    </div>
                   </div>

                  </div>
                    <!-- first_name end -->
                    <div class="row">
                    <div class="col-sm-2"  >
                    </div>        
                  <div class="col-sm-2"  >
                    <img src="{{url('admin/images/users',[$user->photo])}}" class="img-fluid mb-2"  >
                  </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save</button>
                  <a class="btn btn-default float-right" href="{{url('cpanel/users/view')}}">Cancel</a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


      <!-- /.card -->

 @endsection
 @section('showmessagecss')
 <!-- SweetAlert2 -->
 <link rel="stylesheet" href="{{url('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
 <!-- Toastr -->
 <link rel="stylesheet" href="{{url('admin/plugins/toastr/toastr.min.css')}}"> 
@endsection
@section('showmessagescript')
<!-- SweetAlert2 -->
<script src="{{url('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{url('admin/plugins/toastr/toastr.min.js')}}"></script>
<script type="text/javascript">
$(function() {
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
  @if(Session::has('success_message'))
  toastr.success("{{Session::get('success_message')}}");  
  @endif
});
</script>
@endsection
