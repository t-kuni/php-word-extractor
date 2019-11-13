<?php


namespace TKuni\PhpWordExtractor\Application\UseCases;



use TKuni\PhpWordExtractor\Application\UseCases\interfaces\IWordExtractInteractor;
use TKuni\PhpWordExtractor\Domain\ObjectValues\Sentence;
use TKuni\PhpWordExtractor\Domain\ObjectValues\SummaryDetail;
use TKuni\PhpWordExtractor\Domain\Services\TextSummarizer;

class WordExtractInteractor implements IWordExtractInteractor
{
    public function extract(array $sentences): array
    {
        $counter = new TextSummarizer(count($sentences));

        for ($length = 1; $length <= 10; $length++) {

            foreach ($sentences as $sentence) {
                $ngrams = (new Sentence($sentence))->split($length);

                foreach ($ngrams as $ngram) {
                    $counter->addNGram($ngram);
                }
            }
        }

        $summary = $counter->summary();

        $formatted = array_map(function(SummaryDetail $detail) {
            return [
                'chars' => $detail->chars(),
                'count' => $detail->count(),
                'rate' => $detail->appearanceRate(),
            ];
        }, $summary->toArray());

        return $formatted;
    }
}