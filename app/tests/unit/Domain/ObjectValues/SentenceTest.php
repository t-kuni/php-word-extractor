<?php

namespace Tests\unit\Application\UseCases;


use PHPUnit\Framework\TestCase;
use TKuni\PhpWordExtractor\Domain\ObjectValues\Sentence;

class SentenceTest extends TestCase
{
    /**
     * @test
     */
    public function split_()
    {
        $body = "あいうえお";

        $sentence = new Sentence($body);

        $actual = $sentence->split(2);
        $this->assertCount(4, $actual);
        $this->assertEquals("あい", $actual[0]->chars());
        $this->assertEquals("いう", $actual[1]->chars());
        $this->assertEquals("うえ", $actual[2]->chars());
        $this->assertEquals("えお", $actual[3]->chars());

        $actual = $sentence->split(3);
        $this->assertCount(3, $actual);
        $this->assertEquals("あいう", $actual[0]->chars());
        $this->assertEquals("いうえ", $actual[1]->chars());
        $this->assertEquals("うえお", $actual[2]->chars());
    }
}