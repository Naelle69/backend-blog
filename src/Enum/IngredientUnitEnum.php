<?php

namespace App\Enum;

enum IngredientUnitEnum: string
{
    // Solides
    case G = 'g';
    case KG = 'kg';
    case PIECE = 'pièce';

    // Liquides
    case ML = 'ml';
    case L = 'L';

    // Unités de cuisine
    case C_SPOON = 'cuillère à soupe';
    case T_SPOON = 'cuillère à café';
    case PINCH = 'pincée';
    case TASSE = 'tasse';
    case VERRE = 'verre';
    case QUANTITE = 'quantité au choix';
}
