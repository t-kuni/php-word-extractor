<?php

namespace Tests\unit\Domain\Services;

use PHPUnit\Framework\TestCase;
use TKuni\PhpWordExtractor\Domain\ObjectValues\NGram;
use TKuni\PhpWordExtractor\Domain\ObjectValues\Sentence;
use TKuni\PhpWordExtractor\Domain\Services\interfaces\ITextCounter;

class TextCounterTest extends TestCase
{
    /**
     * @test
     */
    public function getSummary_()
    {
        $origin   = "あいうえおうえお";
        $sentence = new Sentence($origin);
        $ngrams   = $sentence->split(2);

        $counter = app()->make(ITextCounter::class);
        foreach ($ngrams as $ngram) {
            $counter->addNGram($ngram);
        }
        $actual = $counter->summary();

        $expect = [
            "あい" => 1,
            "いう" => 1,
            "うえ" => 2,
            "えお" => 2,
            "おう" => 1
        ];

        $this->assertEquals($expect, $actual);
    }
}