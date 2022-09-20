# FAIR Prinzipien

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

Weitere Informationen findet man auf [go-fair.org](https://www.go-fair.org/fair-principles/) und [Wikipedia](https://en.wikipedia.org/wiki/FAIR_data).

## Umgang mit Forschungsdaten

Folgende Punkte werden von der DFG hervorgehoben:

### Datenbeschreibung

Bei den Daten, welche über die letzten Jahre in der Literaturdatenbank gespeichert wurden, handelt es sich um fertige Forschungsprojekte des Instituts für Kontinuumsmechanik an der Leibniz Universität.

Üblicherweise bestehen Einträge aus einem Paper oder Vortrag, welche in PDF Form abgespeichert wurden. Zusätzlich wurden Bilder oder ZIP-Dateien bei Bedarf mit hochgeladen.

Die neue Literaturdatenbank folgt ein ähnliches Prinzip, allerdings mit größerer Flexibilität an Metadaten und weiteren Forschungsdaten (<q>Anhängen</q>)

### Dokumentation und Datenqualität

> Welche Ansätze werden verfolgt, um die Daten nachvollziehbar zu beschreiben (z. B. Nutzung vorhandener Metadaten- bzw. Dokumentationsstandards oder Ontologien)? Welche Maßnahmen werden getroffen, um eine hohe Qualität der Daten zu gewährleisten? Sind Qualitätskontrollen vorgesehen und wenn ja, auf welche Weise? Welche digitalen Methoden und Werkzeuge (z. B. Software) sind zur Nutzung der Daten erforderlich?

Die Literaturdatenbank bietet durch ihr Web-Interface Pflichtfelder zur Erfassung und Bearbeitung von Metadaten (beispielsweise _Titel, Autor, Datum,_ etc.) und gewährleistet so Datenintegrität. Die eigentliche Datenqualität hängt in diesem Fall von den individuellen Autoren der Einträge ab; ein Administrator im Institut pflegt jeden Eintrag erst nach menschlicher Überprüfung ein.

Die Nutzung der Datenbank für Menschen erfolgt über einen Webbrowser -- für den maschinellen Austausch, siehe bitte den Abschnitt <q>Datenaustausch und dauerhafte Zugänglichkeit der Daten.</q>

### Speicherung und technische Sicherung während des Projektverlaufs

> Auf welche Weise werden die Daten während der Projektlaufzeit gespeichert und gesichert? Wie wird die Sicherheit sensibler Daten während der Projektlaufzeit gewährleistet (Zugriffs- und Nutzungsverwaltung)?

Die Datenbank dient im eigentlichen Sinne als Archiv für abgeschlossene Projekte. Eine Zugriffsverwaltung erfolgt durch die Firewall der Universität; die Datenbank ist nur für Mitarbeitende im Institutsnetz erreichbar.

Zur Fehlerbehebung darf ein Eintrag nachträglich durch Nutzer bearbeitet werden. Dies ist möglich durch das Angeben eines individuellen Passworts für jeden Eintrag. Der Administrator hat vollen Zugriff auf die Datenbank, mit der Möglichkeit Einträge ohne Passwort zu bearbeiten oder im Notfall das Passwort für einen Eintrag zurückzusetzen.

### Datenaustausch und dauerhafte Zugänglichkeit der Daten

> Welche Daten bieten sich für die Nachnutzung in anderen Kontexten besonders an? Nach welchen Kriterien werden Forschungsdaten ausgewählt, um diese für die Nachnutzung durch andere zur Verfügung zu stellen? Planen Sie die Archivierung Ihrer Daten in einer geeigneten Infrastruktur? Falls ja, wie und wo? Gibt es Sperrfristen? Wann sind die Forschungsdaten für Dritte nutzbar?

Für die Einbindung von zusätzlichen Programmen bietet die eingesetzte Datenbank eine [REST-Schnittstelle](https://docs.couchdb.org/en/stable/intro/api.html). Diese erlaubt für das Abfragen und Bearbeiten von Daten mit einem vom Administrator vergebenen Nutzernamen und Passwort.

Aktuell wird die Datenbank in einem Docker-Volum	 auf einem Server des Institutes gespeichert. Neben der Hardware-Infrastruktur (RAID) bietet die gewählte Datenbanksoftware auch [Replikation](https://docs.couchdb.org/en/stable/replication/intro.html).

Es existieren zu diesem Zeitpunkt keine Sperrfristen. Daten sind derzeitig nur innerhalb des Instituts zugreifbar.

### Verantwortlichkeiten und Ressourcen

> Wer ist verantwortlich für den adäquaten Umgang mit den Forschungsdaten (Beschreibung der Rollen und Verantwortlichkeiten innerhalb des Projekts)? Welche Ressourcen (Kosten; Zeit oder anderes) sind erforderlich, um einen adäquaten Umgang mit Forschungsdaten im Projekt umzusetzen? Wer ist nach Ende der Laufzeit des Projekts für das Kuratieren der Daten verantwortlich?

Umgang mit den Forschungsdaten außerhalb der Archivierung sind nur Mitarbeitende und Forschende des Instituts für Kontinuumsmechanik. Abgesehen vom Regulären Serverbetrieb entstehen keine Zusatzkosten für die Archivierung eines Projektes.

Nach Projektabschluss wird das Archiv von dem Datenbankadministrator sowie den Autoren des Projektes betreut.