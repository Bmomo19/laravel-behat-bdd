Feature: Tester une route HTTP

  Scenario: Appel de la route ping
    When j'appelle la route "/ping"
    Then la réponse contient "pong"