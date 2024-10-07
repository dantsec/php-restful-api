<?php

namespace RestfulAPI\Utils;

class HttpResponseHandler
{
    /**
     * Sends a JSON response with a specified status code and message.
     *
     * @param int $statusCode The HTTP status code to be sent in the response.
     * @param string|array $message The message or data to be included in the response body.
     *
     * @return void
     */
    public static function sendResponse(int $statusCode, string|array $message): void
    {
        header("Content-Type: application/json");

        http_response_code($statusCode);

        $response = [
            'status' => $statusCode,
            is_array($message) ? 'data' : 'message' => $message
        ];

        echo json_encode($response);

        exit();
    }
}
