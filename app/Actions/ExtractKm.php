<?php
declare(strict_types=1);

namespace App\Actions;

final readonly class ExtractKm
{
    public static function execute(string $text): string
    {
        if (preg_match('/(\d[\d\s]*)\s*км/iu', $text, $matches))
            return preg_replace('/\s+/', '', $matches[1]);

        return '';
    }
}