// функция просмотра таска, логика в файле selectworker.php
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var task_id = $(this).attr("id");  
           $.ajax({  
                url:"selectworker.php",  
                method:"post",  
                data:{task_id:task_id},  
                success:function(data){  
                     $('#task_detail').html(data);  
                     $('#dataModal').modal("show");  
                     if ($('#maplink').attr('href') == 'https://maps.google.com?q=0,0'){
                      $('#maplink').html('');
                     }
                }  
           });  
      });  
 });  

// эвент для старта таска логика в starttask.php
 $(document).ready(function(){  
      $(document).on('click', '.starttask', function(){  
           var task_id = $(this).attr("id");  
           $.ajax({  
                url:"starttask.php",  
                method:"POST",  
                data:{task_id:task_id},  
                dataType:"json",  
                complete: function() {   
                 window.location.reload();
                } 
           });  
      }); 
    });
// эвент для финиша таска логика в finishtask.php
  $(document).ready(function(){  
      $(document).on('click', '.finishtask', function(){  
           var task_id = $(this).attr("id");  
           $.ajax({  
                url:"finishtask.php",  
                method:"POST",  
                data:{task_id:task_id},  
                dataType:"json",  
                complete: function() {   
                 window.location.reload();
                } 
           });  
      }); 
    });

