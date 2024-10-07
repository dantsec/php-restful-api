<?php

namespace RestfulAPI\Utils;

class Env
{
    /**
     * @var string $envPath The path to the .env file.
     */
    private static $envPath = __DIR__ . '/../../config/.env';

    /**
     * Loads environment variables from the .env file.
     *
     * @return void
     */
    public static function load(): void
    {
        $variables = file(self::$envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($variables as $env) {
            if (preg_match('/^[A-Z_]+=[^\s]+$/', $env)) {
                putenv($env);
            }
        }
    }

    /**
     * Retrieves the value of an environment variable.
     *
     * @param string $envKey The key of the environment variable to retrieve.
     * @return string The value of the environment variable.
     */
    public static function get(string $envKey = ''): string
    {
        return getenv($envKey);
    }
}
