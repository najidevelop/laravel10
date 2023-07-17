@extends('admin.layouts.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/cpanel') }}">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
              <li class="breadcrumb-item active">Add</li>
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
                <h3 class="card-title">Add Category</h3>
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
              <!-- form start -->
              <form class="form-horizontal" action="{{url('/cpanel/category/store')}}" enctype="multipart/form-data" method="POST" name="store_category_form" id="store_category_form">
                @csrf
                <div class="card-body">
                   <!-- title start -->
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control 
                      @error('title')  is-invalid  @enderror "
                        name="title" id="title" placeholder="* title" value="{{old('title')}}"
                        @error('title')  
                      describedby="title-error" aria-invalid="true"  
                      @enderror                  
                      >
                      @error('title')  
                       <span id="title-error" class="error invalid-feedback">{{ $message }}</span>
                       @enderror                  
                    </div>
                  </div>

                    <!-- name end -->
                    <div class="form-group row">
                      <label for="slug" class="col-sm-2 col-form-label">title</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control 
                        @error('title')  is-invalid  @enderror "
                          name="slug" id="slug" placeholder="* slug" value="{{old('title')}}"
                          @error('title')  
                        describedby="title-error" aria-invalid="true"  
                        @enderror                  
                        >
                        @error('slug')  
                         <span id="slug-error" class="error invalid-feedback">{{ $message }}</span>
                         @enderror                  
                      </div>
                    </div>
                               <!-- role start -->
                <div class="form-group row">
                  <label for="parent_id" class="col-sm-2 col-form-label"  @error('parent_id')  
                  describedby="parent_id-error" aria-invalid="true"  
                  @enderror >Select Parent</label>                             
                        <div class="col-sm-10">
                        <select class="form-control  @error('parent_id')  is-invalid  @enderror "  name="parent_id" id="parent_id"  
                        @error('parent_id')  
                        describedby="parent_id-error" aria-invalid="true"  
                        @enderror  >
                        <option value="0" @if(old('parent_id')==0) selected="selected" @endif >-</option>
                        @if(!empty($categories))
                        @foreach($categories as $category)
                          <option value="{{$category->last()->id}}" @if(old('parent_id')==$category->last()->id) selected="selected" @endif >
                     
                            @foreach($category as $parent)                        
                            {{ $parent->title }}
                            @if ($category->last()->id!=$parent->id)
                            >
                            @endif
                            @endforeach                     
                          </option>
                          @endforeach
                          @endif
                        </select>
                        @error('parent_id')  
                        <span id="parent_id-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror  
                      </div>
                       
                    </div>
                    <!-- role end --> 
                        <!-- desc start -->
              
                        <div class="form-group row">
                    <label for="desc" class="col-sm-2 col-form-label">Descreption</label>
                    <div class="col-sm-10">
                      <textarea class="textarea" name="desc"  id="desc" placeholder="Place some text here"
                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('desc')}}</textarea>
                    
                      @error('desc')  
                      <span id="desc-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                    <!-- desc end -->
                          </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save</button>
                  <a class="btn btn-default float-right" href="{{url('cpanel/category/view')}}">Cancel</a>
            
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
