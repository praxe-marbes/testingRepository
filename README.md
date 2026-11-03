# Vulnerable demo app

Testovací repozitář pro ověření funkčnosti **Trivy Web Scanneru**. Obsahuje pět malých projektů v různých jazycích, které **záměrně používají zastaralé knihovny se známými zranitelnostmi**.

> ⚠️ Projekt slouží výhradně k testování skenerů závislostí. Aplikace nespouštěj na serveru dostupném z internetu a knihovny z něj nepoužívej v jiných projektech.

## Struktura

| Složka | Ekosystém | Soubor, který čte Trivy | Obsah |
|---|---|---|---|
| `frontend-node/` | JavaScript (npm) | `package-lock.json` | Express, lodash, axios, minimist, jsonwebtoken, celkem 68 balíčků včetně tranzitivních |
| `backend-java/` | Java (Maven) | `pom.xml` | Log4j, commons-text, jackson-databind, commons-collections, SnakeYAML |
| `web-php/` | PHP (Composer) | `composer.lock` | Guzzle, Twig a jejich závislosti, celkem 11 balíčků |
| `tools-python/` | Python (pip) | `requirements.txt` | Django, Flask, Jinja2, PyYAML, requests, urllib3, Pillow |
| `service-go/` | Go | `go.mod` | Gin, jwt-go, golang.org/x/text, yaml.v2 |

## Nahrání do Git repozitáře

Na GitHubu (nebo GitLabu) vytvoř nový prázdný repozitář, například `vulnerable-demo-app`, bez README a .gitignore. Pak ve složce projektu spusť:

```bash
git init
git add .
git commit -m "Testovací projekt pro Trivy Web Scanner"
git branch -M main
git remote add origin https://github.com/TVUJ-UCET/vulnerable-demo-app.git
git push -u origin main
```

Pokud chceš otestovat i soukromé repozitáře, vytvoř repozitář jako **Private**. Při prvním skenu se pak otevře okno Git Credential Manageru pro přihlášení.

GitHub ti po nahrání pravděpodobně začne posílat upozornění **Dependabot alerts**. To je v pořádku a potvrzuje to, že zranitelnosti jsou skutečné. Upozornění můžeš vypnout v nastavení repozitáře v sekci *Security*.

## Co by měl skener najít

V záložce **Soubory** by mělo být pět souborů z tabulky výše. Počet komponent bude zhruba 100 až 110 (u Mavenu Trivy doplní tranzitivní závislosti z Maven Central). Zranitelností bude několik desítek až přes sto, přesný počet se mění s každou aktualizací databáze.

Mezi nalezenými by určitě neměly chybět tyto známé zranitelnosti:

| Komponenta | Verze | Zranitelnost | Poznámka |
|---|---|---|---|
| log4j-core | 2.14.1 | CVE-2021-44228 | Log4Shell, kritická |
| commons-text | 1.9 | CVE-2022-42889 | Text4Shell, kritická |
| commons-collections | 3.2.1 | CVE-2015-7501 | deserializace |
| snakeyaml | 1.26 | CVE-2022-1471 | deserializace |
| minimist | 1.2.5 | CVE-2021-44906 | prototype pollution |
| lodash | 4.17.20 | CVE-2021-23337 | command injection |
| axios | 0.21.1 | CVE-2021-3749 | ReDoS |
| qs | 6.7.0 | CVE-2022-24999 | tranzitivní závislost Expressu |
| path-to-regexp | 0.1.7 | CVE-2024-45296 | tranzitivní závislost Expressu |
| guzzlehttp/psr7 | 2.1.0 | CVE-2022-24775 | tranzitivní závislost Guzzle |
| twig/twig | v3.4.2 | CVE-2022-39261 | |
| PyYAML | 5.3.1 | CVE-2020-14343 | kritická |
| urllib3 | 1.26.4 | CVE-2021-33503 | |
| github.com/dgrijalva/jwt-go | v3.2.0 | CVE-2020-26160 | |
| github.com/gin-gonic/gin | v1.6.3 | CVE-2020-28483 | |

Závažnost (kritická, vysoká…) se může mírně lišit podle zdroje, ze kterého ji Trivy převezme.

## Nápady na další testy

Smaž `frontend-node/package-lock.json`, commitni a skenuj znovu. Komponenty z npm zmizí, což ukazuje, proč jsou lockfily důležité. Pak v `package.json` aktualizuj `lodash` na `4.17.21`, spusť `npm install --package-lock-only` a ověř, že zranitelnosti lodashe zmizely. Pro test parametru *větev* můžeš vytvořit větev `fixed` s aktualizovanými verzemi a porovnat oba skeny.
