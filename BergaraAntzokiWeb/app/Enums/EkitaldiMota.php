<?php
namespace App\Enums;

// Enum con los tipos de evento posibles (cine, teatro, charla, concierto). Así solo se pueden guardar estos valores en la BD.
enum EkitaldiMota: string{
    case Zinema = 'zinema';
    case Antzezlana = 'antzezlana';
    case Hitzaldia = 'hitzaldia';
    case Kontzertua = 'kontzertua';
}
