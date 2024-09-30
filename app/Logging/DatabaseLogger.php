<?php

namespace App\Logging;

use Monolog\Logger;
use App\Logging\Handler\DatabaseHandler;

class DatabaseLogger
{
  /**
   * Create a custom Monolog instance.
   *
   * @param  array  $config
   * @return \Monolog\Logger
   */
  public function __invoke(array $config)
  {
    $logger = new Logger('database');

    $logger->pushHandler(new DatabaseHandler());

    return $logger;
  }
}
