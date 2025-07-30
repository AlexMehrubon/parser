<?php

use App\Actions\GetMaxPage;
use App\Actions\SaveFile;
use App\Services\AutoService;
use App\Services\GuzzleService;
use Symfony\Component\DomCrawler\Crawler;

require __DIR__ . '/../vendor/autoload.php';
set_time_limit(0);
session_write_close();
$html = GuzzleService::getHTML("/ru/search?&s%5Bcondition%5D=76&s%5Bcountry_id%5D=2&s%5Blegal_status%5D%5B%5D=0&order=rating&page=1&utf8=✓");
$maxPage = GetMaxPage::execute($html);
$results = [];
for ($page = 1; $page <= $maxPage; $page++) {
    $html = GuzzleService::getHTML("/ru/search?&s%5Bcondition%5D=76&s%5Bcountry_id%5D=2&s%5Blegal_status%5D%5B%5D=0&order=rating&page=$page&utf8=✓");
    $crawler = new Crawler($html);
    $cars = $crawler->filter('.boxCatalog2');

    foreach ($cars as $car) {
        $carCrawler = new Crawler($car);

        $hrefNode = $carCrawler->filter('.titleCatalog a');
        if ($hrefNode->count() === 0)
            continue;

        $href = $hrefNode->attr('href');

        $detailHtml = GuzzleService::getDetailPageHTML($href);
        $result = AutoService::processDetailHtml($detailHtml);


        $results[] = $result;
    }

}
session_start();

SaveFile::execute($results);


