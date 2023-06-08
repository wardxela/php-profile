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
    create_user($connection, [
        'first_name' => $_POST['firstname'],
        'last_name' => $_POST['lastname'],
        'login' => $_POST['login'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ]);
    header('Location:./login.php');
?>
<?php else: ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./static/style.css" />
    <title>Регистрация</title>
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
                <a class="header__link" href="./login.php">Войти</a>
              </li>
              <li class="header__list-item">
                <a class="header__link _active" href="./register.php"
                  >Зарегистрироваться</a
                >
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </header>
    <main class="register">
      <div class="register__container">
        <h1 class="title">Регистрация</h1>
        <form class="form" method="post" action="./register.php">
          <fieldset class="form__fieldset">
            <label class="label">
              <span class="label__text">Логин</span>
              <input class="input" type="text" name="login" />
            </label>
            <label class="label">
              <span class="label__text">Email</span>
              <input class="input" type="text" name="email" />
            </label>
          </fieldset>
          <fieldset class="form__fieldset">
            <label class="label">
              <span class="label__text">Имя</span>
              <input class="input" type="text" name="firstname" />
            </label>
            <label class="label">
              <span class="label__text">Фамилия</span>
              <input class="input" type="text" name="lastname" />
            </label>
          </fieldset>
          <fieldset class="form__fieldset">
            <label class="label">
              <span class="label__text">Пароль</span>
              <input class="input" type="text" name="password" />
            </label>
            <label class="label">
              <span class="label__text">Пароль (повторно)</span>
              <input class="input" type="text" name="password2" />
            </label>
          </fieldset>
          <button type="submit" class="btn">Сохранить</button>
        </form>
      </div>
    </main>
  </body>
</html>
<?php endif; ?>