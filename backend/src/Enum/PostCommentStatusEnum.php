<?php

namespace App\Enum;

use Spatie\Enum\Enum;

/**
 * @method static self submitted()
 * @method static self approved()
 * @method static self rejected()
 */
class PostCommentStatusEnum extends Enum
{
    /**
     * @return array<string, int>
     */
    public static function values(): array
    {
        return [
            'submitted' => 1,
            'approved' => 2,
            'rejected' => 3,
        ];
    }
}