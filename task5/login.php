<?php

/**
 * Файл login.php для не авторизованного пользователя выводит форму логина.
 * При отправке формы проверяет логин/пароль и создает сессию,
 * записывает в нее логин и id пользователя.
 * После авторизации пользователь перенаправляется на главную страницу
 * для изменения ранее введенных данных.
 **/

// Отправляем браузеру правильную кодировку,
// файл login.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// Начинаем сессию.
session_start();

// В суперглобальном массиве $_SESSION хранятся переменные сессии.
// Будем сохранять туда логин после успешной авторизации.
if (!empty($_SESSION['login'])) {
  // Если есть логин в сессии, то пользователь уже авторизован.
  // TODO: Сделать выход (окончание сессии вызовом session_destroy()
  //при нажатии на кнопку Выход).
  // Делаем перенаправление на форму.
  header('Location: ./form');
}

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>

  <form action="" method="post">
    <input name="login" />
    <input name="pass" />
    <input type="submit" value="Войти" />
  </form>

<?php
}
// Иначе, если запрос был методом POST, т.е. нужно сделать авторизацию с записью логина в сессию.
else {

  // TODO: Проверть есть ли такой логин и пароль в базе данных.
  // Выдать сообщение об ошибках.
  $user = 'u47572';
  $pass = '4532025';
  $db = new PDO('mysql:host=localhost;dbname=u47572', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

  $member = $_POST['login'];
  $member_pass_hash = md5($_POST['pass']);


  $stmt = $db->prepare("SELECT * FROM members WHERE login = ?, pass = ?");
  $stmt->execute(array($member, $member_pass_hash));
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if (empty($result)) {
    print('<div style="color: red; font-size: 16px; text-align: center;"');
    print("Пользоватлея не существует, проверьте корректность введенных данных</div>");
  } else {
    // Если все ок, то авторизуем пользователя.
    $_SESSION['login'] = $_POST['login'];
    // Записываем ID пользователя.
    $_SESSION['uid'] = $_POST['pass'];
    // Делаем перенаправление.
    header('Location: ./form');
  }
}
