
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 

<html lang="ru">
  <head>
    <title>Ноги в руки</title>
    <link rel="stylesheet" href="style.css">
  </head>
<body>

  <?php
  if (!empty($messages)) {
    print('<div id="messages">');
    // Выводим все сообщения.
    foreach ($messages as $message) {
      print($message);
    }
    print('</div>');
  }

  // Далее выводим форму отмечая элементы с ошибками классом error
  // и задавая начальные значения элементов ранее сохраненными.
  ?>

<header>
  <h1> Лаборатория трансплантации "Ноги в руки" </h1>
</header>
<content>
  <h2>Авторизация:</h2>
  <form action = "index.php" method="POST">
    <ol>
      <li>
          <label>
            Логин:<br />
            <input name="login" />
          </label><br />
      </li>
      <li>
          <label>
            Пароль:<br />
            <input name="pass" />
          </label><br />
      </li>
    </ol>
    <input type="submit" value="Отправить">
  </form>

</content>
<footer>
      <h2><p>&#169; Ведущий продавец ушей 2023 </p></h2>

</footer>

</body>

</html>