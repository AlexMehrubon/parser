<?php
declare(strict_types=1);

namespace App\Actions;

use Symfony\Component\DomCrawler\Crawler;

final readonly class ExtractDetailFields
{
    public static function execute(string $html): array
    {
        $detailCrawler = new Crawler($html);
        $dirtyId = SafeAttr::execute($detailCrawler, 'div[id^="car"]', 'id');
        $id = preg_match('/car(\d+)/', $dirtyId, $m) ? (int)$m[1] : null;

        return [
            'year' => SafeText::execute($detailCrawler, '.lineInfo:contains("Год выпуска") .nameInfoObject'),
            'body_type' => SafeText::execute($detailCrawler, '.lineInfo:contains("Тип кузова") .nameInfoObject'),
            'condition' => SafeText::execute($detailCrawler, '.lineInfo:contains("Состояние") .nameInfoObject'),
            'engine_type' => SafeText::execute($detailCrawler, '.lineInfo:contains("Тип двигателя") .nameInfoObject'),
            'power' => SafeText::execute($detailCrawler, '.lineInfo:contains("Mощность") .nameInfoObject'),
            'mileage' => SafeText::execute($detailCrawler, '.lineInfo:contains("Пробег") .nameInfoObject'),
            'drive_type' => SafeText::execute($detailCrawler, '.lineInfo:contains("Привод") .nameInfoObject'),
            'doors' => SafeText::execute($detailCrawler, '.lineInfo:contains("Двери") .nameInfoObject'),
            'seats' => SafeText::execute($detailCrawler, '.lineInfo:contains("Количество мест") .nameInfoObject'),
            'color' => SafeText::execute($detailCrawler, '.lineInfo:contains("Цвет кузова") .nameInfoObject'),
            'price' => SafeText::execute($detailCrawler, '.priceObject'),
            'vin' => $id ? GetVin::execute($id) : "",
            'description' => SafeText::execute($detailCrawler, '.comment-seller'),
            'preview_image' => SafeAttr::execute($detailCrawler, '#mainImg img', 'src'),
            'images' => $detailCrawler->filter('.hidden-galler-images')->each(function (Crawler $node) {
                return $node->attr('href');
            }),
            'id' => $id
        ];
    }
}