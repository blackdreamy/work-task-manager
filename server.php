<?php
// -------------------- begin devil code ------------------------
//                             ,-.
//        ___,---.__          /'|`\          __,---,___
//     ,-'    \`    `-.____,-'  |  `-.____,-'    //    `-.
//  ,'        |           ~'\     /`~           |        `.
// /      ___//              `. ,'          ,  , \___      \
// |    ,-'   `-.__   _         |        ,    __,-'   `-.    |
// |   /          /\_  `   .    |    ,      _/\          \   |
// \  |           \ \`-.___ \   |   / ___,-'/ /           |  /
//  \  \           | `._   `\\  |  //'   _,' |           /  /
//   `-.\         /'  _ `---'' , . ``---' _  `\         /,-'
//      ``       /     \    ,='/ \`=.    /     \       ''
//              |__   /|\_,--.,-.--,--._/|\   __|
//              /  `./  \\`\ |  |  | /,//' \,'  \
//             /   /     ||--+--|--+-/-|     \   \
//            |   |     /'\_\_\ | /_/_/`\     |   |
//             \   \__, \_     `~'     _/ .__/   /
//              `-._,-'   `-._______,-'   `-._,-'
// -------------------------------------------------------------- 
session_start();
// создаем  переменные username и companyname для последующей проверки полей на странице регистрации и массив errors для хранения ошибок при регистрации
// ошибки позже будут рендерится над полями ввода данных на странице регистрации
include('sendmail.php');
$username = "";
$companyname    = "";
$errors = array(); 
// коннектимся к бд
$db = mysqli_connect('localhost', 'root', '123', 'registration');
// регаем юзера
if (isset($_POST['reg_user'])) {
  // получаем все значения из полей на странице регистрации
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $companyname = mysqli_real_escape_string($db, $_POST['companyname']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  // валидация формы, убеждаемся, что все данные введены корректно
  // array_push добавляет лог ошибки в массив errors
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($companyname)) { array_push($errors, "Companyname is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if ($password_1 != $password_2) {
  array_push($errors, "The two passwords do not match");
  }
  // сначала проверяем бд
  // есть ли уже такой юзер или компания с таким назваием в бд
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR companyname='$companyname' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // если юзер, компания или мыло уже есть - выдаем ошибку
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
    if ($user['companyname'] === $companyname) {
      array_push($errors, "Companyname already exists");
    }
    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }
  // Регистрируем юзера если нет ошибок в полях регистрации.
  if (count($errors) == 0) {
    $query = "INSERT INTO `users` (`username`, `companyname`, `password`, `email`) VALUES ( '$username', '$companyname', '$password_1', '$email')";
    mysqli_query($db, $query);
    header('location: login.php');
    mailUser($email, $username, $companyname);
  }
}
///////////////////////////
// ЛОГИН ЮЗЕРА
//юзер жмет кнопку логина
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  //проверяем заполнил ли он поля логина и пароля
  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }
  // если все заполнено и нет никаких ошибок
  if (count($errors) == 0) {
    // проверяем совпадает ли логин и пароль с бд
    $query = "SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password'";
    $results = mysqli_query($db, $query);
    $fromsql = mysqli_fetch_array($results);
    // если все ок, то логиним его и передаем в _SESSION логин юзера и название компании которую он представляет
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['companyname'] = $fromsql['companyname'];
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $fromsql['email'];
      $_SESSION['password'] = $fromsql['password'];
      $_SESSION['success'] = "You are now logged in";
      header('location: panel.php');
    // если пасс и логин не совпали - выдаем ошибку  
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}
/////////////////////////////////////////////////
// ЛОГИНИМ РАБОТЯГУ
if (isset($_POST['login_worker'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  //проверяем заполнил ли он поля логина и пароля
  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }
  // если все заполнено и нет никаких ошибок
  if (count($errors) == 0) {
    // проверяем совпадает ли логин и пароль с бд
    $query = "SELECT * FROM `workers` WHERE `user`='$username' AND `password`='$password'";
    $results = mysqli_query($db, $query);
    $fromsql = mysqli_fetch_array($results);
    // если все ок, то логиним его и передаем в _SESSION логин юзера и название компании которую он представляет
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['companyname'] = $fromsql['companyname'];
      $_SESSION['user'] = $username;
      $_SESSION['realname'] = $fromsql['realname'];
      $_SESSION['success'] = "You are now logged in";
      $_SESSION['squad'] = $fromsql['squad'];
      $_SESSION['role'] = $fromsql['role'];
      $_SESSION['email'] = $fromsql['email'];
      $_SESSION['password'] = $fromsql['password'];
      header('location: workerpanel.php');
    // если пасс и логин не совпали - выдаем ошибку  
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}
?>