<?php

$finder =
    PhpCsFixer\Finder::create()
        ->in(__DIR__)
        ->exclude(['bootstrap', 'node_modules', 'storage', 'vendor'])
        ->name('*.php')
        ->notName('*.blade.php')
        ->ignoreDotFiles(true)
        ->ignoreVCS(true);

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@PSR12' => true,
])
    ->setFinder($finder);
