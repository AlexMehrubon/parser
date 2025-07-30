<?php
declare(strict_types=1);

namespace App\Actions;

final readonly class FormatFields
{
    public static function execute(array $fields): array
    {
        foreach ($fields as $key => $value) {
            if ($key !== 'images' && is_string($value)) {
                $fields[$key] = trim($value);
            }
        }

        $fields['year'] = preg_replace('/\D/', '', $fields['year']);
        $fields['power'] = preg_replace('/\D/', '', $fields['power']);
        $fields['mileage'] = ExtractKm::execute($fields['mileage']);


        $fieldsToClean = ['body_type', 'condition', 'engine_type', 'drive_type', 'doors', 'seats', 'color'];
        foreach ($fieldsToClean as $field) {
            if (isset($fields[$field])) {
                $fields[$field] = preg_replace('/^[^:]+:\s*/', '', $fields[$field]);
            }
        }
        return $fields;
    }
}