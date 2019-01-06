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
            'hyphen+beast'   => ['beast', Separator::HYPHEN(), 'east-bay',],
            'hyphen+dough'   => ['dough', Separator::HYPHEN(), 'ough-day',],
            'hyphen+happy'   => ['happy', Separator::HYPHEN(), 'appy-hay',],
            'hyphen+star'    => ['star', Separator::HYPHEN(), 'ar-stay'],
            'hyphen+three'   => ['three', Separator::HYPHEN(), 'ee-thray',],
            'hyphen+rhythms' => ['rhythms', Separator::HYPHEN(), 'rhythmsay'],

            'apostrof+beast'   => ['beast', Separator::APOSTROF(), 'east\'bay'],
            'apostrof+dough'   => ['dough', Separator::APOSTROF(), 'ough\'day'],
            'apostrof+happy'   => ['happy', Separator::APOSTROF(), 'appy\'hay'],
            'apostrof+star'    => ['star', Separator::APOSTROF(), 'ar\'stay'],
            'apostrof+three'   => ['three', Separator::APOSTROF(), 'ee\'thray'],
            'apostrof+rhythms' => ['rhythms', Separator::APOSTROF(), 'rhythmsay'],

            'beast'   => ['beast', Separator::NONE(), 'eastbay'],
            'dough'   => ['dough', Separator::NONE(), 'oughday'],
            'happy'   => ['happy', Separator::NONE(), 'appyhay'],
            'star'    => ['star', Separator::NONE(), 'arstay'],
            'three'   => ['three', Separator::NONE(), 'eethray'],
            'rhythms' => ['rhythms', Separator::NONE(), 'rhythmsay'],

            'hyphen+question'   => ['question', Separator::HYPHEN(), 'uestion-qay'],
            'apostrof+question' => ['question', Separator::APOSTROF(), 'uestion\'qay'],
            'question'          => ['question', Separator::NONE(), 'uestionqay'],
        ];
    }

    /**
     * @dataProvider provideTestWordsStartedWithConsonantClusterParams
     */
    public function testWordsStartedWithConsonantCluster(string $world, Separator $separator, string $expected): void
    {
        $this->translator->setSeparator($separator);
        $actualHyphen = $this->translator->translateWorld($world);
        $this->assertEquals($expected, $actualHyphen);
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
            'eagle 9'  => ['eagle', Separator::NONE(), SuffixExtension::Y(), 'eagleyay'],
            'eagle 10' => ['eagle', Separator::NONE(), SuffixExtension::W(), 'eagleway'],
            'eagle 11' => ['eagle', Separator::NONE(), SuffixExtension::H(), 'eaglehay'],
            'eagle 12' => ['eagle', Separator::NONE(), SuffixExtension::NONE(), 'eagleay'],
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
        $actual = $this->translator->translateWorld($world);
        $this->assertEquals($expected, $actual);
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
        $this->translator->translateWorld($notWorld);
    }

    public function provideTestCorrectLetterCaseParams(): array
    {
        return [
            'first Upper'   => ['Beast', 'East-bay',],
            'first lower'   => ['dOUGH', 'ough-day',],
            'lowercase'     => ['happy', 'appy-hay',],
            'tEeNGirLLcase' => ['qUesTiOn', 'uestion-qay',],
            'uppercase'     => ['STAR', 'Ar-stay',],
            'TEeNGirLLcase' => ['ThReE', 'Ee-thray',],
        ];
    }

    /**
     * @dataProvider provideTestCorrectLetterCaseParams
     */
    public function testCorrectLetterCase(string $englishWorld, string $expected): void
    {

        $actualApostrof = $this->translator->translateWorld($englishWorld);
        $this->assertEquals($expected, $actualApostrof);
    }

    public function provideText(): array
    {
        return [
            'one world'  => ['Beast', 'East-bay',],
            'one world2' => ['dOUGH', 'ough-day',],
            [
                'Enter the English text here that you want translated into
                 Pig Latin. This is accomplished via this HTML document and
                 accompanying JavaScript program. Note that hyphenated words
                 are treated as two words. Words may consist of alphabetic
                 characters only (A-Z and a-z). All punctuation, numerals,
                 symbols and whitespace are not modified.',

                'Enter-way e-thay English-way ext-tay ere-hay at-thay ou-yay ant-way anslated-tray into-way
                 Ig-pay Atin-lay. Is-thay is-way accomplished-way ia-vay is-thay Htmlay ocument-day and-way
                 accompanying-way Avascript-jay ogram-pray. Ote-nay at-thay enated-hyphay ords-way
                 are-way eated-tray as-way o-tway ords-way. Ords-way ay-may onsist-cay of-way alphabetic-way
                 aracters-chay only-way (A-way-Zay and-way a-way-zay). All-way unctuation-pay, umerals-nay,
                 ols-symbay and-way itespace-whay are-way ot-nay odified-may.',
            ],
            [
                'One morning, when Gregor Samsa woke from troubled dreams,
                 he found himself transformed in his bed into a horrible vermin.
                 He lay on his armour-like back,
                 and if he lifted his head a little he could se',

                'One-way orning-may, en-whay Egor-gray Amsa-say oke-way om-fray oubled-tray eams-dray,
                 e-hay ound-fay imself-hay ansformed-tray in-way is-hay ed-bay into-way a-way orrible-hay ermin-vay.
                 E-hay ay-lay on-way is-hay armour-way-ike-lay ack-bay,
                 and-way if-way e-hay ifted-lay is-hay ead-hay a-way ittle-lay e-hay ould-cay e-say'
            ]
        ];
    }

    /**
     * @dataProvider provideText
     */
    public function testText(string $englishWorld, string $expected): void
    {
        $this->translator->setSuffixExtension(SuffixExtension::W());
        $actualApostrof = $this->translator->translate($englishWorld);
        $this->assertEquals($expected, $actualApostrof);
    }
}
