#!/usr/bin/env php
<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require __DIR__ . '/../config/bootstrap.php';

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);
