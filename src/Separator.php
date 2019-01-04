<?php
/**
 * @project  PigLatin
 * @author   Adam Mátl <matla@matla.cz>
 * @date     3.1.19
 * @encoding UTF-8
 * @brief    Separator.php
 */
declare(strict_types=1);

namespace matla\PigLatin;

use MyCLabs\Enum\Enum;

/**
 * @method static Separator HYPHEN()
 * @method static Separator APOSTROF()
 * @method static Separator NONE()
 */
class Separator extends Enum
{
    private const HYPHEN = '-';
    private const APOSTROF = '\'';
    private const NONE = '';
}

// Separator.php End
