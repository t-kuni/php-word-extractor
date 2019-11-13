<?php


namespace TKuni\PhpWordExtractor\Domain\ObjectValues;


class SummarizedElement
{
    /**
     * @var string
     */
    private $chars;
    /**
     * @var int
     */
    private $count;
    /**
     * @var array
     */
    private $sentences;
    /**
     * @var float
     */
    private $appearanceRate;

    public function __construct(string $chars, int $count, array $sentences, float $appearanceRate)
    {
        $this->chars = $chars;
        $this->count = $count;
        $this->sentences = $sentences;
        $this->appearanceRate = $appearanceRate;
    }

    public function increment($sentence)
    {
        $chars = $this->chars;
        $count = $this->count;
        $sentences = $this->sentences;
        $appearanceRate = $this->appearanceRate;
        return new self($chars, $count + 1, );
    }
}