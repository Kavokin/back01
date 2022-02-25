<?php
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
    if (!empty($_GET['save'])) {
        // Если есть параметр save, то выводим сообщение пользователю.
        print('Спасибо, результаты сохранены.');
    }
    // Включаем содержимое файла form.php.
    include('form.php');
    // Завершаем работу скрипта.
    exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

// Проверяем ошибки.
$errors = FALSE;
if (empty($_POST['name'])) {
    print('Заполните имя.<br/>');
    $errors = TRUE;
}
if (empty($_POST['email'])) {
    print('Заполните email.<br/>');
    $errors = TRUE;
}
if (empty($_POST['birth'])) {
    print('Выберите дату.<br/>');
    $errors = TRUE;
}
if (empty($_POST['gender'])) {
    print('Выберите пол.<br/>');
    $errors = TRUE;
}
if (empty($_POST['limbs'])) {
    print('Выберите количество конечностей.<br/>');
    $errors = TRUE;
}
if (empty($_POST['superpowers'])) {
    print('Выберите суперспособнос(ть/ти).<br/>');
    $errors = TRUE;
}
if (empty($_POST['bio'])) {
    print('Расскажите о себе.<br/>');
    $errors = TRUE;
}
if (empty($_POST['policy'])) {
    print('Ознакомтесь с политикой обработки данных.<br/>');
    $errors = TRUE;
}

if ($errors) {
    // При наличии ошибок завершаем работу скрипта.
    exit();
}

// Сохранение в базу данных.

// $user = 'db';
// $pass = '123';
// $db = new PDO('mysql:host=localhost;dbname=test', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

// // Подготовленный запрос. Не именованные метки.
// try {
//   $stmt = $db->prepare("INSERT INTO application (name) SET name = ?");
//   $stmt -> execute(array('fio'));
// }
// catch(PDOException $e){
//   print('Error : ' . $e->getMessage());
//   exit();
// }

//  stmt - это "дескриптор состояния".

//  Именованные метки.
//$stmt = $db->prepare("INSERT INTO test (label,color) VALUES (:label,:color)");
//$stmt -> execute(array('label'=>'perfect', 'color'=>'green'));

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