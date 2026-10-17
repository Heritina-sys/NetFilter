# Installation et utilisation de NetFilter

## 1. Préparer le serveur

### Option A — serveur PHP local

```bash
cd NetFilter
php -S localhost:8000
```

Ouvrir ensuite <http://localhost:8000/iptables.php>.

### Option B — Apache / Nginx

Copier le dossier dans la racine web et s'assurer que PHP peut :

- lire `service` ;
- écrire le fichier `iptables` dans le dossier de travail ;
- exécuter `sudo iptables -S` et `sudo iptables -A ...`.

## 2. Autoriser iptables sans mot de passe

Si l'utilisateur du serveur web est `www-data`, ajouter une règle `sudoers` :

```sudoers
www-data ALL=(root) NOPASSWD: /usr/sbin/iptables
```

Puis vérifier :

```bash
sudo -u www-data sudo iptables -S
```

> Adapter le chemin de `iptables` (`which iptables`) et l'utilisateur à votre
> distribution.

## 3. Utilisation

1. `iptables.php` exécute `sudo iptables -S > iptables`, lit le fichier et
   affiche les règles des chaînes INPUT, OUTPUT et FORWARD.
2. Les lignes sont colorées selon l'action :
   - `ACCEPT` : fond clair ;
   - `DROP` : fond rouge ;
   - `REJECT` : fond orange.
3. « Ajouter » ouvre `ajout.php` : chaîne, action, interface, protocole, MAC,
   ports source/destination, source et destination.
4. `traitement.php` construit la commande `iptables -A ...` et l'exécute, puis
   redirige vers `iptables.php`.

## 4. Dépannage

| Problème | Cause probable |
|---|---|
| La table est vide | `sudo iptables -S` a échoué (droits) ou le fichier `iptables` n'est pas lisible |
| `file("service")` échoue | `service` absent ou droits insuffisants |
| La règle n'est pas appliquée | `exec()` désactivé, `sudo` refuse, ou commande invalide |
| Erreur de port | Les ports doivent être séparés par des virgules et exister dans `service` |

## 5. Sécurité

- Aucune authentification : ne pas exposer l'application sur Internet.
- Les entrées du formulaire sont concaténées dans une commande shell : une
  validation stricte est indispensable avant un usage réel.
- Préférer un accès local ou via un réseau administré.
