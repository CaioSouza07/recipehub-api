<?php

declare(strict_types=1);

namespace App\Http;

class JsonResponse
{
    public static function json(int $status, string $message, array $data = []): string
    {
        header('Content-Type: application/json');
        http_response_code($status);

        return json_encode([
            'status' => $status,
            'message' => $message,
            'time_response' => time(),
            'datetime_response' => date('Y-m-d H:i:s'),
            'data' => $data
        ], JSON_UNESCAPED_UNICODE);
    }
}
