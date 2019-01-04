<?php
/**
 * @project  PigLatin
 * @author   Adam Mátl <matla@matla.cz>
 * @date     3.1.19
 * @encoding UTF-8
 * @file     PigLatinTranslator.php
 */
declare(strict_types=1);

namespace matla\PigLatin;

/**
 * PigLatinTranslator slouží k překladu řetězců z angličtiny do Pig Latin
 *
 * @package matla\PigLatin
 */
class PigLatinTranslator
{
    private const SUFFIX = 'ay';

    /**
     * @var Separator
     */
    private $separator;

    /**
     * @var SuffixExtension
     */
    private $suffixExtension;

    public function __construct()
    {
        $this->separator = Separator::HYPHEN();
        $this->suffixExtension = SuffixExtension::H();
    }

    /**
     * Nastaví rozšíření suffixu. Pro informaci kdy je použito @see self::translate()
     *
     * @param SuffixExtension $suffixExtension
     */
    public function setSuffixExtension(SuffixExtension $suffixExtension): void
    {
        $this->suffixExtension = $suffixExtension;
    }

    /**
     * Nastaví oddělovač přidané přípony
     *
     * @see self::translate()
     *
     * @param Separator $separator
     */
    public function setSeparator(Separator $separator): void
    {
        $this->separator = $separator;
    }

    /**
     * Pig latin je tvořen tak že, najdeme ve slově nejdelší prefix tvořený samými souhláskami
     * a tento prefix přesuneme na konec slova a přidáme sufix ay.
     * Například:
     *  - beast → east-bay
     *  - dough → ough-day
     *  - happy → appy-hay
     *  - question → estion-quay
     *  - star → ar-stay
     *  - three → ee-thray
     *
     * pokud je délka takovéhoto prefixu rovna nule, může být sufix rozšířen o souhlásku na začátku
     * například:
     *  - eagle → eagle'yay, eagle'way nebo eagle'hay.
     *
     * Toto rozšíření je defaultně _h_,jde však nastavit pomocí __PigLatinTranslator::setSuffixExtension()__.
     *
     * Aby byl umožněn jednoznačný překlad zpět do angličtiny je typicky sufix oddělen pomlčkou nebo apostrofem.
     * například _ayspray_ by jink mohlo být přeloženo jako _spray_ i _prays_
     * Tento oddělovač je defaultně pomlčka, jde však nastavit pomocí __PigLatinTranslator::setSeparator()__.
     *
     * Tato implementace předpokládá, že Y(y) a W(w) jsou souhlásky a ignoruje tzv. nečtené souhlásky (silent consonant)
     * s kterými se jinak při překladu pracuje jako se samohláskami z důvodu toho,
     * že tyto výjimky nelze z psané podoby rozeznat.
     *
     * V případě onom, že vstup začíná velkým písmenem, překlad bude též začínat velkým písmenem a zbytek bode malým,
     * jinak překlad bude vše vráceno jako malé.
     *
     * @throws /DomainException pokud vstup není identifikován jako slovo
     *
     * @todo implement
     *
     * @param string $input slovo([a-Z+]) v anglickém jazyce, které má být přeloženo
     *
     * @return string překlad
     */
    public function translate(string $input): string
    {
        return '';
    }
}

// PigLatinTranslator.php End
