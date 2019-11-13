<?php


namespace TKuni\PhpWordExtractor\Domain\ObjectValues;


class Sentence
{
    /**
     * @var string
     */
    private $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    public function split(int $length): array
    {
        $ngrams = [];

        $tailIdx = mb_strlen($this->body) - $length;

        for ($i = 0; $i <= $tailIdx; $i++) {
            $chars     = mb_substr($this->body, $i, $length);
            $origin    = $this->body;
            $originIdx = $i;

            $ngrams[] = new NGram($chars, $length, $origin, $originIdx);
        }

        return $ngrams;
    }
}