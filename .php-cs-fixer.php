<?php

$finder =
    PhpCsFixer\Finder::create()
        ->in(__DIR__)
        ->notPath('storage/*')
        ->name('*.php')
        ->notName('*.blade.php')
        ->ignoreDotFiles(true)
        ->ignoreVCS(true);

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@PSR12' => true,
])
    ->setFinder($finder);
