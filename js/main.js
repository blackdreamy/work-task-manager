//Главная страница
// кнопка регистрации - отправляет нас на страницу регистрации
document.getElementById('signup-button').addEventListener('click',function(){
	document.location.href = '/signup.php';
});
//кнопка логина админа отправляет нас на страницу логина админа
document.getElementById('login-button').addEventListener('click',function(){
	document.location.href = '/login.php';
});
//кнопка логина работяги отправляет нас на страницу лоигна работяги
document.getElementById('loginw-button').addEventListener('click',function(){
	document.location.href = '/loginw.php';
});
