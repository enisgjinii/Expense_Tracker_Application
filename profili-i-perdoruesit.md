# Profili i Përdoruesit

Ky skript është një faqe PHP/HTML që shfaq informacionin e profilit të një përdoruesi. Kjo përfshin të dhënat e përdoruesit të cilat janë të ruajtura në një tabelë të bazës së të dhënave. Për më tepër, ky skript kërkon se përdoruesi duhet të jetë autentifikuar (të ketë bërë login), dhe nëse nuk është, atëherë përdoruesi do të ridrejtohet në faqen e login.

#### Përshkrimi i Këtij Skripti

1. **Session Start:** Fillon një sesion për të mbajtur informacionin e sesionit të përdoruesit.
2. **Include 'conn.php':** Përfshin skriptin e lidhjes me bazën e të dhënave.
3. **User Authentication Check:** Kontrollon nëse përdoruesi është autentifikuar duke e verifikuar sesionin ose mekanizmin tjetër të autentifikimit. Nëse përdoruesi nuk është autentifikuar, ridrejtohet në faqen e login dhe skripti mbyllet.
4. **Retrieve User Profile:** Merr informacionin e profilit të përdoruesit nga tabela "users" në bazën e të dhënave duke përdorur id e përdoruesit që është ruajtur në sesion.
5. **HTML Head:** Pjesa e head përmban informacione të përgjithshme për faqen HTML.
6. **HTML Body:** Pjesa e body përmban përmbajtjen kryesore të faqes. Shfaq informacionin e profilit të përdoruesit, duke përfshirë adresën e email-it dhe një foto profili (nëse është e disponueshme).
7. **Link për Editimin e Profilit:** Shtohet një link që drejton përdoruesin në një faqe ku mund të redaktojë profilin e tij.
8. **HTML Style:** Pjesa e stilit përmban disa rregulla për të përmirësuar pamjen e faqes. Përfshin pamjen e div-it të profil-it, butonin e redaktimit, dhe stilet e tjera të nevojshme.

#### Përfundimi

Ky skript është një pjesë e një sistemi më të madh të menaxhimit të përdoruesve në një faqe PHP/HTML. Shfaq informacionin e përdoruesit dhe ofron një mundësi për të ndryshuar informacionin e profilit.
