# Moodle Matériel Plugin

Plugin Moodle pour la gestion de matériel.

## Description

Ce plugin permet de gérer le matériel dans Moodle. Il s'agit d'un plugin de type "local" qui ajoute des fonctionnalités personnalisées à votre installation Moodle.

## Installation

1. Placez le dossier `moodle_materiel` dans le répertoire `/local/materiel/` de votre installation Moodle
2. Connectez-vous en tant qu'administrateur
3. Accédez à "Administration du site > Notifications"
4. Suivez les instructions d'installation

## Utilisation

Une fois installé, le plugin ajoute un lien "Matériel" dans le menu de navigation principal pour les utilisateurs ayant les permissions appropriées.

## Permissions

Le plugin définit trois capacités :

- `local/materiel:view` - Permet de voir le matériel
- `local/materiel:manage` - Permet de gérer le matériel
- `local/materiel:admin` - Permet d'administrer le matériel

## Développement

### Structure du plugin

```
local/materiel/
├── version.php          # Informations sur la version
├── lib.php              # Fonctions principales
├── index.php            # Page principale
├── lang/                # Fichiers de langue
│   ├── en/
│   │   └── local_materiel.php
│   └── fr/
│       └── local_materiel.php
├── db/                  # Définitions de base de données
│   └── access.php       # Définitions des capacités
└── README.md            # Documentation
```

## Compatibilité

- Moodle 4.0 ou supérieur
- PHP 7.4 ou supérieur

## Licence

GNU GPL v3 ou ultérieure

## Auteur

2025 Your Name
