<?php
session_start();
if (empty($_SESSION['user_id'])) {
  header('Location:./login.php');
  exit;
}
require_once('./lib/db.php');
require_once('./lib/user.php');
$connection = create_db_connection();
$user = get_user($connection, $_SESSION['user_id']);
if (!$user) {
  header('Location:./logout.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./static/style.css" />
    <title>Личный кабинет</title>
  </head>
  <body>
    <header class="header">
      <div class="header__container">
        <a class="header__logo" href="./index.php">App</a>
        <div>
          <nav>
            <ul class="header__list">
              <li class="header__list-item">
                <a class="header__link _active" href="./index.php"
                  >Личный кабинет</a
                >
              </li>
              <li class="header__list-item">
                <a class="header__link" href="./login.php">Войти</a>
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
    <main class="profile">
      <div class="profile__container">
        <div class="profile__info">
          <div class="profile__avatar">
            <img src="./static/avatar.jpg" alt="avatar" />
          </div>
          <div>
            <div class="profile__fullname">
              <?php echo $user['first_name'] . ' ' . $user['last_name'] ?>
            </div>
            <div class="profile__city"><?php echo $user['email'] ?></div>
          </div>
        </div>
        <form class="form" method="post" action="./profile.php">
          <fieldset class="form__fieldset">
            <label class="label">
              <span class="label__text">Логин</span>
              <input class="input" type="text" name="login" value="<?php echo $user['login'] ?>" />
            </label>
            <label class="label">
              <span class="label__text">Email</span>
              <input class="input" type="email" name="email" value="<?php echo $user['email'] ?>" />
            </label>
          </fieldset>
          <fieldset class="form__fieldset">
            <label class="label">
              <span class="label__text">Имя</span>
              <input class="input" type="text" name="firstname" value="<?php echo $user['first_name'] ?>" />
            </label>
            <label class="label">
              <span class="label__text">Фамилия</span>
              <input class="input" type="text" name="lastname" value="<?php echo $user['last_name'] ?>" />
            </label>
          </fieldset>
          <button type="submit" class="btn">Сохранить</button>
        </form>
        <a href="./logout.php" class="logout">Выйти</a>
      </div>
    </main>
  </body>
</html>
