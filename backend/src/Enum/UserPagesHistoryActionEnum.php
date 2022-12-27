<?php

namespace App\Enum;

use Spatie\Enum\Enum;

/**
 * @method static self changedName()
 * @method static self published()
 * @method static self unpublished()
 * @method static self changedTheme()
 * @method static self madeEditable()
 * @method static self madeUneditable()
 * @method static self changedDescription()
 * @method static self changedUrl()
 */
class UserPagesHistoryActionEnum extends Enum
{
    /**
     * @return array<string, int>
     */
    public static function values(): array
    {
        return [
            'changedName' => 1,
            'published' => 2,
            'unpublished' => 3,
            'changedTheme' => 4,
            'madeEditable' => 5,
            'madeUneditable' => 6,
            'changedDescription' => 7,
            'changedUrl' => 8
        ];
    }
}
