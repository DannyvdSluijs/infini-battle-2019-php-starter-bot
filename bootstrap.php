<?php declare(strict_types=1);

use Bot\Bot;
use Bot\Strategy;

include  __DIR__ . '/vendor/autoload.php';

Bot::start(new Strategy());
