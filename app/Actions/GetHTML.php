<?php
declare(strict_types=1);

namespace App\Actions;

use GuzzleHttp\Client;

final readonly class GetHTML
{

    public static function execute(string $url): string
    {
        return new Client()->request('GET', $url, [
            'headers' => [
            ]
        ])->getBody()->getContents();
    }
}