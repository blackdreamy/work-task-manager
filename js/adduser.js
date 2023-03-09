let backButton = document.getElementById('backbutton');   // кнопка назад
let regButton = document.getElementById('regbutton');	  // кнопка регистрации
// убираем дефолтное действие кнопки назад и заставляем её отправлять нас на главную страницу, откуда нас ведет в админ-панедь
backButton.addEventListener('click',function(evt){
	evt.preventDefault();
	window.location = '/';

});
// функция генерейта пароля - 8 знаков из букв и символов.
function generatePassword(){
	let randomstring = Math.random().toString(36).slice(-8);
	return randomstring;
};
// кнопка генерации пароля (она скрыта на странице)
let genButton = document.getElementById('genbutton');
// поле куда генерится пароль после нажатия скрытой кнопки (это поле тоже скрыто)
let genInput = document.getElementById('genpass');
//при нажатии кнопки регистрации сначала генерится пароль в поле пароля, которое не видно, потом через php код в бд добавляются данные и регистрация успешна
regButton.addEventListener('click',function(){
	genInput.value=generatePassword();
});
// блок в который рендерятся ошибки
let errordiv = document.getElementById('errordiv');


// каждые 2 секунды срабатывает функция, которая через 3 секунды после её активации скрывает блок с ошибками.
	setInterval(function() {
  if (errordiv) {
	setTimeout(function(){
 		 errordiv.style.display='none';
	}, 3 * 1000);
};
}, 2000);
