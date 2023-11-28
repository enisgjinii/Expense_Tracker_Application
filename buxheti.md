---
description: Dokumentacioni për Regjistruesin e Buxhetit
---

# Buxheti

**Tabela e Përmbajtjes**

1. **Hyrje**
2. **Stili i Trupit HTML**
3. **CSS Stilet**
4. **Logjika e Serverit PHP**
5. **Lidhja me Bazën e të Dhënave**
6. **Shfaqja e Te Ardhurave dhe Shpenzimeve**
7. **Përmbledhja e Buxhetit**
8. **Vizualizimi me Chart.js**
9. **Përfundimi**

#### 1. Hyrje

Ky dokumentacion ofron një përshkrim të faqes së regjistruesit të buxhetit. Aplikacioni është projektuar për të shfaqur dhe menaxhuar të ardhurat, shpenzimet dhe për të ofruar një përmbledhje të buxhetit duke përdorur një grafik me Chart.js.

#### 2. Stili i Trupit HTML

Struktura HTML e faqes përfshin lidhjen me stilet CSS, përdorimin e ikonave Font Awesome dhe përfshirjen e librarive të tjera të nevojshme. Pjesa kryesore është e ndarë në seksione për të ardhurat, shpenzimet, te ardhurat, dhe përmbledhjen e buxhetit.

#### 3. CSS Stilet

Stilet CSS përcaktojnë pamjen vizuale të faqes së regjistruesit të buxhetit. Stilet përfshijnë dizajn të thjeshtë dhe animacione të buta për përmbajtjen.

#### 4. Logjika e Serverit PHP

PHP përdoret për të kryer operacione në server për të përpunuar të ardhurat dhe për të shfaqur informacionin e shpenzimeve dhe të ardhurave.

#### 5. Lidhja me Bazën e të Dhënave

Aplikacioni presupozon një lidhje me bazën e të dhënave përmes një skedari të posaçëm të lidhjes (`conn.php`). Ky skedar përdoret për të vendosur lidhjen me bazën e të dhënave dhe mundëson përpunimin e të dhënave nga aplikacioni.

#### 6. Shfaqja e Te Ardhurave dhe Shpenzimeve

Te ardhurat dhe shpenzimet shfaqen në faqe nëpërmjet tabelave. Përdoruesi ka mundësinë të shtojë te ardhura dhe të shikojë historinë e shpenzimeve.

#### 7. Përmbledhja e Buxhetit

Në seksionin e përmbledhjes së buxhetit, përcaktohet totali i të ardhurave, totali i shpenzimeve, dhe përmbledhja e buxhetit.

#### 8. Vizualizimi me Chart.js

Përdoret librarinë Chart.js për të vizualizuar totalin e të ardhurave dhe shpenzimeve nëpërmjet një grafiku të shiritave. Për këtë qëllim, përdoren dy ngjyrat të ndryshme për të dalluar të ardhurat nga shpenzimet.

#### 9. Përfundimi

Ky dokumentacion ka për qëllim të ofrojë një kuptim të hollësishëm për strukturën dhe funksionalitetin e faqes së regjistruesit të buxhetit. Me këtë informacion, është e mundur të kuptohet si funksionon aplikacioni dhe si mund të shtohen të ardhurat, të shikohen shpenzimet, dhe të shohet një përmbledhje e buxhetit.
