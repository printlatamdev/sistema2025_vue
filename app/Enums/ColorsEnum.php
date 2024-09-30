<?php

namespace App\Enums;

enum ColorsEnum: string
{
    case Blanco = 'Blanco';
    case BlancoMate = 'Blanco mate';
    case BlancoNegro = 'Blanco negro';
    case BlancoGloss = 'Blanco gloss';
    case BlancoKraft = 'Blanco kraft';
    case Transparente = 'Transparente';
    case TransparenteMate = 'Transparente mate';
    case TransparenceGloss = 'Transparente gloss';
    case Satin = 'Satín';
    case Brillante = 'Brillante';
    case Rojo = 'Rojo';
    case Negro = 'Negro';
    case Mate = 'Mate';
    case Azul = 'Azul';
    case Plateado = 'Plateado';
    case Gris = 'Gris';
    case Amarillo = 'Amarillo';


    /**public function getLabel()
    {
        return match ($this) {
            self::Blanco => 'Blanco',
        };
    } */
}