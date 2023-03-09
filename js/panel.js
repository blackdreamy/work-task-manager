let rarities = Array.from(document.querySelectorAll('.rarity'));
// меняет цвет строки в зависимости от рарности задания
for (let rarity of rarities) {
  let text = rarity.textContent;
  let row = rarity.closest('tr');
  if (text === 'Not started') {
  	row.style.background = 'white';
  } else if(text === 'Ongoing') {
    row.style.background ='#b0c5dc';
  }
  else if(text === 'Finished') {
    row.style.background ='#6cbe67';
  }
} 

document.getElementById('logouticon').addEventListener('click', function(){
  window.location = 'logout.php';
});

    
// все кнопки удалить хранящиеся в массиве
let buttons = Array.from(document.querySelectorAll('.delete'));
// функция которая спрашивает точно ли мы хотим удалить таск
function getConfirmation(insidevalue) {
               var retVal = confirm("You really want to delete?");
               if( retVal == true ) {
                  window.location =  insidevalue;
                  return true;
               } else {
               		return false;
                  window.location = '/';
               }
           }

// при наводе на кнопки удаления подсвечивает красным строку
for(let button of buttons){
	button.addEventListener('mouseover',function(){
		 let tr = button.closest('tr');
		 tr.classList.add('deleted');
	});
	button.addEventListener('mouseout',function(){
		 let tr = button.closest('tr');
		 tr.classList.remove('deleted');
	});
	button.addEventListener('click',function(evt){
		evt.preventDefault();
		getConfirmation(evt.target.href);
	})
}

// эвент клика на кнопку юзера в верхней части сайта - открывает модальное окно с информацией юзера
document.getElementById('usericon').addEventListener('click',function(){
  $('#profileModal').modal("show"); 
});
// эвент клика, редиректит юзера на страницу изменения пароля
document.getElementById('passwordicon').addEventListener('click',function(){
  window.location = 'updatepassword.php';
});





// инициализация библиотеки DataTables для главной таблицы на сайте

$(document).ready( function () {
    $('#taskstable').DataTable({
      "language": {
                "url": "js/dataTables.german.lang"
            },
      responsive: true,
      "columnDefs": [
        { "orderable": false, "targets": [11,12,13] }
      ],
      "order": [[ 10, "asc" ]]
    });

} );