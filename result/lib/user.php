<?php

/**
 * Создает запись в бд о новом пользователе
 */
function create_user(PDO $connection, $user)
{
  $password_hash = password_hash($user['password'], PASSWORD_BCRYPT);
  $query = $connection->prepare("INSERT INTO users(first_name, last_name, login, email, password_hash) VALUES (:first_name, :last_name, :login, :email, :password_hash)");
  $query->bindParam("first_name", $user['first_name'], PDO::PARAM_STR);
  $query->bindParam("last_name", $user['last_name'], PDO::PARAM_STR);
  $query->bindParam("login", $user['login'], PDO::PARAM_STR);
  $query->bindParam("email", $user['email'], PDO::PARAM_STR);
  $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
  return $query->execute();
}

/**
 * Аутентификация пользователя в системе
 * В случае нахождения пользователя в бд и соответствии паролей возвращается `user_id`.
 * Во всех остальных случаях функция возвращает `null`
 */
function authenticate_user(PDO $connection, $credentials): int|null
{
  $query = $connection->prepare('SELECT * FROM users WHERE login=:login');
  if (!$query) {
    return null;
  }
  $query->bindParam('login', $credentials['login']);
  $query->execute();
  $user = $query->fetch();
  if (!$user) {
    return null;
  }
  if (password_verify($credentials['password'], $user['password_hash'])) {
    return $user['id'];
  }
  return null;
}

/**
 * Получить пользователя из базы данных
 */
function get_user(PDO $connection, int $user_id)
{
  $query = $connection->prepare('SELECT * FROM users WHERE id=:user_id');
  $query->bindParam('user_id', $user_id);
  $query->execute();
  return $query->fetch();
}