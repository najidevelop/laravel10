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
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{url('/cpanel/users/update',[$user->id])}}" enctype="multipart/form-data" method="POST" name="store_user_form" id="store_user_form">
                @csrf
                <div class="card-body">
                   <!-- name start -->
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$user->name}}" name="name" id="name" placeholder="Name">
                    </div>
                  </div>
                    <!-- name end -->
                    
                    
                        <!-- first_name start -->
                <div class="form-group row">
                    <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$user->first_name}}" name="first_name"   id="first_name" placeholder="first_name">
                    </div>
                  </div>
                    <!-- first_name end -->

                           <!-- last_name start -->
                <div class="form-group row">
                    <label for="last_name" class="col-sm-2 col-form-label">Last name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$user->last_name}}" name="last_name" id="last_name" placeholder="last_name">
                    </div>
                  </div>
                    <!-- last_name end -->
                         <!-- Email start -->
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email"  name="email"  value="{{$user->email}}" class="form-control" id="email" placeholder="Email">
                    </div>
                  </div>
                    <!-- Email end -->
                      
                    
                           <!-- address start -->
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$user->address}}" name="address" id="address" placeholder="address">
                    </div>
                  </div>
                    <!-- first_name end -->
                           <!-- first_name start -->
                <div class="form-group row">
                    <label for="country" class="col-sm-2 col-form-label">Country</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$user->country}}" name="country" id="country" placeholder="country">
                    </div>
                  </div>
                    <!-- first_name end -->
                           <!-- city start -->
                <div class="form-group row">
                    <label for="city" class="col-sm-2 col-form-label">city</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$user->city}}" name="city" id="city" placeholder="City">
                    </div>
                  </div>
                    <!-- city end -->
                           <!-- mobile start -->
                <div class="form-group row">
                    <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control"  value="{{$user->mobile}}" name="mobile" id="mobile" placeholder="mobile">
                    </div>
                  </div>
                    <!-- mobile end -->
                           <!-- phone start -->
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{$user->phone}}" name="phone" id="phone" placeholder="Phone">
                    </div>
                  </div>
                    <!-- phone end -->
                           <!-- role start -->
                <div class="form-group row">
                  <label for="role" class="col-sm-2 col-form-label" >Select Role</label>                             
                        <div class="col-sm-10">
                        <select class="form-control"  name="role" id="role" >                       
                          <option value="admin"    @if ($user->role=='admin') selected="selected" @endif >Admin</option>
                          <option value="manager"  @if ($user->role=='manager') selected="selected" @endif >Manager</option>
                          <option value="supervisor"  @if ($user->role=='supervisor') selected="selected" @endif >Supervisor</option>
                          <option value="customer"  @if ($user->role=='customer') selected="selected" @endif >Customer</option>                          
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