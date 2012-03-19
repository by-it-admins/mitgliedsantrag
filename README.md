# Mitgliedsantrag

Über das Formular unter https://piratenpartei-bayern.de/mitgliedsantrag-extern/ (wird noch umgezogen) können Neumitglieder-Stammdaten eingeben werden.
Diese werden dann per POST an https://mitgliedsantrag.piratenpartei-bayern.de verschickt und da in eine Datenbank gespeichert.

Entweder per AJAX oder ohne JavaScript mit einer Weiterleitung angekündigten Weiterleitung auf https://mitgliedsantrag.piratenpartei-bayern.de

Die Daten der Neumitglieder werden

* nicht auf dem Server gespeichert, auf dem auch die Webseite läuft
* per https übertragen
* das annehmende script (https://mitgliedsantrag.piratenpartei-bayern.de) hat auf 'seiner' Datenbank nur insert-rechte, kann also weder Neumitglieder löschen noch einsehen.
* die Neumitglieder werden in regelmäßigen Abständen von der Verwaltung abgeholt und auf dem Server gelöscht

Gliederungen die selbst Antragsformulare anbieten wollen können die Mitgliederdaten per POST an https://mitgliedsantrag.piratenpartei-bayern.de (values und names wie auf https://piratenpartei-bayern.de/mitgliedsantrag-extern/) senden. Bitte meldet das bei support@piratenpartei-bayern.de um Eure Domain als Absender einzutragen.

# Lizenz

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this work except in compliance with the License. You may obtain a copy of the License in the LICENSE file, or at:

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.