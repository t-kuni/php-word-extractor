<?php

namespace Tests\unit\Domain\Services;

use PHPUnit\Framework\TestCase;
use TKuni\PhpWordExtractor\Domain\ObjectValues\NGram;
use TKuni\PhpWordExtractor\Domain\ObjectValues\Sentence;
use TKuni\PhpWordExtractor\Domain\Services\interfaces\ITextCounter;

class TextSummarizerTest extends TestCase
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
            [
                'chars'  => "うえ",
                'count' => 2,
            ],
            [
                'chars'  => "えお",
                'count' => 2,
            ],
            [
                'chars'  => "あい",
                'count' => 1,
            ],
            [
                'chars'  => "いう",
                'count' => 1,
            ],
            [
                'chars'  => "おう",
                'count' => 1
            ],
        ];

        $this->assertEquals($expect, $actual);
    }
}