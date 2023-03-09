<!-- Код который отрисовывает массив error из файлов в блок на странице -->
<?php  if (count($errors) > 0) : ?>
  <div class="error" id='errordiv'>
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>