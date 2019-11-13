<?php


namespace TKuni\PhpWordExtractor\Domain\Services;


use TKuni\PhpWordExtractor\Domain\ObjectValues\NGram;
use TKuni\PhpWordExtractor\Domain\Services\interfaces\ITextCounter;

class TextCounter implements ITextCounter
{
    private $summary = [];

    public function addNGram(NGram $ngram) {
        $chars = $ngram->chars();

        if (array_key_exists($chars, $this->summary)) {
            $this->summary[$chars]++;
        } else {
            $this->summary[$chars] = 1;
        }
    }

    public function summary() {
        return $this->summary;
    }
}