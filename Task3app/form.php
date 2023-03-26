
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 

<html lang="ru">
  <head>
    <title>Ноги в руки</title>
    <link rel="stylesheet" href="style.css">
  </head>
<body>
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
            <input name="field-name-1" value="Анна" />
          </label><br />
      </li>
      <li>
        <label>
            e-mail:<br />
            <input name="field-email" value="my@example.com" type="email" />
        </label><br />
      </li>
      <li>
       <label>
            Год рождения:<br />
            <input name="field-date" value="2004-01-03" type="date" />
        </label><br />
      </li>
      <li>
        <label>
            Пол: <br />
            <label><input type="radio" name="group-1" value="gen1" checked="checked"/> женский </label>
            <label><input type="radio" name="group-1" value="gen2"/> мужской </label> <br />
        </label>
      </li>
      <li>
          <label>
            Выберите количество конечностей: <br />
            <label><input type="radio" name="group-2" value="count1"/> 1</label>
            <label><input type="radio" name="group-2" value="count2"/> 2</label>
            <label><input type="radio" name="group-2" value="count3"/> 3</label>
            <label><input type="radio" name="group-2" value="count4" checked="checked"/> 4</label>
            <label><input type="radio" name="group-2" value="count5"/> 5</label>
            <label><input name="group-2" type="radio" value="count6"/> 6 и больше
          </label>
      </li>
      <li>
          <label>
            Выберите желаемые сверхспособности: <br />
            <select name="field-sup" multiple="multiple">
              <option value="num1" selected="selected"> бессмертие </option>
              <option value="num2"> прохождение сквозь стены  </option>
              <option value="num3"> левитация </option>
            </select>
          </label>
      </li>
      <li>
        <label>
            Биография и пожаления:<br />
            <textarea name="field-name-2">Родился с третьим глазом на лбу. Хочу передвинуть на затылок, чтобы было лучше видно</textarea>
        </label><br />
      </li>
      <li>
        <label>
            Чекбокс: <br />
            <input type="checkbox" name="check"> C контрактом ознакомлен(а)
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