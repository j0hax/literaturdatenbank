# literatur-datenbank

[![Docker](https://github.com/j0hax/literatur-datenbank/actions/workflows/docker-publish.yml/badge.svg)](https://github.com/j0hax/literatur-datenbank/actions/workflows/docker-publish.yml)
[![CouchDB](https://img.shields.io/badge/Apache%20CouchDB-EA2328?logo=apachecouchdb)](https://couchdb.apache.org/)

Neue literaturdatenbank für das Institut für Kontinuumsmechanik

## Ziele

### FAIR Prinzipien

<dl>
  <dt>Findable</dt>
  <dd>Metadaten und Daten sollten sowohl für Menschen als auch für Computer leicht zu finden sein.</dd>
  <dt>Accessible</dt>
  <dd>Sobald der Nutzer die gewünschten Daten gefunden hat, muss er wissen, wie er auf sie zugreifen kann.</dd>
  <dt>Interoperable</dt>
  <dd>Die Daten müssen in der Regel mit anderen Daten integriert werden können.</dd>
  <dt>Reusable</dt>
  <dd>Metadaten und Daten sollten gut beschrieben sein, damit sie in verschiedenen Umgebungen repliziert und/oder kombiniert werden können.</dd>
</dl>

## Installation

<details>
<summary>Docker (empfohlen)</summary>
<br>

Die Literaturdatenbank samt Datenbank wird am einfachsten mit [Docker Compose](https://docs.docker.com/compose/) installiert. Eine [Referenzdatei](/docker-compose.yaml) ist vorhanden.

</details>

<details>
<summary>Manuell</summary>
<br>

Die Webapplikation basiert auf den traditionellen LAMP-Stack.

Nachdem das Repository geklont wurde muss noch `composer install` ausgeführt werden, um alle Abhängigkeiten zu installieren.

</details>
