<?php
function foo()
{
  $user = 'u52834'; // Заменить на ваш логин uXXXXX
  $pass = '5281480'; // Заменить на пароль, такой же, как от SSH
  $db1 = new PDO('mysql:host=localhost;dbname=u52834', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX
  return $db1;
}
header('Content-Type: text/html; charset=UTF-8');


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  $messages = array();


  if (!empty($_COOKIE['save'])) {

    setcookie('save', '', 100000);
    setcookie('login', '', 100000);
    setcookie('pass', '', 100000);

    $messages[] = 'Спасибо, результаты сохранены.';
    if (!empty($_COOKIE['pass'])) {
        $messages[] = sprintf('Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.',
        strip_tags($_COOKIE['login']),
        strip_tags($_COOKIE['pass']));
    }
  }


  $errors = array();
  
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['kon'] = !empty($_COOKIE['kon_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);
  $errors['ability'] = !empty($_COOKIE['ability_error']);
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
  if ($errors['ability']) {
    
    setcookie('ability_error', '', 100000);
    
    $messages[] = '<div class="error">Заполните суперспособность.</div>';
  }
  if ($errors['check']) {

    setcookie('check_error', '', 100000);

    $messages[] = '<div class="error">Согласитесь с контрактом.</div>';
  }

  print('Вход '); 
  
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['kon'] = empty($_COOKIE['kon_value']) ? '' : $_COOKIE['kon_value'];
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
  $values['ability'] = empty($_COOKIE['ability_value']) ? array() : json_decode($_COOKIE['ability_value']);
  $values['check'] = empty($_COOKIE['check_value']) ? '' : $_COOKIE['check_value'];
  if (empty($errors)) {print('1 условие');}
  if (!empty($_COOKIE[session_name()])) {print('2 условие');}
  //if (session_start()) {print('3 условие');}
  if (!empty($_SESSION['login'])) {print('4 условие');}
  //if (empty($errors) && !empty($_COOKIE[session_name()]) &&
      //session_start() && !empty($_SESSION['login'])) {
  if ( !empty($_COOKIE[session_name()]) &&
        session_start()) {       
    // TODO: загрузить данные пользователя из БД
    // и заполнить переменную $values,
    // предварительно санитизовав.
    $db = foo();
    $stmt = $db->prepare("SELECT l.login, z.namee, z.email, z.godrod, z.pol, z.konech, z.biogr FROM lopata l, zayava z WHERE l.login = '1876'");
    //$stmt->execute();
    print('перед ифом');
    if($stmt->execute()){
      foreach($stmt as $row){
        print('Вход \n'); 

        $values['name']= $row["namee"];
        $values['email'] = $row["email"];
        $values['year'] = $row["godrod"];
        $values['kon'] = $row["konech"];
        $values['gender'] = $row["pol"];
        $values['bio'] = $row["biogr"];
        print($values['name']);
      }
    }
    else{
      print('nono');
    }       
 
    

    printf('Вход с логином %s, uid %d', $_SESSION['login'], $_SESSION['uid']);
  }

  //include('form.php');
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

  if (empty($_POST['email']) || !preg_match("*@*", $_POST['email'])) {
    
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

  foreach ($_POST['ability'] as $ability) {
    if (!in_array($ability, ['stenchod', 'nevidim', 'levitat'])) {
      setcookie('ability_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
      break;
    }
  }
  if (!empty($_POST['ability'])) {
    setcookie('ability_value', json_encode($_POST['ability']), time() + 24 * 60 * 60);
  }
  else{
    setcookie('ability_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
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
    setcookie('ability_error', '', 100000);
    setcookie('bio_error', '', 100000);
    setcookie('check_error', '', 100000);
  
  }
  if (!empty($_COOKIE[session_name()]) &&
      session_start() && !empty($_SESSION['login'])) {
    // TODO: перезаписать данные в БД новыми данными,
    // кроме логина и пароля.
    printf('Не туды'); 
  }
  else {
    // Генерируем уникальный логин и пароль.
    
    $db = foo();
    $lolob = TRUE;
    $lolo = '123';
    while ($lolob)
    {
      try{

        $lolo = rand(1000, 9999);
        $sql = $db ->prepare ("SELECT * FROM lopata WHERE login = $lolo");
        $lolob = False;
        if($result = $sql->execute()){
          foreach($result as $row){
            $lolob = True;
          }
        }       
      }
      catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        exit();
      }
    }
    $popo = rand(10000, 99999);
    $hoho = md5($popo);
    
    // Сохраняем в Cookies.
    setcookie('login', $lolo);
    setcookie('pass', $popo);
    //сохраняем в бд лоло и попо
    try{

      $stmt = $db->prepare("INSERT INTO lopata SET login = :my_lolo , parol = :my_hoho");
      $stmt->bindParam(':my_lolo', $lolo);
      $stmt->bindParam(':my_hoho', $hoho);
 
      $stmt->execute();
      $max_id_z1 = ($db->lastInsertId());
      
    }
    catch(PDOException $e){
      print('Error : ' . $e->getMessage());
      exit();
    }
    
    // Сохранение в базу данных формы. Осталось сохранить логин и хеш пароль в бд

  
  try {
    
    $stmt = $db->prepare("INSERT INTO zayava SET id_z = ?, namee = ?, email = ?, godrod = ?, pol = ?, konech = ?, biogr = ?");
    $stmt->execute([$max_id_z1, $_POST['name'], $_POST['email'], $_POST['year'], $_POST['gender'], $_POST['kon'], $_POST['bio']]);
    
    
    foreach ($_POST['ability'] as $ability) {
      
      $stmt = $db->prepare("INSERT INTO sposob SET tip = :mytip");
      $stmt->bindParam(':mytip', $ability);
      $stmt->execute();

      $max_id_s = ($db->lastInsertId());

      $stmt = $db->prepare("INSERT INTO svyaz (id_z, id_s) VALUES (:myidz, :myids)");
      $stmt->bindParam(':myids', $max_id_s);
      $stmt->bindParam(':myidz', $max_id_z1);
      $stmt->execute();
    }
    
  }
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
  }
  }
 
  
  setcookie('save', '1');
  header('Location: index.php');
}



?>
