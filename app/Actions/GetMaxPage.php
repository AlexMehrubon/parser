<?php
declare(strict_types=1);

namespace App\Actions;

use Symfony\Component\DomCrawler\Crawler;

final readonly class GetMaxPage
{
    public static function execute(string $html): int
    {
        $crawler = new Crawler($html);


        $pageLinks = $crawler->filter('.boxPages .pageNumber a');


        $pageNumbers = $pageLinks->each(function (Crawler $node) {
            return (int)trim($node->text());
        });

        return !empty($pageNumbers) ? max($pageNumbers) : 1;
    }
}