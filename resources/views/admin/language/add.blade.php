@extends('admin.layouts.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Posts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/cpanel') }}">Home</a></li>
              <li class="breadcrumb-item active">Language</li>
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
                <h3 class="card-title">Add Language</h3>
              </div>
            
              <!-- form start -->
              <form class="form-horizontal" action="{{url('/cpanel/language/store')}}" enctype="multipart/form-data" method="POST" name="store_language_form" id="store_language_form">
                @csrf
                <div class="card-body">
                   <!-- title start -->
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Code</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control 
                      @error('code')  is-invalid  @enderror "
                        name="code" id="code" placeholder="* code" value="{{old('code')}}"
                        @error('code')  
                      describedby="code-error" aria-invalid="true"  
                      @enderror                  
                      >
                      @error('code')  
                       <span id="code-error" class="error invalid-feedback">{{ $message }}</span>
                       @enderror                  
                    </div>
                  </div>

                    <!-- name end -->
                    <div class="form-group row">
                      <label for="name" class="col-sm-2 col-form-label">Language</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control 
                        @error('name')  is-invalid  @enderror "
                          name="name" id="name" placeholder="Language" value="{{old('name')}}"
                          @error('slug')  
                        describedby="name-error" aria-invalid="true"  
                        @enderror                  
                        >
                        @error('name')  
                         <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                         @enderror                  
                      </div>
                    </div>
                               
               
           
                    
                        <!-- notes start -->
              
                        <div class="form-group row">
                    <label for="notes" class="col-sm-2 col-form-label">Notes</label>
                    <div class="col-sm-10">
                      <textarea class="textarea" name="notes"  id="notes" placeholder="Place some text here"
                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('notes')}}</textarea>
                    
                      @error('notes')  
                      <span id="notes-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                <!-- name end -->
                <div class="form-group row">
                  <label for="image" class="col-sm-2 col-form-label">Image URL</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control 
                    @error('image')  is-invalid  @enderror "
                      name="image" id="image" placeholder="Language" value="{{old('image')}}"
                      @error('slug')  
                    describedby="image-error" aria-invalid="true"  
                    @enderror                  
                    >
                    @error('image')  
                     <span id="image-error" class="error invalid-feedback">{{ $message }}</span>
                     @enderror                  
                  </div>
                </div>

                 <!-- name end -->
                 <div class="form-group row">
                  <label for="htmlcode" class="col-sm-2 col-form-label">Html Icon</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control 
                    @error('htmlcode')  is-invalid  @enderror "
                      name="htmlcode" id="htmlcode" placeholder="Language" value="{{old('htmlcode')}}"
                      @error('htmlcode')  
                    describedby="htmlcode-error" aria-invalid="true"  
                    @enderror                  
                    >
                    @error('htmlcode')  
                     <span id="htmlcode-error" class="error invalid-feedback">{{ $message }}</span>
                     @enderror                  
                  </div>
                </div>
                    <!-- desc end -->
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label"  >Status</label>
                      <div class="custom-control custom-switch col-sm-10" >                    
                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" checked="checked">  
                        <label class="custom-control-label" for="status" id="status_lbl">Published</label> 
                      </div>
                    </div>
                          </div>               
                          <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save</button>
                  <a class="btn btn-default float-right" href="{{url('cpanel/language/view')}}">Cancel</a>
            
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
    $("input[name=status]").click(function() {
      //  var checkBoxes = $(this).val();
      var checkBoxes = $(this).prop("checked");
if(checkBoxes==true){
  $("#status_lbl").text("Published");
  $("#status").prop("value",1);
}else{
  $("#status_lbl").text("Draft");
  $("#status").prop("value",0);
}
      //  alert( $("#status").prop("value"));
     //   checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    });   
    $('.textarea').summernote();
  });
</script>
@endsection
