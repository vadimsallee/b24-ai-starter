<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

// Подавляем вывод ошибок от OpenTelemetry SDK во время unit-тестов
// OpenTelemetry пытается отправить spans в OTel Collector, который не запущен во время unit-тестов
// Это приводит к большому количеству error логов, которые не являются фактическими ошибками тестов
putenv('OTEL_LOG_LEVEL=none');

if (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
}
