<?php


namespace TKuni\PhpWordExtractor\Application\UseCases;



use TKuni\PhpWordExtractor\Application\UseCases\interfaces\IWordExtractInteractor;
use TKuni\PhpWordExtractor\Domain\ObjectValues\Sentence;
use TKuni\PhpWordExtractor\Domain\Services\TextCounter;

class WordExtractInteractor implements IWordExtractInteractor
{
    public function extract(array $sentences): array
    {
        $counter = new TextCounter();

        foreach ($sentences as $sentence) {
            $ngrams = (new Sentence($sentence))->split(3);

            foreach ($ngrams as $ngram) {
                $counter->addNGram($ngram);
            }
        }

        return $counter->summary();
    }
}