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
                <h3 class="card-title">Add User</h3>
              </div>
              <!-- /.card-header -->
              @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong></strong>{{Session::get('success_message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endif
              @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
              <!-- form start -->
              <form class="form-horizontal" action="{{url('/cpanel/users/store')}}" enctype="multipart/form-data" method="POST" name="store_user_form" id="store_user_form">
                @csrf
                <div class="card-body">
                   <!-- name start -->
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control 
                      @error('name')  is-invalid  @enderror "
                        name="name" id="name" placeholder="* Name" value="{{old('name')}}"
                        @error('name')  
                      describedby="name-error" aria-invalid="true"  
                      @enderror                  
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
                      <input type="text" class="form-control   @error('first_name')  is-invalid  @enderror " name="first_name" id="first_name" placeholder="First Name" value="{{old('first_name')}}" 
                      @error('first_name')  
                      describedby="first_name-error" aria-invalid="true"  
                      @enderror >
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
                      <input type="text" class="form-control  @error('last_name')  is-invalid  @enderror " name="last_name" id="last_name" placeholder="Last Name" value="{{old('last_name')}}"
                      @error('last_name')  
                      describedby="last_name-error" aria-invalid="true"  
                      @enderror >
                      @error('last_name')  
                      <span id="last_name-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                    <!-- last_name end -->
                         <!-- Email start -->
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label" >Email</label>
                    <div class="col-sm-10">
                      <input  type="text" name="email" class="form-control 
                      @error('email')  is-invalid  @enderror " id="email"  placeholder="Email" value="{{old('email')}}"
                      @error('email')  
                      describedby="email-error" aria-invalid="true"  
                      @enderror  
                      >
                      @error('email')  
                       <span id="email-error" class="error invalid-feedback">{{ $message }}</span>
                       @enderror  
                    </div>
                  </div>
                    <!-- Email end -->
                        <!-- Password start -->
                  <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control  @error('password')  is-invalid  @enderror " name="password" id="password" placeholder="Password" value="{{old('password')}}"
                      @error('password')  
                      describedby="password-error" aria-invalid="true"  
                      @enderror >
                      @error('password')  
                      <span id="password-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                     <!-- Password end -->
                               <!--Confirm Password start -->
                  <div class="form-group row">
                    <label for="inputPasswordConfirm" class="col-sm-2 col-form-label" >Confirm Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control  @error('inputPasswordConfirm')  is-invalid  @enderror " id="inputPasswordConfirm" name="inputPasswordConfirm" placeholder="Confirm Password"  value="{{old('inputPasswordConfirm')}}"       
                        @error('inputPasswordConfirm')  
                      describedby="inputPasswordConfirm-error" aria-invalid="true"  
                      @enderror >
                      @error('inputPasswordConfirm')  
                      <span id="inputPasswordConfirm-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                     <!-- Confirm Password end -->
                           <!-- first_name start -->
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control 
                      @error('name')  is-invalid  @enderror " name="address" id="address" value="{{old('address')}}" placeholder="address"  @error('address') describedby="address-error" aria-invalid="true"  
                      @enderror >
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
                      <input type="text" class="form-control 
                      @error('country')  is-invalid  @enderror" name="country" id="country"  value="{{old('country')}}"  placeholder="country"
                       @error('country') describedby="country-error" aria-invalid="true"  
                      @enderror>
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
                      <input type="text" class="form-control  @error('city')  is-invalid  @enderror " name="city" id="city" placeholder="City" value="{{old('city')}}"
                       @error('city')  
                      describedby="city-error" aria-invalid="true"  
                      @enderror  >
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
                      <input type="text" class="form-control  @error('mobile')  is-invalid  @enderror " name="mobile" id="mobile" placeholder="mobile" value="{{old('mobile')}}"
                       @error('mobile')  
                      describedby="mobile-error" aria-invalid="true"  
                      @enderror  >
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
                      <input type="text" class="form-control  @error('phone')  is-invalid  @enderror " name="phone" id="phone" placeholder="Phone" value="{{old('phone')}}"      
                     @error('phone')  
                      describedby="phone-error" aria-invalid="true"  
                      @enderror >
                      @error('phone')  
                      <span id="phone-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                    <!-- phone end -->
                           <!-- role start -->
                <div class="form-group row">
                  <label for="role" class="col-sm-2 col-form-label"         @error('role')  
                  describedby="role-error" aria-invalid="true"  
                  @enderror >Select Role</label>                             
                        <div class="col-sm-10">
                        <select class="form-control  @error('role')  is-invalid  @enderror "  name="role" id="role"  
                        @error('role')  
                        describedby="role-error" aria-invalid="true"  
                        @enderror  >
                          <option value="admin" @if(old('role')=='admin') selected="selected" @endif >Admin</option>
                          <option value="manager" @if(old('role')=='manager') selected="selected" @endif  >Manager</option>
                          <option value="supervisor" @if(old('role')=='supervisor') selected="selected" @endif   >Supervisor</option>
                          <option value="customer" @if(old('role')=='customer') selected="selected" @endif   >Customer</option>                          
                        </select>
                        @error('role')  
                        <span id="role-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror  
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
                      <input type="file" class="custom-file-input  @error('first_name')  is-invalid  @enderror " name="photo" id="photo" value="{{old('photo')}}"      
                         @error('photo')  
                      describedby="photo-error" aria-invalid="true"  
                      @enderror >
                      <label class="custom-file-label" for="photo">Choose file</label>
                      @error('photo')  
                      <span id="photo-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                   </div>

                  </div>
                    <!-- first_name end -->            
                   
                 
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