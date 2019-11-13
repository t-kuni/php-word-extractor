<?php

namespace TKuni\PhpWordExtractor\Application\UseCases\interfaces;

interface IWordExtractInteractor
{
    public function extract(array $sentences): array;
}