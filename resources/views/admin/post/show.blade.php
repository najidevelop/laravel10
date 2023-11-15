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
              <li class="breadcrumb-item active">Post</li>
              <li class="breadcrumb-item active">Posts</li>
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
          <h3 class="card-title">Show Posts</h3>

          <div class="card-tools">
          <a class="btn btn-info btn-sm" href="{{ url('/cpanel/post/add') }}">
                              <i class="fas fa-plus">
                              </i>
                             New
                          </a>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
             
          </div>
        </div>
        <div class="card-body" id="post-content">
        <table id="example1" class="table table-bordered table-striped table-hover">
      
                <thead>
                <tr>
                  <th>Title</th>
                  <th>Slug</th>
                  <th>Category</th>
                  <th>Status</th>
                  <th></th>                   
                </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
            
                <tr>
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->slug }}</td>
                  <td>{{ $post->category->title }}</td>
                  <td>@if($post->status==1)Published @else Draft @endif</td>
                  <td>    <a class="btn btn-info btn-sm" href="{{url('/cpanel/post/edit',[$post->id]) }}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm"  href="{{url('/cpanel/post/delete',[$post->id]) }}">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>  </td>                
                </tr>
@endforeach
           
                </tbody>            
              </table>
               {!! $posts->links() !!}   
        </div>
     
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

@section('footerscript')
 <!-- DataTables -->
<script src="{{url('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
 
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "paging": false,
      "responsive": true,     
      "info": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
    
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#btn_search').on('click', function(e) {//edit_image
    e.preventDefault();
    if($('#text_search').val()==''){
      window.location.href = '{{url("cpanel/post/view")}}'; 
    }else{
      var txt= $('#text_search').val();
var urlget='{{url("cpanel/post/search")}}';
        $.ajax({
          //  url: "{{url('cpanel/category/updatesort/',["+parentid+"])}}",   
          url: urlget,              
          type: "Get",         
          data:"text="+ txt,          
            success: function(data){
              $('#post-content').html(data);
          
               /* if(data.length==0){
                $('#errormsg').html('No Data');
               }else{
               
                $('#title_edit').attr('value', data.title);
                
               } */
        
             // $('.alert').html(result.success);
            },
            error: function(jqXHR, textStatus, errorThrown) {
             alert(jqXHR.responseText);
              // $('#errormsg').html(jqXHR.responseText);
              $('#errormsg').html("Error");
            }        
        });
    }   

    });
  });
</script>
@endsection
