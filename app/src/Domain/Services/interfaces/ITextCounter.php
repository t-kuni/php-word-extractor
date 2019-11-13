<?php

namespace TKuni\PhpWordExtractor\Domain\Services\interfaces;

use TKuni\PhpWordExtractor\Domain\ObjectValues\NGram;

interface ITextCounter
{
    public function addNGram(NGram $ngram);

    public function summary();
}