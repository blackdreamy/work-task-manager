<?php
			// все ниже библиотека PHPMailer для отправки сообщений. 
		
	   	use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

		require 'src/Exception.php';
		require 'src/PHPMailer.php';
		require 'src/SMTP.php';
	// функция в которую передаются: адресс работяги которого зарегали, его имя пароль, название компании администратора который зарегал работягу и сгенерированный пароль.
	function sendMail($mailadress, $name, $login,$companyname, $password,$role,$squad){
			

		$mail = new PHPMailer;
		$mail->isSMTP(); 
		$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
		$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
		$mail->Port = 587; // TLS only
		$mail->SMTPSecure = 'tls'; // ssl is depracated
		$mail->SMTPAuth = true;
		$mail->CharSet = 'UTF-8';
		$mail->Username = 'naujauzduotis01@gmail.com';
		$mail->Password = '7777777777777777'; // password
		$mail->setFrom('naujauzduotis01@gmail.com', 'taskZ@noreply');  //login
		$mail->addAddress($mailadress, $name);
		$mail->Subject = 'Your taskZ account data!';
		$mail->msgHTML("<h1>Hello, $name</h1><br>
												
						<h2> You now have an account! <h2> <br>
						<p> Your company - $companyname </p>
						<p> Your division - $squad </p>
						<p> Your role - $role </p>
						<hr>
						<p> Your login: $login </p>
						<p> Your password: $password </p>

						<p></p>
						<p>Enjoy our service! </p>"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
		$mail->AltBody = 'HTML messaging not supported';
		// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

		if(!$mail->send()){
		}else{
		    echo "Message sent!";
		}
	}

	// функция для отправки уведомления о добавлении нового таска, передаем в неё мейл работяги, его мыло и время добавления таска
	function sendNotification($mailadress, $name, $tasktime){
			

		$mail = new PHPMailer;
		$mail->isSMTP(); 
		$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
		$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
		$mail->Port = 587; // TLS only
		$mail->SMTPSecure = 'tls'; // ssl is depracated
		$mail->SMTPAuth = true;
		$mail->CharSet = 'UTF-8';
		$mail->Username = 'naujauzduotis01@gmail.com';
		$mail->Password = '7777777777777777'; // password
		$mail->setFrom('naujauzduotis01@gmail.com', 'taskZ@noreply');  //login
		$mail->addAddress($mailadress, $name);
		$mail->Subject = 'New task!';
		$mail->msgHTML("<h1> Hi $name </h1> <br>
						<br>
						<br>
						<h2> A new task has appeared in your account! </h2>
						<h2> Task distribution time $tasktime </h2>
						<p> </p>
						<p> Enjoy our services! </p>"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
		$mail->AltBody = 'HTML messaging not supported';
		// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

		if(!$mail->send()){
		}else{
		    echo "Message sent!";
		}
	}

	function mailUser($mailadress, $login, $companyname){
			

		$mail = new PHPMailer;
		$mail->isSMTP(); 
		$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
		$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
		$mail->Port = 587; // TLS only
		$mail->SMTPSecure = 'tls'; // ssl is depracated
		$mail->SMTPAuth = true;
		$mail->CharSet = 'UTF-8';
		$mail->Username = 'naujauzduotis01@gmail.com';
		$mail->Password = '7777777777777777'; // password
		$mail->setFrom('naujauzduotis01@gmail.com', 'taskZ@noreply');  //login
		$mail->addAddress($mailadress, $name);
		$mail->Subject = 'Your taskZ account data!';
		$mail->msgHTML("<h1>Welcome!</h1><br>
						<br>
						<br>
						<h2>Now you have account on taskZ!</h2>
						<h2>Your login is : $login</h2>
						<h2>Your company name is : $companyname<h2>
						<br>
						<p></p>
						<p>Enjoy our service!</p>"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
		$mail->AltBody = 'HTML messaging not supported';
		// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

		if(!$mail->send()){
		}else{
		    echo "Message sent!";
		}
	}

 ?>