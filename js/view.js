// функция, которая отвечает за изменение таска, вся логика находится в файле fetch.php
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var task_id = $(this).attr("id");  
           $.ajax({  
                url:"fetch.php",  
                method:"POST",  
                data:{task_id:task_id},  
                dataType:"json",  
                success:function(data){  
                     $('#modaltitle').text('Edit task');
                     $('#reasonm').val(data.reason);  
                     $('#typem').val(data.type);  
                     $('#placem').val(data.place);  
                     $('#adressm').val(data.adress);  
                     $('#commentarym').val(data.commentary);  
                     $('#phonem').val(data.phone);  
                     $('#workernamу').val(data.workername);
                     $('#task_id').val(data.id);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  

                }  
           });  
      }); 
    });

// функция отвечающая за просмотр таска, грузит данные из файла select.php
 $(document).ready(function(){  
      $(document).on('click', '.view_data', function(){  
           var task_id = $(this).attr("id");  
           $.ajax({  
                url:"select.php",  
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

//функция добавления таска, так же проверяет поля на валидность и не дает оставлять поля пустыми, логика добавления в файле insert.php
$(document).ready(function(){
 $('#insert_form').on("submit", function(event){  
  event.preventDefault();  
  if($('#reasonm').val() == "")  
  {  
   alert("Reason is required");  
  }  
  else if($('#typem').val() == '')  
  {  
   alert("Typem is required");  
  }  
  else if($('#placem').val() == '')
  {  
   alert("Place is required");  
  }
  else if($('#adressm').val() == '')
  {  
   alert("Adress is required");  
  }
  else if($('#commentarym').val() == '')
  {  
   alert("Commentary is required");  
  }
   else if($('#phonem').val() == '')
  {  
   alert("Phone is required");  
  }
  else  
  {  
   $.ajax({  
    url:"insert.php",  
    method:"POST",  
    data:$('#insert_form').serialize(),  
    beforeSend:function(){  
     $('#insert').val("Updating");  
    },  
    success:function(data){  
     $('#insert_form')[0].reset();  
     $('#add_data_Modal').modal('hide');  
     $('#tasktable').html(data);  
      location.reload();
    }  
   });  
  }  
   
 });
});