// добавлен эвент на кнопку назад (возвращает в панель работяги)
document.getElementById('backbutton').addEventListener('click',function(evt){
	evt.preventDefault();
	window.location='workerpanel.php';
});
