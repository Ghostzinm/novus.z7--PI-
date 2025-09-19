<?php

$_ENV = parse_ini_file('.env');

// Conecta ao banco de dados
$dsn = "mysql:dbname={$_ENV['BANCO']};host={$_ENV['HOST']}";
$usuario = $_ENV['USUARIO'];
$senha = $_ENV['SENHA'];
$conn = new PDO($dsn, $usuario, $senha);
