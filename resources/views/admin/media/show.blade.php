@extends('admin.layouts.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Media</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/cpanel') }}">Home</a></li>
              <li class="breadcrumb-item active">Media</li>
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Show Media</h3>

          <div class="card-tools">
       
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default">
                         <i class="fas fa-plus">
                          </i> New
                          </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
             
          </div>

        </div>
        <div class="card-body">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                  Media
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                 
                  @foreach ($images as $imagerow)
                  <div class="col-sm-2">
                    <a  data-toggle="modal"  data-target="#modal-edit" >
                      <img  src="{{url($imagerow->url)}}" class="img-fluid mb-2 edit_image" id="{{$imagerow->id}}" onerror="this.src='{{url('defaultpic/defaultpic.jpg')}}'" alt="white sample"/>
                  </a>
                  </div> 
                  @endforeach
                
                  <div class="col-sm-2">
                    <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                      <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2" alt="black sample"/>
                    </a>
                  </div>
                
                 
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      
 
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Image</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="{{url('/cpanel/media/store')}}" enctype="multipart/form-data" method="POST" name="store_media_form" id="store_media_form">
              @csrf
            <div class="modal-body">
           
              <div class="row">
               
                <div class="col-sm-8">
                  <div class="form-group row">
                    <label for="title" class="col-sm-4 col-form-label">title</label>
                    <div class="col-sm-8">
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
                  <div class="form-group row">
                    <label for="title" class="col-sm-4 col-form-label">Caption</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control 
                      @error('caption')  is-invalid  @enderror "
                        name="caption" id="caption" placeholder="Caption" value="{{old('caption')}}"
                        @error('caption')  
                      describedby="caption-error" aria-invalid="true"  
                      @enderror                  
                      >
                      @error('caption')  
                       <span id="caption-error" class="error invalid-feedback">{{ $message }}</span>
                       @enderror                  
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="desc" class="col-sm-4 col-form-label">Desc</label>
                    <div class="col-sm-8">
                       
                      <textarea  name="desc" class="form-control" id="desc" placeholder="Place some text here"
                      style="width: 100%;  font-size: 14px; line-height: 18px; ">{{old('desc')}}</textarea>
                      @error('desc')  
                       <span id="desc-error" class="error invalid-feedback">{{ $message }}</span>
                       @enderror                  
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="photo" class="col-sm-4 col-form-label">Photo</label>
                    <div class="col-sm-8">

                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="photo" id="photo">
                      <label class="custom-file-label" for="photo">Choose file</label>
                    </div>
                   </div>

                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-4 col-form-label">url</label>
                    <div class="col-sm-8">
                      <label  class="col-sm-4 col-form-label">http</label>                
                    </div>
                  </div>
 
                </div>
                <div class="col-sm-4">
                  <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                    <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2" alt="black sample">
                  </a>
                </div>
               
              </div>
            
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
           
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      <!-- /.card-body -->
    </div>





      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Image</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="{{url('/cpanel/media/update')}}" enctype="multipart/form-data" method="POST" name="update_media_form" id="update_media_form">
              @csrf
            <div class="modal-body">
           
              <div class="row">
                <div class="col-sm-12" id="errormsg" >
                </div>
                <div class="col-sm-8">
                  <div class="form-group row">
                    <label for="title" class="col-sm-4 col-form-label">Title</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control 
                      @error('title')  is-invalid  @enderror "
                        name="title" id="title_edit" placeholder="* title" value="{{old('title')}}"
                        @error('title')  
                      describedby="title-error" aria-invalid="true"  
                      @enderror                  
                      >
                      @error('title')  
                       <span id="title-error" class="error invalid-feedback">{{ $message }}</span>
                       @enderror                  
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="title" class="col-sm-4 col-form-label">Caption</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control 
                      @error('caption')  is-invalid  @enderror "
                        name="caption" id="caption_edit" placeholder="Caption" value="{{old('caption')}}"
                        @error('caption')  
                      describedby="caption-error" aria-invalid="true"  
                      @enderror                  
                      >
                      @error('caption')  
                       <span id="caption-error" class="error invalid-feedback">{{ $message }}</span>
                       @enderror                  
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="desc" class="col-sm-4 col-form-label">Desc</label>
                    <div class="col-sm-8">
                       
                      <textarea  name="desc" class="form-control" id="desc_edit" placeholder="Place some text here"
                      style="width: 100%;  font-size: 14px; line-height: 18px; ">{{old('desc')}}</textarea>
                      @error('desc')  
                       <span id="desc-error" class="error invalid-feedback">{{ $message }}</span>
                       @enderror                  
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="photo" class="col-sm-4 col-form-label">Photo</label>
                    <div class="col-sm-8">

                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="photo" id="photo_edit">
                      <label class="custom-file-label" for="photo">Choose file</label>
                    </div>
                   </div>

                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-4 col-form-label">url</label>
                    <div class="col-sm-8">
                      <label  class="col-sm-12 col-form-label" id="url_edit"></label>                
                    </div>
                  </div>
 
                </div>
                <div class="col-sm-4">
                  <a  data-toggle="lightbox" data-title="" >
                    <img src="" id="image_edit" class="img-fluid mb-2" alt="black sample">
                  </a>
                </div>
               
              </div>
            
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
           
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      <!-- /.card-body -->
    </div>

        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection



@section('showmessagecss')

<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{url('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<!-- Toastr -->
<link rel="stylesheet" href="{{url('admin/plugins/toastr/toastr.min.css')}}"> 

<link rel="stylesheet" href="{{url('admin/plugins/ekko-lightbox/ekko-lightbox.css')}}">
<!-- Ionicons -->

@endsection

@section('showmessagescript')

<!-- SweetAlert2 -->
<script src="{{url('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{url('admin/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{url('admin/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>

<script>
  var urlval='{{route("cpanel.category.updatesort",[0]) }}';
  $(function () {
    
   //var urlval='{{route("cpanel.category.updatesort",[0]) }}';
    $('.edit_image').on('click', function(e) {//edit_image
      $('#title_edit').attr('value', '');
                $('#caption_edit').attr('value', '');
                $('#desc_edit').text('');
                $('#url_edit').text('');
                $('#image_edit').attr('src', '');
var id= $(this).attr('id');
 
 
var urlget='{{url("cpanel/media/edit/itemid")}}';
urlget=urlget.replace("itemid",id);
 //alert(urlget);
  
        $.ajax({
          //  url: "{{url('cpanel/category/updatesort/',["+parentid+"])}}",   
          url: urlget,              
          type: "GET",         
          contentType: 'application/json',
            success: function(data){
              $('#errormsg').html('');
          
               if(data.length==0){
                $('#errormsg').html('No Data');
               }else{
               
                $('#title_edit').attr('value', data.title);
                $('#caption_edit').attr('value', data.caption);
                $('#desc_edit').text(data.desc);
                $('#url_edit').text(data.url);
                $('#image_edit').attr('src', data.url);
               }
        
             // $('.alert').html(result.success);
            },
            error: function(jqXHR, textStatus, errorThrown) {
             alert(jqXHR.responseText);
              // $('#errormsg').html(jqXHR.responseText);
              $('#errormsg').html("Error");
            }
        
        });
       
 

 
    });
 
     


 
});
</script>
@endsection


