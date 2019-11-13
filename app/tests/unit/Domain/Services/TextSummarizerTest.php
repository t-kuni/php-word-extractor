<?php

namespace Tests\unit\Domain\Services;

use PHPUnit\Framework\TestCase;
use TKuni\PhpWordExtractor\Domain\ObjectValues\NGram;
use TKuni\PhpWordExtractor\Domain\ObjectValues\Sentence;
use TKuni\PhpWordExtractor\Domain\Services\interfaces\ITextCounter;
use TKuni\PhpWordExtractor\Domain\Services\TextSummarizer;

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

        $counter = new TextSummarizer(1);
        foreach ($ngrams as $ngram) {
            $counter->addNGram($ngram);
        }
        $actual = $counter->summary();

        $this->assertCount(5, $actual);

        $this->assertEquals("うえ", $actual[0]->chars());
        $this->assertEquals(2, $actual[0]->count());
        $this->assertCount(1, $actual[0]->sentenceList());
        $this->assertEquals(1, $actual[0]->appearanceRate());

        $this->assertEquals("えお", $actual[1]->chars());
        $this->assertEquals(2, $actual[1]->count());
        $this->assertCount(1, $actual[1]->sentenceList());
        $this->assertEquals(1, $actual[1]->appearanceRate());

        $this->assertEquals("あい", $actual[2]->chars());
        $this->assertEquals(1, $actual[2]->count());
        $this->assertCount(1, $actual[2]->sentenceList());
        $this->assertEquals(1, $actual[2]->appearanceRate());

        $this->assertEquals("いう", $actual[3]->chars());
        $this->assertEquals(1, $actual[3]->count());
        $this->assertCount(1, $actual[3]->sentenceList());
        $this->assertEquals(1, $actual[3]->appearanceRate());

        $this->assertEquals("おう", $actual[4]->chars());
        $this->assertEquals(1, $actual[4]->count());
        $this->assertCount(1, $actual[4]->sentenceList());
        $this->assertEquals(1, $actual[4]->appearanceRate());
    }
}