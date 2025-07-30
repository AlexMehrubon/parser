<?php
declare(strict_types=1);

namespace App\Actions;

use Symfony\Component\DomCrawler\Crawler;
use Throwable;

final readonly class GetVin
{
    public static function execute(int $id): string
    {
        try {
            $html = GetHTML::execute("https://autopapa.ge/get_vin/ru/$id");
            $crawler = new Crawler($html);
            return $crawler->filter('#vin-code-td')->count() ? $crawler->filter('#vin-code-td')->text() : "";
        } catch (Throwable) {
            return "";
        }
    }
}