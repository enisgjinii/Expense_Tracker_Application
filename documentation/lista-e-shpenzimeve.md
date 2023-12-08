---
description: Dokumentacioni për Listën e Shpenzimeve
---

# Lista e shpenzimeve

**Tabela e Përmbajtjes**

1. **Hyrje**
2. **Stili i Trupit HTML**
3. **CSS Stilet**
4. **Logjika e Serverit PHP**
5. **Lidhja me Bazën e të Dhënave**
6. **Shfaqja e Shpenzimeve**
7. **Funksionet JavaScript**
8. **Përfundimi**

#### 1. Hyrje

Ky dokumentacion ofron një përshkrim të faqes së listës së shpenzimeve. Aplikacioni është projektuar për të shfaqur dhe menaxhuar shpenzimet nga një bazë e të dhënave, duke përfshirë veprimet si shikimi, ndryshimi, dhe fshirja e shpenzimeve.

#### 2. Stili i Trupit HTML

Struktura HTML e faqes përfshin lidhjen me stilet CSS, përdorimin e ikonave Font Awesome dhe përfshirjen e librarive të tjera të nevojshme. Po ashtu, përfshin kodin PHP për përpunimin e të dhënave nga baza.

#### 3. CSS Stilet

Stilet CSS përcaktojnë pamjen vizuale të listës së shpenzimeve. Stilet përfshijnë dizajn të thjeshtë, animacione, dhe reagim të përgjigjshëm për madhësinë e ekranit.

#### 4. Logjika e Serverit PHP

PHP përdoret për të kërkuar dhe shfaqur shpenzimet nga baza e të dhënave. Për çdo shpenzim, ofrohet mundësia për shikim, ndryshim, dhe fshirje.

#### 5. Lidhja me Bazën e të Dhënave

Aplikacioni presupozon një lidhje me bazën e të dhënave përmes një skedari të posaçëm të lidhjes (`conn.php`). Ky skedar përdoret për të vendosur lidhjen me bazën e të dhënave dhe mundëson përpunimin e të dhënave nga aplikacioni.

#### 6. Shfaqja e Shpenzimeve

Pjesa kryesore e faqes shfaq shpenzimet nga baza e të dhënave. Për çdo shpenzim, tregohet një tabelë me informacionin e tij, duke përfshirë një kolonë për veprimet e mundshme: shikim, ndryshim, dhe fshirje.

#### 7. Funksionet JavaScript

Në faqen HTML, përdoret JavaScript për të menaxhuar veprimet e përdoruesit. Funksionet përfshijnë shfaqjen dhe fshehjen e një forme për ndryshimin e shpenzimit, përditësimin e shënimeve të formës së ndryshimit, dhe fshirjen e një shpenzimi duke përdorur një dritare konfirmimi nga SweetAlert2.

#### 8. Përfundimi

Ky dokumentacion ka për qëllim të ofrojë një kuptim të hollësishëm për strukturën dhe funksionalitetin e faqes së listës së shpenzimeve. Me këtë informacion, është e mundur të kuptohet si funksionon aplikacioni dhe si mund të ndryshohen, fshihen, dhe shikohen shpenzimet nga një bazë e të dhënave.

***

{% tabs %}
{% tab title="GitHub Link" %}
Linku i kodit

{% embed url="https://github.com/enisgjinii/Expense_Tracker_Application/blob/main/expenses.php" fullWidth="true" %}
expenses.php
{% endembed %}
{% endtab %}

{% tab title="Video shpjegimi" %}
Linku i video shpjegimit

{% embed url="https://drive.google.com/file/d/1ugKF8Iy84gxVnJmQq6V7V4wMtHPJ-GPI/view?usp=drive_link" %}
Shpjegimi i faqes expenses.php ( Lista e shpenzimeve )
{% endembed %}
{% endtab %}
{% endtabs %}

