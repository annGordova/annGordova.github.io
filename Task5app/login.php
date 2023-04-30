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


session_start();

// В суперглобальном массиве $_SESSION хранятся переменные сессии.
// Будем сохранять туда логин после успешной авторизации.
if (!empty($_SESSION['login'])) {
  // Если есть логин в сессии, то пользователь уже авторизован.
  
  // TODO: Сделать выход (окончание сессии вызовом session_destroy()
  //при нажатии на кнопку Выход).
  // Делаем перенаправление на форму.
  print(($_SESSION['login']));
  header('Location: ./');
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>

<form action="" method="POST">
  <input name="login" />
  <input name="pass" />
  <input type="submit" value="Войти" />

</form>

<?php
}

else {

  $db = foo();
  $stmt = $db->prepare("SELECT l.login, l.parol FROM lopata l");
  $b = False;
  if($stmt->execute()){
    $i=0;
    foreach($stmt as $row){
      $i=$i+1;
      if ($row['login']==$_POST['login'] and $row['parol'] == md5($_POST['pass']))
        {$b = True;break;}
    }
  }
  $_GLOBALS['b']=$b;
  if ($b)
  {
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['uid'] = rand(100000000, 9999999999999);
    header('Location: ./');
  }
  else{
    print('Пользователь не найден');
    ?>
    <br/>
    <a href="index.php">На главную</a>
    <?php
  }
  
  
}
?>