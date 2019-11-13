<?php


namespace TKuni\PhpWordExtractor\Domain\ObjectValues;


class NGram
{
    /**
     * @var string
     */
    private $chars;
    /**
     * @var int
     */
    private $length;
    /**
     * @var Sentence
     */
    private $sentence;
    /**
     * @var int
     */
    private $originIdx;

    public function __construct(string $chars, int $length, Sentence $sentence, int $originIdx)
    {
        $this->chars     = $chars;
        $this->length    = $length;
        $this->sentence  = $sentence;
        $this->originIdx = $originIdx;
    }

    public function chars()
    {
        return $this->chars;
    }

    public function sentence() : Sentence
    {
        return $this->sentence;
    }
}