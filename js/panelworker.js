// эвент для кнопки логаута
document.getElementById('logouticon').addEventListener('click', function(){
	window.location = 'logout.php';
});

let modal = document.getElementById('myModal');
let modalBody = document.getElementById('modalbody');
let span = document.getElementById('close1');
// эвент клика на иконку юзера, показывает инфу профиля
document.getElementById('usericon').addEventListener('click',function(){
	$('#profileModal').modal("show"); 
});
// эвент клика на кнопку смены пароля, редиректит на страницу смены пароля
document.getElementById('passwordicon').addEventListener('click',function(){
	window.location = 'changepassword.php';
});
// изменение цвета строки в таблице в зависимости от текущего состояния задания 
let rarities = Array.from(document.querySelectorAll('.rarity'));
for (let rarity of rarities) {
  let text = rarity.textContent;
  let row = rarity.closest('tr');
  if (text === 'Not started') {
  	rarity.closest('tr').querySelectorAll('.finishtask')[0].style = 'display:none;';
  	rarity.closest('tr').querySelectorAll('.starttask')[0].style = 'display:normal;';
  } else if(text === 'Ongoing') {
    row.setAttribute('style', 'background-color:#b0c5dc !important');
    rarity.closest('tr').querySelectorAll('.starttask')[0].style = 'display:none;';
    rarity.closest('tr').querySelectorAll('.finishtask')[0].style = 'display:normal;';
      }
  else if(text === 'Finished') {
    row.style.background ='#6cbe67';
    rarity.closest('tr').querySelectorAll('.starttask')[0].style = 'display:none;';
    rarity.closest('tr').querySelectorAll('.finishtask')[0].style = 'display:none;';
  }
} 