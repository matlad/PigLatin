PigLatin
=========
[![Build Status](https://travis-ci.com/matlad/PigLatin.svg?branch=master)](https://travis-ci.com/matlad/PigLatin)

Pig latin je tvořen tak že, najdeme ve slově nejdelší prefix tvořený samými souhláskami
a tento prefix přesuneme na konec slova a přidáme sufix ay.
Například:
 - beast → east-bay
 - dough → ough-day
 - happy → appy-hay
 - question → estion-quay
 - star → ar-stay
 - three → ee-thray

pokud je délka takovéhoto prefixu rovna nule, může být sufix rozšířen o souhlásku na začátku
například:
 - eagle → eagle'yay, eagle'way nebo eagle'hay.

Toto rozšíření je defaultně _h_,jde však nastavit pomocí __PigLatinTranslator::setSuffixExtension()__.

Aby byl umožněn jednoznačný překlad zpět do angličtiny je typicky sufix oddělen pomlčkou nebo apostrofem.
například _ayspray_ by jink mohlo být přeloženo jako _spray_ i _prays_
Tento oddělovač je defaultně pomlčka, jde však nastavit pomocí __PigLatinTranslator::setSeparator()__.

Tato implementace pro zjednodušení předpokládá je samohlásky jsou vždy právě a,e,i,o,u a ignoruje tzv. nečtené souhlásky (silent consonant)
s kterými se jinak při překladu pracuje jako se samohláskami z důvodu toho,
že tyto případy nelze z psané podoby rozeznat.

V případě onom, že vstup začíná velkým písmenem, překlad bude též začínat velkým písmenem a zbytek bode malým,
jinak překlad bude vše vráceno jako malé.

## Authors
* Adam Mátl <code@matla.cz>
