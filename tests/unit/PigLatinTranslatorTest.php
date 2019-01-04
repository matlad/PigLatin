<?php
/**
 * @project  PigLatin
 * @author   Adam Mátl <matla@matla.cz>
 * @date     3.1.19
 * @encoding UTF-8
 * @brief    PigLatinTranslatorTest.phpTest.php
 */
declare(strict_types=1);
namespace matla\PigLatin;

use PHPUnit\Framework\TestCase;

class PigLatinTranslatorTest extends TestCase
{
    /**
     * @var PigLatinTranslator
     */
    private $translator;

    protected function setUp()
    {
        $this->translator = new PigLatinTranslator();
    }

    public function provideTestWordsStartedWithConsonantClusterParams(): array
    {
        return [
            'apostrof+beast'    => ['beast', Separator::APOSTROF(), 'east\'bay'],
            'hyphen+beast'      => ['beast', Separator::HYPHEN(), 'east-bay',],
            'apostrof+dough'    => ['dough', Separator::APOSTROF(), 'ough\'day'],
            'hyphen+dough'      => ['dough', Separator::HYPHEN(), 'ough-day',],
            'apostrof+happy'    => ['happy', Separator::APOSTROF(), 'appy\'hay'],
            'hyphen+happy'      => ['happy', Separator::HYPHEN(), 'appy-hay',],
            'apostrof+question' => ['question', Separator::APOSTROF(), 'estion\'quay'],
            'hyphen+question'   => ['question', Separator::HYPHEN(), 'estion-quay'],
            'apostrof+star'     => ['star', Separator::APOSTROF(), 'ar\'stay'],
            'hyphen+star'       => ['star', Separator::HYPHEN(), 'ar-stay'],
            'apostrof+three'    => ['three', Separator::APOSTROF(), 'ee\'thray'],
            'hyphen+three'      => ['three', Separator::HYPHEN(), 'ee-thray',],
        ];
    }

    /**
     * @dataProvider provideTestWordsStartedWithConsonantClusterParams
     */
    public function testWordsStartedWithConsonantCluster(string $world, Separator $separator, string $expected): void
    {
        $this->translator->setSeparator($separator);
        $actualHyphen = $this->translator->translate($world);
        $this->assertEquals($actualHyphen, $expected);
    }

    public function provideTestWordsStartedWithVowelParams(): array
    {
        return [
            'eagle 1'  => ['eagle', Separator::APOSTROF(), SuffixExtension:: Y(), 'eagle\'yay'],
            'eagle 2'  => ['eagle', Separator::APOSTROF(), SuffixExtension:: W(), 'eagle\'way'],
            'eagle 3'  => ['eagle', Separator::APOSTROF(), SuffixExtension:: H(), 'eagle\'hay'],
            'eagle 4'  => ['eagle', Separator::APOSTROF(), SuffixExtension:: NONE(), 'eagle\'ay'],
            'eagle 5'  => ['eagle', Separator::HYPHEN(), SuffixExtension::Y(), 'eagle-yay'],
            'eagle 6'  => ['eagle', Separator::HYPHEN(), SuffixExtension::W(), 'eagle-way'],
            'eagle 7'  => ['eagle', Separator::HYPHEN(), SuffixExtension::H(), 'eagle-hay'],
            'eagle 8'  => ['eagle', Separator::HYPHEN(), SuffixExtension::NONE(), 'eagle-ay'],
            'eagle 9'  => ['eagle', Separator::NONE(), SuffixExtension::Y(), 'eagle-yay'],
            'eagle 10' => ['eagle', Separator::NONE(), SuffixExtension::W(), 'eagle-way'],
            'eagle 11' => ['eagle', Separator::NONE(), SuffixExtension::H(), 'eagle-hay'],
            'eagle 12' => ['eagle', Separator::NONE(), SuffixExtension::NONE(), 'eagle-ay'],
        ];
    }

    /**
     * @dataProvider provideTestWordsStartedWithVowelParams
     */
    public function testWordsStartedWithVowel(
        string $world,
        Separator $separator,
        SuffixExtension $suffixExtension,
        string $expected
    ): void {
        $this->translator->setSeparator($separator);
        $this->translator->setSuffixExtension($suffixExtension);
        $actual = $this->translator->translate($world);
        $this->assertEquals($actual, $expected);
    }

    public function provideTestThrowExceptionWhenInputNotWorldParams(): array
    {
        return [
            'number'      => ['563'],
            'sentence'    => ['Vice nez jedno slovo.'],
            'htmlTag'     => ['<prase>'],
            'hashTag'     => ['#prase'],
            'hyphenWorld' => ['sugar-free'],
        ];
    }

    /**
     * @dataProvider provideTestThrowExceptionWhenInputNotWorldParams
     */
    public function testThrowExceptionWhenInputNotWorld(string $notWorld): void
    {
        $this->expectException(\DomainException::class);
        $this->translator->translate($notWorld);
    }

    public function provideTestCorrectLetterCaseParams(): array
    {
        return [
            'first Upper'   => ['Beast', 'East-bay',],
            'first lower'   => ['dOUGH', 'ough-day',],
            'lowercase'     => ['happy', 'appy-hay',],
            'tEeNGirLLcase' => ['qUesTiOn', 'estion-quay',],
            'uppercase'     => ['STAR', 'Ar-stay',],
            'TEeNGirLLcase' => ['ThReE', 'Ee-thray',],
        ];
    }

    /**
     * @dataProvider provideTestCorrectLetterCaseParams
     */
    public function testCorrectLetterCase(string $englishWorld, string $expected): void
    {

        $actualApostrof = $this->translator->translate($englishWorld);
        $this->assertEquals($actualApostrof, $expected);
    }
}
