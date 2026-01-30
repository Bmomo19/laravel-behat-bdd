Feature: Appel POST JSON

  Scenario: Envoyer un prénom à l’API
    When j'envoie une requête POST sur "/api/hello" avec le JSON:
      | name | Mohammed |
    Then la réponse contient "Bonjour Mohammed"
