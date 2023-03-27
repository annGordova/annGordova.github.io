<?php
header('Content-Type: text/html; charset=UTF-8');


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  if (!empty($_GET['save'])) {

    print('Спасибо, результаты сохранены.');
  }

  include('form.php');

  exit();
}


$errors = FALSE;
if (empty($_POST['name'])) {
  print('Заполните имя.<br/>');
  $errors = TRUE;
}

if (empty($_POST['year']) || !is_numeric($_POST['year'])) {
  print('Заполните год.<br/>');
  $errors = TRUE;
}
if (empty($_POST['email'])) {
  print('Заполните email.<br/>');
  $errors = TRUE;
}
if (empty($_POST['bio'])) {
  print('Заполните биографию.<br/>');
  $errors = TRUE;
}
if (empty($_POST['check'])) {
  print('Согласитесь с контрактом.<br/>');
  $errors = TRUE;
}
if (empty($_POST['abilities'])) {
  print('Выберите способности.<br/>');
  $errors = TRUE;
}

// *************
// Тут необходимо проверить правильность заполнения всех остальных полей.
// *************

if ($errors) {
  // При наличии ошибок завершаем работу скрипта.
  exit();
}

// Сохранение в базу данных.

$user = 'u52834'; // Заменить на ваш логин uXXXXX
$pass = '5281480'; // Заменить на пароль, такой же, как от SSH
$db = new PDO('mysql:host=localhost;dbname=u52834', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX

// Подготовленный запрос. Не именованные метки.
try {
  $stmt = $db->prepare("INSERT INTO zayava SET namee = ?, email = ?, godrod = ?, pol = ?, konech = ?, biogr = ?");
  $stmt->execute([$_POST['name'], $_POST['email'], $_POST['year'], $_POST['gender'], $_POST['kon'], $_POST['bio']]);
  foreach ($_POST['abilities'] as $ability)
  {
    print($ability);
  }
  foreach ($_POST['abilities'] as $ability) {
    print($ability);
    $stmt = $db->prepare("INSERT INTO sposob SET tip = ?");
    print($stmt)
    $stmt->execute([$_POST['$ability']]);}
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

//  stmt - это "дескриптор состояния".
 
//  Именованные метки.
//$stmt = $db->prepare("INSERT INTO test (label,color) VALUES (:label,:color)");
//$stmt -> execute(['label'=>'perfect', 'color'=>'green']);
 
//Еще вариант
/*$stmt = $db->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$firstname = "John";
$lastname = "Smith";
$email = "john@test.com";
$stmt->execute();
*/

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1');
?>
