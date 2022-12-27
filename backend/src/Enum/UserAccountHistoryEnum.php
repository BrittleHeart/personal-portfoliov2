<?php

namespace App\Enum;

use Spatie\Enum\Enum;

class UserAccountHistoryEnum extends Enum
{
    /**
     * @return array<string, int>
     */
    public static function values(): array
    {
        return [
            'updatedPassword' => 0,
            'updatedUsername' => 2,
            'grantedRole' => 3,
            'revokedRole' => 4,
            'banned' => 5,
            'unbanned' => 6,
            'deleted' => 7,
        ];
    }
}