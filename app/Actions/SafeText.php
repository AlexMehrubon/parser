<?php
declare(strict_types=1);

namespace App\Actions;

use Symfony\Component\DomCrawler\Crawler;

final readonly class SafeText
{
    public static function execute(Crawler $crawler, string $selector): string
    {
        $node = $crawler->filter($selector);
        return $node->count() ? $node->text() : '';
    }
}