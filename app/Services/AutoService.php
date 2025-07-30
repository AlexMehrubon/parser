<?php
declare(strict_types=1);

namespace App\Services;

use App\Actions\ExtractDetailFields;
use App\Actions\FormatFields;

final class AutoService
{
    public static function processDetailHtml(string $detailHtml): array
    {
        $fields = ExtractDetailFields::execute($detailHtml);

        return FormatFields::execute($fields);
    }
}