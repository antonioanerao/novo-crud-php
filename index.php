<?php

include_once('vendor/autoload.php');

use App\Models\Usuario;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$usuario = new Usuario();

foreach($usuario->selectAll('users') as $u) {
    echo $u->name . '<br>';
}

try {
    $usuario->insert('users', [
        'name' => 'hahamu brasil',
        'email' => 'hahqa@mu.com',
        'password' => 'supersenha'
    ]);
} catch (Exception $e) {
    echo $e->getMessage();
}