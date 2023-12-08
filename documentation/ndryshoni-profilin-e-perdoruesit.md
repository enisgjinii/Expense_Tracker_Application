# Ndryshoni Profilin e Përdoruesit

Ky skript është një faqe PHP/HTML që lejon përdoruesin të ndryshojë informacionin e profilit të tyre. Për të bërë këtë, skripti fillon një sesion, përfshin informacionin e përdoruesit nga tabela e bazës së të dhënave, dhe lejon përdoruesin të ndryshojë adresën e email-it. Ky skript presupozon një sistem autentifikimi përdoruesi.

#### Përshkrimi i Këtij Skripti

1. **Session Start:** Fillon një sesion për të mbajtur informacionin e sesionit të përdoruesit.
2. **Include 'conn.php':** Përfshin skriptin e lidhjes me bazën e të dhënave.
3. **User Authentication Check:** Kontrollon nëse përdoruesi është autentifikuar duke e verifikuar sesionin ose mekanizmin tjetër të autentifikimit. Nëse përdoruesi nuk është autentifikuar, atëherë përdoruesi ridrejtohet në faqen e login dhe skripti mbyllet.
4. **Retrieve User Profile:** Merr informacionin e profilit të përdoruesit nga tabela "users" në bazën e të dhënave duke përdorur id e përdoruesit që është ruajtur në sesion.
5. **Handle Form Submission for Updating Profile:** Kontrollon nëse ka një dorëzim formulari (POST request) dhe, nëse po, përditëson adresën e email-it të përdoruesit në bazën e të dhënave.
6. **HTML Head:** Pjesa e head përmban informacione të përgjithshme për faqen HTML.
7. **HTML Body:** Pjesa e body përmban përmbajtjen kryesore të faqes. Shfaq formularin për të ndryshuar adresën e email-it dhe një pamje të foto profilin nëse ajo është e disponueshme.
8. **Link për Shikimin e Profilit:** Shtohet një link që drejton përdoruesin në një faqe ku mund të shohë profilin e tij.
9. **HTML Style:** Pjesa e stilit përmban disa rregulla për të përmirësuar pamjen e faqes, përfshirë stilet për formularin, butonin e ndryshimit, dhe stilet e tjera të nevojshme.

#### Përfundimi

Ky skript është një pjesë e një sistemi më të madh të menaxhimit të përdoruesve në një faqe PHP/HTML. Lejon përdoruesin të ndryshojë disa informacione në profilin e tyre.
