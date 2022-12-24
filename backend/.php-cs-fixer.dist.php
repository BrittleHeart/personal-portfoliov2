<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
    ->exclude('public')
    ->exclude('vendor')
    ->exclude('config')
    ->exclude('bin')
    ->exclude('docker')
    ->exclude('translations')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
    ])
    ->setFinder($finder)
;
