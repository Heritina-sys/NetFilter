# NetFilter — interface web de gestion d'iptables (PHP)

Application web en **PHP** (avec **Bootstrap 5** fourni) pour consulter et
compléter les règles `iptables` d'une machine Linux depuis un navigateur.

## Fonctionnalités

- Lecture des règles avec `sudo iptables -S`.
- Analyse de la sortie et classement par chaîne : **INPUT**, **OUTPUT**, **FORWARD**.
- Tableaux colorés selon l'action : `ACCEPT` (clair), `DROP` (rouge), `REJECT` (orange).
- Affichage détaillé des ports source/destination (accordéons).
- Formulaire d'ajout de règle : chaîne, action, interface, protocole, adresse MAC,
  ports source/destination, source et destination.
- Navigation entre les vues Home / Input / Output / Forward.

## Structure

| Fichier | Rôle |
|---|---|
| `Netfilter.php` | Classe `NetFilter` : lecture d'iptables et construction des commandes |
| `iptables.php` | Page principale d'affichage des règles |
| `ajout.php` | Formulaire d'ajout |
| `traitement.php` | Traitement du formulaire, construction et exécution de la commande |
| `div.js` | Navigation entre les vues |
| `iptables.js` | Affichage conditionnel des listes de ports |
| `iptables.css` | Styles complémentaires |
| `bootstrap/` | Bootstrap 5 (CSS/JS fournis) |
| `Images/` | Captures d'écran et icônes |
| `service` | Liste des services/ports utilisée par le formulaire |
| `iptables` | Fichier de sortie généré par `iptables -S` |

## Prérequis

- PHP 7 ou 8
- Serveur web (Apache, Nginx ou `php -S`)
- Linux avec `iptables`
- `sudo` configuré **sans mot de passe** pour l'utilisateur du serveur web,
  ou serveur web lancé avec les droits suffisants

## Installation

1. Copier le dossier dans la racine web (ou lancer un serveur PHP local).
2. S'assurer que le dossier est accessible en écriture pour créer le fichier
   `iptables`, et que `service` est lisible.
3. Ouvrir `iptables.php` dans le navigateur.

Exemple local :

```bash
php -S localhost:8000
# puis http://localhost:8000/iptables.php
```

## Utilisation

1. La page principale lit l'état courant avec `sudo iptables -S`.
2. « Ajouter » ouvre le formulaire `ajout.php`.
3. La soumission est traitée par `traitement.php`, qui construit une commande
   `iptables -A ...` et l'exécute, puis renvoie vers la table actualisée.

## Sécurité

- L'application exécute des commandes système avec `exec()` et `sudo`.
- **Ne pas l'exposer sur un réseau non fiable** : aucune authentification n'est
  prévue.
- Les valeurs du formulaire sont concaténées directement dans les commandes ;
  une validation stricte des entrées est nécessaire avant tout usage réel.
- Réserver l'outil à un usage local ou à un réseau administré.

## Notes

- Le fichier `iptables` est écrasé à chaque lecture.
- `traitement.php` gère l'ajout ; les boutons de modification/suppression
  présents dans la table ne sont pas encore reliés à une action côté serveur.
