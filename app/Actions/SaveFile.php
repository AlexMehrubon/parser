<?php
declare(strict_types=1);

namespace App\Actions;

final readonly class SaveFile
{
    public static function execute(array $data): void
    {
        date_default_timezone_set('Europe/Moscow');

        $json = json_encode($data, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $fileName = date('Y-m-d_H-i-s') . '.json';
        file_put_contents(__DIR__ . "/../public/json/$fileName", $json);
    }
}