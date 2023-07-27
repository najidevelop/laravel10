$(function () {
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
/*
    $('.dd').on('change', function () {
        var $this = $(this);
        var serializedData = window.JSON.stringify($($this).nestable('serialize'));

        $this.parents('div.body').find('textarea').val(serializedData);
    });
    */
    $('#btn_savecatsort').on('click', function () {
  
      

    });
    $('#btn_savecatsort').click(function(e){
    
       var  parentid = $('#parent_id').find('option:selected').val();
        e.preventDefault();
        var serializedData = window.JSON.stringify($('.dd').nestable('serialize'));
     //   alert(serializedData);
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
    //  var urlval='<?php echo route("contacts.show",":contactid:"); ?>';
        
        $.ajax({
          //  url: "{{url('cpanel/category/updatesort/',["+parentid+"])}}",   
          url: urlval,//from sort page              
          type: "POST",
          data: serializedData,
          contentType: 'application/json',
            success: function(result){
             // $('.alert').show();
           //   alert(result.message);
           toastr.success(result); 
          // alert(result);
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