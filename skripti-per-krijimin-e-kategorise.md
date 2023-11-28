# Skripti për Krijimin e Kategorisë

Ky skript PHP është përgjegjës për krijimin e një kategorie të re në tabelën "categories" të bazës së të dhënave. Nëse kërkesa është një POST request, ai merr vlerën e re të kategorisë nga variabla POST dhe e shton atë në tabelën e përcaktuar.

#### Përshkrimi i Këtij Skripti

1. **include 'conn.php':** Përfshin skriptin e lidhjes me bazën e të dhënave. Sigurohet që lidhja me bazën e të dhënave është e disponueshme.
2. **if ($\_SERVER\['REQUEST\_METHOD'] === 'POST'):** Kontrollon nëse kërkesa është një POST request.
3. **Marrja e vlerave:** Përmban një bllok kod që merr vlerën e re të kategorisë nga variabla POST, e cila është 'new\_category'.
4. **Ekzekutimi i SQL:** Përdor këtë vlerë për të krijuar një query SQL për shtimin e kategorisë në tabelën "categories".
5. **Verifikimi i ekzekutimit të query:** Kontrollon nëse query është ekzekutuar me sukses. Nëse po, shfaq një mesazh konfirmimi; nëse jo, shfaq një mesazh gabimi me detaje të gabimit.
6. **Mbyllja e lidhjes me bazën e të dhënave:** Pas përfundimit të operacionit, mbyll lidhjen me bazën e të dhënave për të evituar përdorimin e panevojshëm të burimeve.

#### Përfundimi

Ky skript është një pjesë e procesit të krijimit të kategorisë në bazën e të dhënave dhe siguron një mënyrë të përshtatshme për të manipuluar të dhënat. Ju mund ta përdorni dhe modifikoni atë bazuar në nevojat specifike të aplikacionit tuaj.
