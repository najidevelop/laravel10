@extends('admin.layouts.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Languages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/cpanel') }}">Home</a></li>
              <li class="breadcrumb-item active">Languages</li>
              <li class="breadcrumb-item active">Language</li>
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
          <h3 class="card-title">Show Languages</h3>

          <div class="card-tools">
          <a class="btn btn-info btn-sm" href="{{ url('/cpanel/language/add') }}">
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
                  <th>Code</th>
                  <th>Language</th>                 
                  <th>Status</th>
                  <th></th>                   
                </tr>
                </thead>
                <tbody>
                @foreach ($languages as $language)
            
                <tr>
                  <td>{{ $language->code }}</td>
                  <td>{{ $language->name }}</td>
               
                  <td>@if($language->status==1)Published @else Draft @endif</td>
                  <td>    <a class="btn btn-info btn-sm" href="{{url('/cpanel/language/edit',[$language->id]) }}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm"  href="{{url('/cpanel/language/delete',[$language->id]) }}">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>  </td>                
                </tr>
@endforeach
           
                </tbody>            
              </table>
               
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
      window.location.href = '{{url("cpanel/language/view")}}'; 
    }else{
      var txt= $('#text_search').val();
var urlget='{{url("cpanel/language/search")}}';
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
