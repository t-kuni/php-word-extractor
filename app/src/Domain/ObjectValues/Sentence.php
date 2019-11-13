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

    public function body() {
        return $this->body;
    }

    public function split(int $length): array
    {
        $ngrams = [];

        $tailIdx = mb_strlen($this->body) - $length;

        for ($i = 0; $i <= $tailIdx; $i++) {
            $chars     = mb_substr($this->body, $i, $length);
            $originIdx = $i;

            $ngrams[] = new NGram($chars, $length, $this, $originIdx);
        }

        return $ngrams;
    }
}