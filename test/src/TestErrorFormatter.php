<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Test;

use PHPStan\Command\AnalysisResult;
use PHPStan\Command\ErrorFormatter\ErrorFormatter as PhpstanErrorFormatter;
use Symfony\Component\Console\Style\OutputStyle;

class TestErrorFormatter implements PhpstanErrorFormatter
{
    public function formatErrors(
        AnalysisResult $analysisResult,
        OutputStyle $style
    ): int {
        if (!$analysisResult->hasErrors()) {
            return 0;
        }

        foreach ($analysisResult->getNotFileSpecificErrors() as $notFileSpecificError) {
            $style->writeln($notFileSpecificError);
        }

        foreach ($analysisResult->getFileSpecificErrors() as $fileSpecificError) {
            $style->writeln($fileSpecificError->getMessage());
        }

        return 1;
    }
}
