<?php
declare(strict_types=1);

namespace Example;

use Monolog\Logger;
use Monolog\Level;
use Monolog\Handler\StreamHandler;

$log = new Logger('demo');
$log->pushHandler(new StreamHandler('php://stdout', Level::Info));
$log->info('Trivy test project is running.');
echo "Ahoj, Trivy!\n";
