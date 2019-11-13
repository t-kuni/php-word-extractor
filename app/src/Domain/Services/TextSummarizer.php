<?php


namespace TKuni\PhpWordExtractor\Domain\Services;


use TKuni\PhpWordExtractor\Domain\ObjectValues\NGram;
use TKuni\PhpWordExtractor\Domain\ObjectValues\SentenceList;
use TKuni\PhpWordExtractor\Domain\ObjectValues\Summary;
use TKuni\PhpWordExtractor\Domain\ObjectValues\SummaryDetail;
use TKuni\PhpWordExtractor\Domain\Services\interfaces\ITextCounter;

class TextSummarizer implements ITextCounter
{
    /**
     * @var Summary
     */
    private $summary;

    private $indexes = [];

    public function __construct()
    {
        $this->summary = new Summary();
    }

    public function addNGram(NGram $ngram) {
        $chars = $ngram->chars();
        $indexes = $this->indexes;

        $index = null;
        if (array_key_exists($chars, $indexes)) {
            $index = $indexes[$chars];
        }

        if ($index !== null) {
            $this->summary[$index] = $this->summary[$index]->increment($ngram->sentence(), 1);
        } else {
            $newIndex = count($this->summary);
            $this->indexes[$chars] = $newIndex;
            $this->summary[$newIndex] = new SummaryDetail(
                $chars,
                1,
                new SentenceList([$ngram->sentence()]),
                1
            );
        }
    }

    public function summary() {
        $summary = $this->summary->toArray();

        usort($summary, function(SummaryDetail $a, SummaryDetail $b) {
            if ($b->count() - $a->count() !== 0) {
                return $b->count() - $a->count();
            } else {
                return strnatcmp($a->chars(), $b->chars());
            }
        });

        return $summary;
    }
}