<?php
declare(strict_types=1);

namespace App\Actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;


final readonly class SendRequest
{

    /**
     * @throws GuzzleException
     */
    public static function execute(string $url): ResponseInterface
    {
        return new Client()->request('GET', $url, [
            'headers' => [
            ]
        ]);
    }
}