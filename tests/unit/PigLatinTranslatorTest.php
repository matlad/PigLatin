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

//In words that begin with consonant sounds, the initial consonant or consonant cluster is moved to the end
//of the word, and "ay" is added
//• beast → east-bay
//• dough → ough-day
//• happy → appy-hay
//• question → estion-quay
//• star → ar-stay
//• three → ee-thray

//In words that begin with vowel sounds or silent consonants, the syllable "ay" is added to the end of the word. In
//some dialects, to aid in pronunciation, an extra consonant is added to the beginning of the suffix; for instance,
//eagle could yield eagle'yay, eagle'way, or eagle'hay.

}
