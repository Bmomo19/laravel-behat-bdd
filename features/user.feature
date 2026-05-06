Feature: Création utilisateur

    Scenario: Créer un utilisateur
        When je crée un utilisateur nommé "Mohammed"
        Then l'utilisateur "Mohammed" existe

    Scenario: Un utilisateur existe en base
        Given un utilisateur existe en base
        Then il est bien enregistré
