<?php


namespace TKuni\PhpWordExtractor\Domain\Services;


use TKuni\PhpWordExtractor\Domain\ObjectValues\NGram;
use TKuni\PhpWordExtractor\Domain\Services\interfaces\ITextCounter;

class TextCounter implements ITextCounter
{
    private $summary = [];
    private $indexes = [];

    public function addNGram(NGram $ngram) {
        $chars = $ngram->chars();
        $indexes = $this->indexes;

        $index = null;
        if (array_key_exists($chars, $indexes)) {
            $index = $indexes[$chars];
        }

        if ($index !== null) {
            $this->summary[$index]['count']++;
        } else {
            $newIndex = count($this->summary);
            $this->indexes[$chars] = $newIndex;
            $this->summary[$newIndex] = [
                'chars' => $chars,
                'count' => 1,
            ];
        }
    }

    public function summary() {
        $summary = $this->summary;

        usort($summary, function($a, $b) {
            if ($b['count'] - $a['count'] !== 0) {
                return $b['count'] - $a['count'];
            } else {
                return strnatcmp($a['chars'], $b['chars']);
            }
        });

        return $summary;
    }
}