# literatur-datenbank

[![Docker](https://github.com/j0hax/literatur-datenbank/actions/workflows/docker-publish.yml/badge.svg)](https://github.com/j0hax/literatur-datenbank/actions/workflows/docker-publish.yml)
[![Lint Code Base](https://github.com/j0hax/literatur-datenbank/actions/workflows/super-linter.yml/badge.svg)](https://github.com/j0hax/literatur-datenbank/actions/workflows/super-linter.yml)

Neue literaturdatenbank für das Institut für Kontinuumsmechanik

## Installation

### Docker (Empfohlen)

Die Literaturdatenbank samt Datenbank wird am einfachsten mit [Docker Compose](https://docs.docker.com/compose/) installiert. Eine [Referenzdatei](/docker-compose.yaml) ist vorhanden.

Variablen wie `$DBUSER` und `$DBPASSWORD` müssen in einer .env-Datei gespeichert werden.

### Manuell

Die Webapplikation basiert auf den traditionellen LAMP-Stack.

Nachdem das Repository geklont wurde muss noch `composer install` ausgeführt werden, um alle Abhängigkeiten zu installieren.

## Datenbankschema

```console
+----------+---------------+------+-----+---------------------------+----------------+
| Field    | Type          | Null | Key | Default                   | Extra          |
+----------+---------------+------+-----+---------------------------+----------------+
| id       | int(11)       | NO   | PRI | NULL                      | auto_increment |
| title    | varchar(300)  | NO   |     | NULL                      |                |
| author   | varchar(300)  | NO   |     | NULL                      |                |
| year     | year(4)       | NO   |     | year(current_timestamp()) |                |
| keyword  | varchar(300)  | YES  |     | NULL                      |                |
| abstract | varchar(5000) | YES  |     | NULL                      |                |
| path     | varchar(300)  | NO   |     | NULL                      |                |
| type     | varchar(30)   | NO   |     | NULL                      |                |
| path_zip | varchar(300)  | YES  |     | NULL                      |                |
| path_img | varchar(300)  | YES  |     | NULL                      |                |
| path_url | varchar(300)  | YES  |     | NULL                      |                |
| password | varchar(300)  | YES  |     | NULL                      |                |
| text     | mediumtext    | YES  |     | NULL                      |                |
+----------+---------------+------+-----+---------------------------+----------------+
```
