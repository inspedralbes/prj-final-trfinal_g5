# Projecte Transversal: FitHub

## Taula de continguts
1. [Descripció](#descripció)
2. [Esquema Carpetes](#esquema-carpetes)
3. [Integrants](#integrants)
4. [Gestor de tasques](#gestor-de-tasques)
5. [Prototip Gràfic](#prototip-grafic)
6. [URL de Producció](#url-de-producció)
7. [Estat](#estat)
8. [Manual d'Instal·lació / Desplegament](#manual-dinstallació--desplegament)
9. [Api Laravel Fithub](#api-laravel-fithub)
   


## Descripció
Aquest projecte té com a objectiu desenvolupar un projecte final que tracta d'una aplicacio de gimnas que amb un chatIA et fa les rutines i dietes i assesorament de gimnas

## Esquema Carpetes
Aquest es el nostre esquema de carpetes:
- .github
- back
- doc
- front
- seguiment
- vendor
- docker-compose.yml
- README.md

## Integrants
- Aitor Barreiro
- Alex Delgado
- Eric Rodrigez
- Miquel Barceló

## Gestor de Tasques
Utilitzem Taiga com a gestor de tasques. Podeu accedir-hi a través del següent enllaç: [Taiga](https://tree.taiga.io/project/a21aledelfel-tr_final_grupo_5/timeline)

## Prototip Gràfic
Per a la visualització del prototip gràfic del projecte, podeu accedir a penpot: [Penpot](https://design.penpot.app/#/view/93d0ad32-dfe5-8194-8003-d196a1776455?page-id=93d0ad32-dfe5-8194-8003-d196a1776456&section=interactions&frame-id=c57b177c-d2d1-8023-8003-d1c548b8c65b&index=0&share-id=93d0ad32-dfe5-8194-8003-d1ca957c9e03)

## URL de Producció
Aqui es troba la url de l'aplicació [Producció](https://fithub.daw.inspedralbes.cat/)

## Estat
El projecte es troba en una fase de desenvolupament. S'ha configurat l'entorn Docker per a desplegar-lo fàcilment en mode de desenvolupament.

## Manual d'Instal·lació / Desplegament
El nostre projecte es facil d'instal·lar i de desplegar. Només has de fer un git clone del nostre repositori i despres utilitzar docker
### Docker & Docker Compose
Per desplegar el projecte executeu lo següent comanda de Docker Compose:

```bash
docker login
```

```bash
docker-compose up

```
