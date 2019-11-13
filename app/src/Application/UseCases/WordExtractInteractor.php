<?php


namespace TKuni\PhpWordExtractor\Application\UseCases;



use TKuni\PhpWordExtractor\Application\UseCases\interfaces\IWordExtractInteractor;
use TKuni\PhpWordExtractor\Domain\ObjectValues\Sentence;
use TKuni\PhpWordExtractor\Domain\Services\TextSummarizer;

class WordExtractInteractor implements IWordExtractInteractor
{
    public function extract(array $sentences): array
    {
        $counter = new TextSummarizer();
        $ngrams = [];

        for ($length = 1; $length <= 5; $length++) {
            foreach ($sentences as $sentence) {
                $ngrams += (new Sentence($sentence))->split($length);

                foreach ($ngrams as $ngram) {
                    $counter->addNGram($ngram);
                }
            }
        }

        return $counter->summary();
    }
}