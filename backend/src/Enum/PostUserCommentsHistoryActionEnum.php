<?php

namespace App\Enum;

use Spatie\Enum\Enum;

/**
 * @method static self submit()
 * @method static self approve()
 * @method static self reject()
 * @method static self delete()
 * @method static self edit()
 */
class PostUserCommentsHistoryActionEnum extends Enum
{
    /**
     * @return array<string, int>
     */
    public static function values(): array
    {
        return [
            'submit' => 1,
            'approve' => 2,
            'reject' => 3,
            'delete' => 4,
            'edit' => 5,
        ];
    }
}
