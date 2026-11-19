<?php

namespace App\Enums;

// Enum con los roles de usuario: admin (gestiona la web) o arrunta (usuario normal que compra entradas).
enum Rola: string{
    case Admin = 'admin';
    case Arrunta = 'arrunta';
}