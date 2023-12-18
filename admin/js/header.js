var langcode="en";
$(function () {
 

            $('.langrow').click(function(e){

              // e.preventDefault();
              
              langcode = $(this).attr('id');
              var langName=$(this).html();

              $('.langrow').removeClass( "active" );
        
              $(this).addClass( "active" );

              $("#selected-lang").html(langName);
                });

       
});