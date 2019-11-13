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

        $this->assertCount(5, $actual);

        $this->assertEquals("うえ", $actual[0]->chars());
        $this->assertEquals(2, $actual[0]->count());
        $this->assertCount(1, $actual[0]->sentenceList());

        $this->assertEquals("えお", $actual[1]->chars());
        $this->assertEquals(2, $actual[1]->count());
        $this->assertCount(1, $actual[1]->sentenceList());

        $this->assertEquals("あい", $actual[2]->chars());
        $this->assertEquals(1, $actual[2]->count());
        $this->assertCount(1, $actual[2]->sentenceList());

        $this->assertEquals("いう", $actual[3]->chars());
        $this->assertEquals(1, $actual[3]->count());
        $this->assertCount(1, $actual[3]->sentenceList());

        $this->assertEquals("おう", $actual[4]->chars());
        $this->assertEquals(1, $actual[4]->count());
        $this->assertCount(1, $actual[4]->sentenceList());
    }
}