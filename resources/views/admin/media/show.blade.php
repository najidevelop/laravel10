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
                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                      <img  src="{{url($imagerow->url)}}" class="img-fluid mb-2" onerror="this.src='{{url('defaultpic/defaultpic.jpg')}}'" alt="white sample"/>
                    </a>
                  </div> 
                  @endforeach
                
                  <div class="col-sm-2">
                    <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                      <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2" alt="black sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3" data-toggle="lightbox" data-title="sample 3 - red" data-gallery="gallery">
                      <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=3" class="img-fluid mb-2" alt="red sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=4" data-toggle="lightbox" data-title="sample 4 - red" data-gallery="gallery">
                      <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=4" class="img-fluid mb-2" alt="red sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="https://via.placeholder.com/1200/000000.png?text=5" data-toggle="lightbox" data-title="sample 5 - black" data-gallery="gallery">
                      <img src="https://via.placeholder.com/300/000000?text=5" class="img-fluid mb-2" alt="black sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=6" data-toggle="lightbox" data-title="sample 6 - white" data-gallery="gallery">
                      <img src="https://via.placeholder.com/300/FFFFFF?text=6" class="img-fluid mb-2" alt="white sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=7" data-toggle="lightbox" data-title="sample 7 - white" data-gallery="gallery">
                      <img src="https://via.placeholder.com/300/FFFFFF?text=7" class="img-fluid mb-2" alt="white sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="https://via.placeholder.com/1200/000000.png?text=8" data-toggle="lightbox" data-title="sample 8 - black" data-gallery="gallery">
                      <img src="https://via.placeholder.com/300/000000?text=8" class="img-fluid mb-2" alt="black sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=9" data-toggle="lightbox" data-title="sample 9 - red" data-gallery="gallery">
                      <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=9" class="img-fluid mb-2" alt="red sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=10" data-toggle="lightbox" data-title="sample 10 - white" data-gallery="gallery">
                      <img src="https://via.placeholder.com/300/FFFFFF?text=10" class="img-fluid mb-2" alt="white sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=11" data-toggle="lightbox" data-title="sample 11 - white" data-gallery="gallery">
                      <img src="https://via.placeholder.com/300/FFFFFF?text=11" class="img-fluid mb-2" alt="white sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="https://via.placeholder.com/1200/000000.png?text=12" data-toggle="lightbox" data-title="sample 12 - black" data-gallery="gallery">
                      <img src="https://via.placeholder.com/300/000000?text=12" class="img-fluid mb-2" alt="black sample"/>
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
@endsection


