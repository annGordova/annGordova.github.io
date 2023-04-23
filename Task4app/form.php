
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
  <h2>Чтобы записаться на процедуру, заполните анкету:</h2>
  <form action = "index.php" method="POST">
    <ol>
      <li>
          <label>
            Имя:<br />
            <input name="name" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php print $values['name']; ?>" />
          </label><br />
      </li>
      <li>
        <label>
            e-mail:<br />
            <input name="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>" type="email" />
        </label><br />
      </li>
      <li>
       <label>
            Год рождения:<br />
            <input name="year" <?php if ($errors['year']) {print 'class="error"';} ?> value="<?php print $values['year']; ?>"  />
        </label><br />
      </li>
      <li>
        <label>
            Пол: <br />
            <label><input type="radio" name="gender" value = "2" <?php print($errors['gender'] ? 'class="error"' : '');?> <?php if ($values['gender']=='2') print 'checked';?>/> женский </label>
            <label><input type="radio" name="gender" value = "1" <?php print($errors['gender'] ? 'class="error"' : '');?> <?php if ($values['gender']=='1') print 'checked';?>/> мужской </label> <br />
        </label>
      </li>
      <li>
          <label>
            Выберите количество конечностей: <br />
            <label><input type="radio" name="kon" value = "1" <?php print($errors['kon'] ? 'class="error"' : '');?> <?php if ($values['kon']=='1') print 'checked';?>/> 1</label>
            <label><input type="radio" name="kon" value = "2" <?php print($errors['kon'] ? 'class="error"' : '');?> <?php if ($values['kon']=='2') print 'checked';?>/> 2</label>
            <label><input type="radio" name="kon" value = "3" <?php print($errors['kon'] ? 'class="error"' : '');?> <?php if ($values['kon']=='3') print 'checked';?>/> 3</label>
            <label><input type="radio" name="kon" value = "4" <?php print($errors['kon'] ? 'class="error"' : '');?> <?php if ($values['kon']=='4') print 'checked';?>/> 4</label>
            <label><input type="radio" name="kon" value = "5" <?php print($errors['kon'] ? 'class="error"' : '');?> <?php if ($values['kon']=='5') print 'checked';?>/> 5</label>
            <label><input type="radio" name="kon" value = "6" <?php print($errors['kon'] ? 'class="error"' : '');?> <?php if ($values['kon']=='6') print 'checked';?>/> 6 и больше
          </label>
      </li>
      <li>
          <label>
            Выберите желаемые сверхспособности: <br />

            <select name="abilities[]" <?php if ($errors['abilities']) {print 'class="error"';} ?> multiple="multiple">
              <option value="<?php print $values['abilities']; ?>" selected="selected"> бессмертие </option>
              <option value="<?php print $values['abilities']; ?>"> прохождение сквозь стены  </option>
              <option value="<?php print $values['abilities']; ?>"> левитация </option>
            </select>
          </label>
      </li>
      <li>
        <label>
            Биография и пожаления:<br />
            
            <textarea name="bio" <?php if ($errors['bio']) {print 'class="error"';} ?> value="<?php print $values['bio']; ?>" ></textarea>
        </label><br />
      </li>
      <li>
        <label>
            Чекбокс: <br />
            <input type="checkbox" name="check" <?php if ($errors['check']) {print 'class="error"';} ?> value="<?php print $values['check']; ?>"> C контрактом ознакомлен(а)
        </label> <br />
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