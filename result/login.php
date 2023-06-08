<?php
session_start();
if (!empty($_SESSION['user_id'])) {
  header('Location:./index.php');
  exit;
}
?>
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
  <?php
  require_once('./lib/db.php');
  require_once('./lib/user.php');
  $connection = create_db_connection();
  $user_id = authenticate_user($connection, [
    'login' => $_POST['login'],
    'password' => $_POST['password'],
  ]);
  if (empty($user_id)) {
    header('Location:./login.php');
  } else {
    $_SESSION['user_id'] = $user_id;
    header('Location:./index.php');
    exit;
  }
?>
<?php else: ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./static/style.css" />
    <title>Вход</title>
  </head>
  <body>
    <header class="header">
      <div class="header__container">
        <a class="header__logo" href="./index.php">App</a>
        <div>
          <nav>
            <ul class="header__list">
              <li class="header__list-item">
                <a class="header__link" href="./index.php">Личный кабинет</a>
              </li>
              <li class="header__list-item">
                <a class="header__link _active" href="./login.php">Войти</a>
              </li>
              <li class="header__list-item">
                <a class="header__link" href="./register.php"
                  >Зарегистрироваться</a
                >
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </header>
    <main class="login">
      <div class="login__container">
        <h1 class="title">Вход</h1>
        <form class="form" method="post" action="./login.php">
          <label class="label">
            <span class="label__text">Логин</span>
            <input class="input" type="text" name="login" />
          </label>
          <label class="label">
            <span class="label__text">Пароль</span>
            <input class="input" type="text" name="password" />
          </label>
          <button type="submit" class="btn">Сохранить</button>
        </form>
      </div>
    </main>
  </body>
</html>
<?php endif; ?>
