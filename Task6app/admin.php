<?php
function foo()
{
  $user = 'u52834'; // Заменить на ваш логин uXXXXX
  $pass = '5281480'; // Заменить на пароль, такой же, как от SSH
  $db1 = new PDO('mysql:host=localhost;dbname=u52834', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX
  return $db1;

}

function tootoo($l, $n, $e, $y, $k, $g, $b)
{
  $db = foo();
  //tootoo($b['login'], $b['name'], $b['email'], $b['year'], $b['kon'], $b['gender'], $b['bio']);
  $stmt = $db->prepare("UPDATE zayava SET namee = :my_namee, email = :my_email, godrod = :my_godrod, pol = :my_pol, konech = :my_konech, biogr = :my_biogr WHERE id_z = (SELECT id_z FROM lopata WHERE login = :my_lolo)");
  $stmt->bindParam(':my_namee', $n);
  $stmt->bindParam(':my_email', $e);
  $stmt->bindParam(':my_godrod', $y);
  $stmt->bindParam(':my_pol', $g);
  $stmt->bindParam(':my_konech', $k);
  $stmt->bindParam(':my_biogr', $b);
  $stmt->bindParam(':my_lolo', $l);
  $stmt->execute();
  $stmt2 = $db->prepare("SELECT id_z FROM lopata WHERE login = :my_lolo");
  $stmt2->bindParam(':my_lolo', $l);
  $stmt2->execute();
  print($n);
  print($e);
  print($y);
  print($g);
  print($k);
  print($b);
  print($l);
  
  foreach($stmt2 as $row)
  {
    $a = $row['id_z'];
    print($a);
    //print($row);
  }
  $stmt2 = $db->prepare("SELECT count(*) pp FROM lopata WHERE login = :my_lolo");
  $stmt2->bindParam(':my_lolo', $l);
  $stmt2->execute();
  foreach($stmt2 as $row)
  {
    $a = $row['pp'];
    print('--');
    print($a);
    print('--');
    //print($row);
  }

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
echo '</br>';
?>
<form action = "admin.php" method="POST">
<?php
$db = foo();

$stmt = $db->prepare("SELECT l.login, z.namee, z.email, z.godrod, z.pol, z.konech, z.biogr FROM lopata l, zayava z WHERE l.id_z = z.id_z");  
echo '<table border="1">';
$shapka = array('login', 'name', 'email', 'year', 'kon', 'gender', 'bio');
echo '<tr>';
    foreach ($shapka as $v){
      echo '<td>'. $v .'</td>';
    }
echo '</tr>';
$big = array();
$i = 0;
if($stmt->execute()){


  foreach($stmt as $row){
    $values['login'] = $row['login'];
    $values['name']= $row["namee"];
    $values['email'] = $row["email"];
    $values['year'] = $row["godrod"];
    $values['kon'] = $row["konech"];
    $values['gender'] = $row["pol"];
    $values['bio'] = $row["biogr"];
    $big[$i] = $values;
    $i=$i+1;
    echo '<tr>';
    echo '<td>'.  $values['login'] .'</td>';
    echo '<td><input name="name" value = '.  $values['name'] .'></td>';
    echo '<td><input name="email" value = '.  $values['email'] .'></td>';
    echo '<td><input name="year" value = '.  $values['year'] .'></td>';
    echo '<td><input name="kon" value = '.  $values['kon'] .'></td>';
    echo '<td><input name="gender" value = '.  $values['gender'] .'></td>';
    echo '<td><input name="bio" value = '.  $values['bio'] .'></td>';  
    
    //if(isset($_POST['chu']) and $b == FALSE) 
      //tootoo($values['login'], $_POST['name'], $_POST['email'], $_POST['year'], $_POST['kon'], $_POST['gender'], $_POST['bio']);break;}
    
    echo '</tr>';
  }
}
echo '</table>';
echo '<input name = "bubu" type="submit" value="Отправить">';
if(isset($_POST['bubu']))
{
  print('yraaa');
  
  foreach ($big as $b){
    //print($b['login']); print($b['name']);
    tootoo($b['login'], $_POST['name'], $_POST['email'], $_POST['year'], $_POST['kon'], $_POST['gender'], $_POST['bio']);
    //foreach($b as $bb)
    //{
      //print($bb);
    //}
  }
}

?>
</form>
<?php
print('Статистика');
echo '</br>';
print('Левитация: ');
$stmt = $db->prepare("SELECT count(*) FROM sposob s WHERE s.tip = 'levitat'"); 
$stmt->execute();
foreach ($stmt as $v){
  foreach($v as $vv){
    print($vv);
    break;
  }
}
echo '</br>';
print('Невиидимость: ');
$stmt = $db->prepare("SELECT count(*) FROM sposob s WHERE s.tip = 'nevidim'"); 
$stmt->execute();
foreach ($stmt as $v){
  foreach($v as $vv){
    print($vv);
    break;
  }
}
echo '</br>';
print('Стенопроходимость: ');
$stmt = $db->prepare("SELECT count(*) FROM sposob s WHERE s.tip = 'stenchod'"); 
$stmt->execute();
foreach ($stmt as $v){
  foreach($v as $vv){
    print($vv);
    break;
  }
}





// *********
// Здесь нужно прочитать отправленные ранее пользователями данные и вывести в таблицу.
// Реализовать просмотр и удаление всех данных.
// *********

