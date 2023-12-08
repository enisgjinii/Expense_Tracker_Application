---
description: 'Emri i fajllit : "process_expense.php"'
---

# Skripta për Shtimin e Shpenzimit

Ky skript PHP është përgjegjës për shtimin e shpenzimeve në bazën e të dhënave. Nëse kërkesa është një POST request, ai merr vlerat nga variablja POST dhe i shton ato në tabelën "expenses" të bazës së të dhënave.

#### Përshkrimi i Këtij Skripti

1. **include 'conn.php':** Përfshin skriptin e lidhjes me bazën e të dhënave. Sigurohet që lidhja me bazën e të dhënave është e disponueshme.
2. **if ($\_SERVER\['REQUEST\_METHOD'] === 'POST'):** Kontrollon nëse kërkesa është një POST request.
3. **Marrja e vlerave:** Përmban një bllok kod që merr vlerat e nevojshme nga variablat POST, siç janë 'amount', 'category', dhe 'payment\_type'.
4. **Ekzekutimi i SQL:** Përdor këto vlera për të krijuar një query SQL për shtimin e shpenzimit në tabelën "expenses".
5. **Verifikimi i ekzekutimit të query:** Kontrollon nëse query është ekzekutuar me sukses. Nëse po, shfaq një mesazh konfirmimi; nëse jo, shfaq një mesazh gabimi me detaje të gabimit.
6. **Mbyllja e lidhjes me bazën e të dhënave:** Pas përfundimit të operacionit, mbyll lidhjen me bazën e të dhënave për të evituar përdorimin e panevojshëm të burimeve.

#### Përfundimi

Ky skript është një pjesë e procesit të shtimit të shpenzimeve në aplikacionin tuaj dhe siguron një mënyrë të përshtatshme për të manipuluar të dhënat në bazën e të dhënave. Ju mund ta përdorni dhe modifikoni atë bazuar në nevojat specifike të aplikacionit tuaj.
