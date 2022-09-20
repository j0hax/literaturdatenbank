# literatur-datenbank

[![Docker](https://github.com/j0hax/literatur-datenbank/actions/workflows/docker-publish.yml/badge.svg)](https://github.com/j0hax/literatur-datenbank/actions/workflows/docker-publish.yml)
[![CouchDB](https://img.shields.io/badge/Apache%20CouchDB-EA2328?logo=apachecouchdb)](https://couchdb.apache.org/)

Neue literaturdatenbank für das Institut für Kontinuumsmechanik

## Ziele

- Verbesserung der existieren Datenbank
  - Modernisierung von Design
  - Einsatz von neuer Datenbanksoftware
- Anlehnung an den [FAIR-Prinzipien](FAIR.md)

## Installation

<details>
<summary>Docker (empfohlen)</summary>
<br>

Die Literaturdatenbank samt Datenbank wird am einfachsten mit [Docker Compose](https://docs.docker.com/compose/) installiert. Eine [Referenzdatei](/docker-compose.yml) ist vorhanden.

</details>

<details>
<summary>Manuell</summary>
<br>

Die Webapplikation basiert auf den traditionellen LAMP-Stack.

Nachdem das Repository geklont wurde muss noch `composer install` ausgeführt werden, um alle Abhängigkeiten zu installieren.

</details>
