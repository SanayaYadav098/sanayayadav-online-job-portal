<?php
$dotenv = __DIR__ . '/../.env';
if (file_exists($dotenv)) {
  foreach (file($dotenv, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
    $line = trim($line);
    if ($line === '' || strpos($line, '#') === 0) {
      continue;
    }
    $parts = explode('=', $line, 2);
    if (count($parts) === 2) {
      $name = trim($parts[0]);
      $value = trim($parts[1]);
      putenv("$name=$value");
      $_ENV[$name] = $value;
      $_SERVER[$name] = $value;
    }
  }
}

$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';
$db_name = getenv('DB_NAME') ?: 'jobportal';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
