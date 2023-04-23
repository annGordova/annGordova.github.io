<?php
header('Content-Type: text/html; charset=UTF-8');


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  $messages = array();


  if (!empty($_COOKIE['save'])) {

    setcookie('save', '', 100000);

    $messages[] = 'Спасибо, результаты сохранены.';
  }


  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['kon'] = !empty($_COOKIE['kon_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);
  $errors['abilities'] = !empty($_COOKIE['abilities_error']);
  $errors['check'] = !empty($_COOKIE['check_error']);

  if ($errors['name']) {

    setcookie('name_error', '', 100000);

    $messages[] = '<div class="error">Заполните имя.</div>';
  }
  if ($errors['email']) {

    setcookie('email_error', '', 100000);

    $messages[] = '<div class="error">Заполните почту.</div>';
  }
  if ($errors['year']) {

    setcookie('year_error', '', 100000);

    $messages[] = '<div class="error">Заполните год.</div>';
  }
  if ($errors['gender']) {
    setcookie('gender_error', '', 100000);

    $messages[] = '<div class="error">Заполните пол.</div>';
  }
  if ($errors['kon']) {

    setcookie('kon_error', '', 100000);

    $messages[] = '<div class="error">Заполните число конечностей.</div>';
  }
  if ($errors['bio']) {

    setcookie('bio_error', '', 100000);

    $messages[] = '<div class="error">Заполните биографию.</div>';
  }
  if ($errors['abilities']) {

    setcookie('abilities_error', '', 100000);

    $messages[] = '<div class="error">Заполните способности.</div>';
  }
  if ($errors['check']) {

    setcookie('check_error', '', 100000);

    $messages[] = '<div class="error">Согласитесь с контрактом.</div>';
  }


  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['kon'] = empty($_COOKIE['kon']) ? '' : $_COOKIE['kon_value'];
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
  $values['abilities'] = empty($_COOKIE['abilities_value']) ? '' : $_COOKIE['abilities_value'];
  $values['check'] = empty($_COOKIE['check_value']) ? '' : $_COOKIE['check_value'];

  include('form.php');
}
else{
  
  $errors = FALSE;
  if (empty($_POST['name'])) {
    
    setcookie('name_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {

    setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['year']) || !is_numeric($_POST['year'])) {
    
    setcookie('year_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {

    setcookie('year_value', $_POST['year'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['email']) || !preg_match("*+@+*", $email)) {
    
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {

    setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['gender'])) {
    
    setcookie('gender_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {

    setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['kon'])) {
    
    setcookie('kon_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {

    setcookie('kon_value', $_POST['kon'], time() + 30 * 24 * 60 * 60);
  }
  
  if (empty($_POST['bio'])) {
    
    setcookie('bio_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {

    setcookie('bio_value', $_POST['bio'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['abilities'])) {
    
    setcookie('abilities_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {

    setcookie('abilities_value', $_POST['abilities'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['check'])) {
    
    setcookie('check_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {

    setcookie('check_value', $_POST['check'], time() + 30 * 24 * 60 * 60);
  }


  if ($errors) {

    header('Location: index.php');
    exit();
  }
  else {

    setcookie('name_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('year_error', '', 100000);
    setcookie('gender_error', '', 100000);
    setcookie('kon_error', '', 100000);
    setcookie('abilities_error', '', 100000);
    setcookie('bio_error', '', 100000);
    setcookie('check_error', '', 100000);
    


    
  }
  //
  // Сохранение в базу данных.

  $user = 'u52834'; // Заменить на ваш логин uXXXXX
  $pass = '5281480'; // Заменить на пароль, такой же, как от SSH
  $db = new PDO('mysql:host=localhost;dbname=u52834', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX

  // Подготовленный запрос. Не именованные метки.
  try {
    $stmt = $db->prepare("INSERT INTO zayava SET namee = ?, email = ?, godrod = ?, pol = ?, konech = ?, biogr = ?");
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['year'], $_POST['gender'], $_POST['kon'], $_POST['bio']]);
    //foreach ($_POST['abilities'] as $ability)
    //{
    //  print($ability);
    //}
    //$human = "SELECT MAX(id_z) maxidz FROM zayava"; 
    $max_id_z = ($db->lastInsertId());
    foreach ($_POST['abilities'] as $ability) {
      //print($ability);
      //$stmt = $db->prepare("INSERT INTO sposob SET tip = ? ");
      //$stmt->execute([$_POST['$ability']]);
      $stmt = $db->prepare("INSERT INTO sposob SET tip = :mytip");
      $stmt->bindParam(':mytip', $ability);
      $stmt->execute();

      $max_id_s = ($db->lastInsertId());

      $stmt = $db->prepare("INSERT INTO svyaz (id_z, id_s) VALUES (:myidz, :myids)");
      $stmt->bindParam(':myids', $max_id_s);
      $stmt->bindParam(':myidz', $max_id_z);
      $stmt->execute();
    }
    
  }
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
  }
  setcookie('save', '1');
  header('Location: index.php');
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

?>
