<?php
declare(strict_types=1);

namespace App\Services;

use App\Actions\GetHTML;

final class GuzzleService
{
    public static string $baseUrl = "https://autopapa.ge/";

    public static function getHTML(string $url): string
    {
        return GetHTML::execute(self::$baseUrl . $url);
    }

    public static function getDetailPageHTML(string $url): string
    {
        return GetHTML::execute(self::$baseUrl . $url);
    }
}