<?php


namespace TKuni\PhpWordExtractor\Domain\ObjectValues;


class SummaryDetail
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
     * @var SentenceList
     */
    private $sentenceList;
    /**
     * @var float
     */
    private $appearanceRate;

    public function __construct(string $chars, int $count, SentenceList $sentenceList, float $appearanceRate)
    {
        $this->chars          = $chars;
        $this->count          = $count;
        $this->sentenceList   = $sentenceList;
        $this->appearanceRate = $appearanceRate;
    }

    public function increment(Sentence $sentence) : SummaryDetail
    {
        return new self(
            $this->chars,
            $this->count + 1,
            $this->sentenceList->addSentenceIfNotExist($sentence),
            $this->appearanceRate
        );
    }

    public function calcAppearanceRate(int $totalSentenceCount) : SummaryDetail
    {
        return new self(
            $this->chars,
            $this->count,
            $this->sentenceList,
            count($this->sentenceList) / $totalSentenceCount
        );
    }

    public function chars() {
        return $this->chars;
    }

    public function count() {
        return $this->count;
    }

    public function sentenceList() {
        return $this->sentenceList;
    }

    public function appearanceRate() {
        return $this->appearanceRate;
    }
}