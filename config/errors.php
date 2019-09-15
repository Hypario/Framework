<?php

use Framework\Exception\KnownExceptionResolver;

$resolver = $app->getContainer()->get(KnownExceptionResolver::class);

define('ERROR_DEFAULT', -1);
define('NOT_FOUND', 404);

$resolver->register(ERROR_DEFAULT, "Une erreur inattendu c'est produite, contacter le webmaster si le problème persiste.");
$resolver->register(NOT_FOUND, "404 Not Found.");
