<?php

namespace TKuni\PhpCliAppTemplate;

use Dotenv\Dotenv;
use Opis\Container\Container;
use Psr\Log\LoggerInterface;
use SimpleLog\Logger;
use TKuni\PhpCliAppTemplate\Infrastructure\interfaces\IExampleRepository;
use TKuni\PhpCliAppTemplate\Infrastructure\ExampleRepository;
use TKuni\PhpWordExtractor\Application\UseCases\interfaces\IWordExtractInteractor;
use TKuni\PhpWordExtractor\Application\UseCases\WordExtractInteractor;
use TKuni\PhpWordExtractor\Domain\Services\interfaces\ITextCounter;
use TKuni\PhpWordExtractor\Domain\Services\TextSummarizer;

require_once __DIR__ . '/vendor/autoload.php';

#
# Load dot env file.
#
Dotenv::create(__DIR__)->safeLoad();

#
# Setup DI Container.
#
$app = new Container();

$app->bind('app', App::class);
$app->singleton(LoggerInterface::class, function() {
    $logger = new Logger('/dev/null', 'default');
    $logger->setPostHook(function($log_line) {
        // send to another logger if you want.
    });
    $logger->setOutput(true);
    return $logger;
});
$app->bind(IExampleRepository::class, ExampleRepository::class);
$app->bind(IWordExtractInteractor::class, WordExtractInteractor::class);
$app->bind(ITextCounter::class, TextSummarizer::class);