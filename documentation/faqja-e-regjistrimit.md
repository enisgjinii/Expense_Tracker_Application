# Faqja e Regjistrimit

Ky skript është një formë regjistrimi me HTML dhe PHP. Ky lejon përdoruesin të regjistrohet duke shënuar adresën e email-it, fjalëkalimin dhe ngarkuar një foto profilin. Skripti përdor Argon2 për të hash fjalëkalimin dhe lejon përdoruesin të ngarkojë një foto profilin.

#### Përshkrimi i Këtij Skripti

1. **HTML dhe CSS:** Përdor HTML për të krijuar formën e regjistrimit dhe CSS për të përmirësuar pamjen e saj.
2. **Forma e Regjistrimit:** Forma përfshin fushat për adresën e email-it, fjalëkalimin dhe një fushë për ngarkimin e fotos së profilit.
3. **PHP për Regjistrim:** Nëse forma është dorëzuar (metoda POST), skripti merr vlerat nga formulari dhe kryen disa verifikime. Pastaj, skripti ngarkon foton e profilit në një direktori dhe regjistron përdoruesin në bazën e të dhënave.
4. **Verifikimi i Fotografisë:** Skripti kontrollon nëse file-i i ngarkuar është një imazh i vërtetë duke përdorur funksionin `getimagesize`.
5. **Verifikimi i Formateve të Lejuara:** Skripti verifikon nëse formatti i file-it të ngarkuar është në një nga formattet e lejuara (jpg, jpeg, png, gif).
6. **Verifikimi dhe Ngarkimi i Fotos:** Nëse të gjitha verifikimet janë në rregull, skripti ngarkon foton në një direktori dhe merr rrugën e fotos për ta ruajtur në bazën e të dhënave.
7. **Lidhja me Bazën e të Dhënave:** Për të lidhur me bazën e të dhënave, skripti përdor variablat për hostin e bazës së të dhënave, përdoruesin, fjalëkalimin dhe emrin e bazës së të dhënave.
8. **Query SQL për Regjistrim:** Skripti përdor një query SQL për të shtuar përdoruesin në tabelën "users".
9. **Afishimi i Suksesit ose Gabimit:** Skripti shfaq një mesazh suksesi ose një mesazh gabimi pasi të ketë kryer operacionin e regjistrimit.

#### Kujdes:

1. **Sigurohuni që të përdorni PDO ose prepared statements:** Kjo do të ndihmojë në parandalimin e sulmeve të injektimit të SQL.
2. **Mundësojni HTTPS:** Nëse jeni duke punuar në një aplikacion të vërtetë, sigurohuni që të përdorni një lidhje të sigurt duke e mundësuar protokollin HTTPS.
3. **Validoni dhe filtrojeni të dhënat:** Sigurohuni që të validoni dhe filtrojini të gjitha të dhënat e pranuara nga përdoruesi për të parandaluar vulnerabilitetet e mundshme të sigurisë.

Ky skript është një bazë e mirë për një faqe regjistrimi dhe mund të përdoret si një pikë e fillimit për zhvillimin e një aplikacioni më të madh.
