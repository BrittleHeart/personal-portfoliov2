<?php

namespace App\Enum;

use Spatie\Enum\Enum;

/**
 * @method static self draft()
 * @method static self published()
 * @method static self archived()
 */
class PostStatusEnum extends Enum
{
    /**
     * @return array<string, int>
     */
    public static function values(): array
    {
        return [
            'draft' => 1,
            'published' => 2,
            'archived' => 3,
        ];
    }
}
