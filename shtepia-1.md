---
description: Dokumentacioni për Regjistruesin e Shpenzimeve
---

# Shtëpia

**Tabela e Përmbajtjes**

1. **Hyrje**
2. **Struktura HTML**
3. **Stilet CSS**
4. **Logjika e Serverit PHP**
5. **Lidhja me Bazën e të Dhënave**
6. **Përpunimi i Formës së Shpenzimeve**
7. **Përpunimi i Formës së Kategorive**
8. **Shfaqja e Shpenzimeve dhe Kategorive**
9. **Dizajni Përgjigjës**
10. **Animacionet**
11. **Bibliotekat e Jashtme**
12. **Përfundimi**

#### 1. Hyrje

Ky dokumentacion ofron një pasqyrë të aplikacionit web për regjistrimin dhe menaxhimin e shpenzimeve. Aplikacioni është projektuar për të regjistruar dhe menaxhuar shpenzimet, duke përfshirë veçori si shtimi i shpenzimeve, krijimi i kategorive të reja dhe shikimi i shpenzimeve dhe kategorive.

#### 2. Struktura HTML

Struktura HTML përcakton strukturën bazë të faqes web. Përfshin seksione për shtimin e shpenzimeve, krijimin e kategorive të reja dhe shfaqjen e shpenzimeve dhe kategorive ekzistuese. Kod PHP është i ngulitur brenda HTML për të trajtuar dërgimet e formave dhe për të ndërvepruar me serverin.

#### 3. Stilet CSS

Stilet e Kaskadimit të Stileve (CSS) përcaktojnë prezantimin vizual të faqes web. Stilet përfshijnë veçori të dizajnit përgjigjës për të përshtatur strukturën për madhësi të ndryshme të ekranit. Elementët kyç përfshijnë fushat e hyrjes së formës, butonat, tabelat dhe butonat e ngarkimit të skedarëve.

#### 4. Logjika e Serverit PHP

PHP përdoret për skriptimin në server për të përpunuar dërgimet e formave dhe për të ndërvepruar me bazën e të dhënave. Kodi përfshin logjikën për shtimin e shpenzimeve dhe kategorive, trajtimin e ngarkimeve të skedarëve dhe shfaqjen e mesazheve të suksesit ose gabimeve duke përdorur bibliotekën SweetAlert2.

#### 5. Lidhja me Bazën e të Dhënave

Aplikacioni supozon një lidhje me bazën e të dhënave duke përdorur skedarin `conn.php`. Ky skedar përfshin kodin e nevojshëm për të lidhur me një bazë të dhënash ku të dhënat e shpenzimeve dhe kategorive ruhen.

#### 6. Përpunimi i Formës së Shpenzimeve

Logjika për përpunimin e formës së shpenzimeve përfshin validimin e të dhënave të formës, trajtimin e ngarkimeve të skedarëve dhe futjen e të dhënave në bazën e të dhënave. Mesazhet e suksesit dhe gabimeve shfaqen përdoruesit duke përdorur bibliotekën SweetAlert2.

#### 7. Përpunimi i Formës së Kategorive

Logjika e përpunimit të formës së kategorive përfshin shtimin e kategorive të reja në bazë të dhënash. Ngjashëm me përpunimin e formës së shpenzimeve, shfaqen mesazhe të suksesit dhe gabimeve.

#### 8. Shfaqja e Shpenzimeve dhe Kategorive

Faqja web shfaq shpenzimet dhe kategoritë ekzistuese të marra nga baza e të dhënave. Të dhënat paraqiten në tabela, dhe nëse nuk ka të dhëna, shfaqen mesazhe të përshtatshme.

#### 9. Dizajni Përgjigjës

CSS përfshin pyetësime media për dizajnin përgjigjës, siguruar që aplikacioni të jetë i bukur vizualisht dhe i përdorshëm në pajisje të ndryshme, përfshirë desktop, tableta dhe smartphone.

#### 10. Animacionet

Aplikacioni përfshin një animacion të thjeshtë fadeIn për të përmirësuar eksperiencën vizuale. Animacioni aplikohet te kontejneri kryesor për të ofruar një kalim të qetë.

#### 11. Bibliotekat e Jashtme

Aplikacioni përdor bibliotekën SweetAlert2 për të shfaqur mesazhe tërheqëse dhe përgjigjëse. Gjithashtu, përfshin bibliotekat e jashtme të fonteve dhe ikonave për stilizim.

#### 12. Përfundimi

Ky dokumentacion ofron një pasqyrë të aplikacionit për regjistrimin e shpenzimeve, duke mbështetur strukturën HTML, stilizimin CSS, logjikën e serverit PHP dhe ndërveprimin me bazën e të dhënave. Përdoruesit mund të ndërveprojnë me aplikacionin për të shtuar shpenzime, krijuar kategori të reja dhe shikuar të dhënat e regjistruara. Aplikacioni është projektuar për të qenë i përgjigjshëm dhe i bukur vizualisht, përmirësuar eksperiencën e përdoruesit.
