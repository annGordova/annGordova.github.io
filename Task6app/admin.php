<?php
function foo()
{
  $user = 'u52834'; // Заменить на ваш логин uXXXXX
  $pass = '5281480'; // Заменить на пароль, такой же, как от SSH
  $db1 = new PDO('mysql:host=localhost;dbname=u52834', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX
  return $db1;

}

/**
 * Задача 6. Реализовать вход администратора с использованием
 * HTTP-авторизации для просмотра и удаления результатов.
 **/

// Пример HTTP-аутентификации.
// PHP хранит логин и пароль в суперглобальном массиве $_SERVER.
// Подробнее см. стр. 26 и 99 в учебном пособии Веб-программирование и веб-сервисы.
if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != 'admin' ||
    md5($_SERVER['PHP_AUTH_PW']) != md5('123')) {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="My site"');
  print('<h1>401 Требуется авторизация</h1>');
  exit();
}


print('Вы успешно авторизовались и видите защищенные паролем данные.');
$db = foo();
$stmt = $db->prepare("SELECT l.login, z.namee, z.email, z.godrod, z.pol, z.konech, z.biogr FROM lopata l, zayava z WHERE l.id_z = z.id_z");
$stmt->bindParam();     

if($stmt->execute()){
  foreach($stmt as $row){
    $values['name']= $row["namee"];
    $values['email'] = $row["email"];
    $values['year'] = $row["godrod"];
    $values['kon'] = $row["konech"];
    $values['gender'] = $row["pol"];
    $values['bio'] = $row["biogr"];
    print($values['name'],$values['email'] ,$values['year']  ,$values['kon'] ,$values['gender'],$values['bio'])

  }
}



// *********
// Здесь нужно прочитать отправленные ранее пользователями данные и вывести в таблицу.
// Реализовать просмотр и удаление всех данных.
// *********

