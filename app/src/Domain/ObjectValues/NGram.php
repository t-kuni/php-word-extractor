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
    private $origin;
    /**
     * @var int
     */
    private $originIdx;

    public function __construct(string $chars, int $length, Sentence $origin, int $originIdx)
    {
        $this->chars     = $chars;
        $this->length    = $length;
        $this->origin    = $origin;
        $this->originIdx = $originIdx;
    }

    public function chars()
    {
        return $this->chars;
    }
}