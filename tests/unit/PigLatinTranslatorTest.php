<?php
/**
 * @project  PigLatin
 * @author   Adam Mátl <matla@matla.cz>
 * @date     3.1.19
 * @encoding UTF-8
 * @brief    PigLatinTranslatorTest.phpTest.php
 */

namespace matla\PigLatin;

use PHPUnit\Framework\TestCase;

class PigLatinTranslatorTest extends TestCase
{
    public function testWordsStartedWithConsonantCluster(): void
    {
        $examples = [
            'beast'    => ['east-bay', 'east\'bay'],
            'dough'    => ['ough-day', 'ough\'day'],
            'happy'    => ['appy-hay', 'appy\'hay'],
            'question' => ['estion-quay', 'estion\'quay'],
            'star'     => ['ar-stay', 'ar\'stay'],
            'three'    => ['ee-thray', 'ee\'thray'],
        ];

        $translator = new PigLatinTranslator();

        foreach ($examples as $input => [$expectedHyphen, $expectedApostrof]) {
            $translator->setSeparator(Separator::HYPHEN());
            $actualHyphen = $translator->translate($input);
            $this->assertEquals($actualHyphen, $expectedHyphen);

            $translator->setSeparator(Separator::APOSTROF());
            $actualApostrof = $translator->translate($input);
            $this->assertEquals($actualApostrof, $expectedApostrof);
        }
    }

    public function testWordsStartedWithVowel(): void
    {
        $examples = [
            'eagle' => ['eagle\'yay', 'eagle\'way', 'eagle\'hay', 'eagle-yay', 'eagle-way', 'eagle-hay'],
        ];

        $translator = new PigLatinTranslator();
        foreach ($examples as $input => $possibleAnswers) {
            $actual = $translator->translate($input);
            $this->assertContains($actual, $possibleAnswers);
        }
    }

   
}
