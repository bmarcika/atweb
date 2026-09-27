## FIXABLE

- hírfolyam szerűség
- egy rólunk menü: ami az egyesület, a történet és a KAPCSOLAT-ot hoz egy menüpont alá
- először az elnökségről, majkd az egyesüelt tagok / profil fotó / 120 szavas bemutatkozás?
- naptár az eseményekről

- a jelentkezés gombot inaktiválni ha az SQL programs táblában a jegyek elfogytak (yes helyett 'no' van)

- sajtó tartalom fordítása
- rezidenciához az eszközökről leírást fotót

- archíválás /  
  - galéria 
  - előadások, koncertek felsorolása
  - az eddigi rezidenciák felsorolása
  - kiállításokkal?

-gyik grafika

## FIXED HISTORY
20250209 General style  // tábormeghirdetéshez grafikai frissítések
20250209 SAJTO          //Teóékat Tilos rádióról betenni
20250116 Insta          // INsta widget a főoldalra
20231230 SQL, PHP       // kettő organizert is kiírjon(később az egy organizerhez rendelt progikat is) -> junction table
20231229 SQL            // program tábla átrendezése oszlopok kivétele
20231229 PHP, SQL       // NKA támogatja a progarmleírás végén
20231227 HTTP           // OG metatagek és képmegjelenítés
20231227 PHP            // ha a jelentkezés gombra kattint, és nincs FORMS URL az SQL-ben írja ki hogy hamarosan lehet jeletnkezni
20231227 PHP            // a képek a TIXA mappából töltődnek a programleírások alá(100x650-es felbontás az 1:1 helyett)
20231220 PHP            // organizer fotó link a honlapra //application-details.php
20231219 CSS            // mobilnézet - 
20231219 CSS            // mobilon a menu szetesik - gyenlő oszlopok és sorok kicsiben és nagyban
20231219 CSS            // fixálni hogy a táborvezetőbemutatkozó mobilon jól nézzen ki
20231217 PHP            // lang button fixed config.php printLanguage function
20231217 PHP            // jelentkezési űrlapokból 1-1 oszlop az adatbázisban
20231217 PHP            // házirend két nyelvű linkelni a TIXÁ-hoz // ezt elengedtem: munkavédelmi leírások(default egy általános)
20231217 PHP            // $absolute_path-olást rendbetenni -> index.php-n lehet relatív a többinél meg mehet a /test
20231216 PHP            // application-details.php earlybirdöt csak ha még van akkor mutassa, vagy valahogy húzza át
20231216 PHP            // klikkelhető képek
20231215 PHP            // felvinni Domiékat az SQL-be
20231215 PHP            // jelentkezés aloldal általános - page alapján
20231215 PHP            // Pazo gondolatai, hogy az árazások ne a főoldalon legyenek 
20241213 PHP, SQL       // details_<subpagename>, subtitle_<subpagename>
20241213 PHP            // images files handling reorg
20241213 PHP            // index.php,config.php - one indexpage with Sessions
20241213 PHP            // index.php absolute path with variable
20241213 SQL            // modify programID to readable and descriptional URL froma
20241213 PHP            // navbar.php // fix menu references with new page structure
20241213 PHP            // navbar.php // keeping the subite when changing the lang 
20241213 PHP            // file reorg
20241213 CSS            // fixed height of a col row(when just text, no pics)
20241213 CSS            // circle pictures
20241212 PHP            // upcoming.php // earlybird startDate minus 3 months
20241212 SQL            // translate table // főoldal képgrafika angol-magyar szövegezet
20241212 PHP            // sortolja kezdődátum dátumszerint


## IMAGES
Online-crop: https://www.befunky.com/create/crop-photo/
Prjoects avatar:
	Size: 1000x1000 a TIXA(1000x650) miatt, amiből 500x500px a látszó avatar
  

## PHP dynamism
Images are named after the programs.ProgramID, and loaded automatically from the image folder.
