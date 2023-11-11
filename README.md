# WildWonderHub (SAE 3.01)

WildWonderHub est une application de gestion des visiteurs et des animaux du Zoo de la Palmyre, utilisant principalement le framework Symfony (version 6.3).

## Table des matières

<!-- TOC -->
  * [WildWonderHub (SAE 3.01)](#WildWonderHub--sae-301-)
  * [Table des matières](#table-des-matires)
  * [Les auteurs du projet](#les-auteurs-du-projet)
<!-- TOC -->

## Auteurs du projet

- Logan Jacotin
- Romain Leroy
- Vincent Kpatinde
- Clément Perrot

## Outils utilisés

- Symfony
- PhpCsFixer
- Codeception
- EasyAdmin
- Orm-fixtures
- Zenstruck/foundry
- EasyAdmin2

## Mises en place

- Installation du projet
```shell
git clone https://iut-info.univ-reims.fr/gitlab/jaco0024/sae3-01-zoo.git
# Pour installer toutes les dépendances du projets
composer install 
```

**Rappel pour push**

- Créer une branche contenant le nom de la fonctionnalité traitée


```git branch <nom>```

- Se positionner sur cette branche


```git checkout <nom>```

- Retourner sur la branche main une fois le code écrit

```
git checkout main
git pull
```

- Retourner sur sa branche locale
```
git checkout <nom>
git rebase main
```

- Push le code écrit
- Demande de merge request sur le repo gitlab

**Exemple de commit**

* ajout d’une fonctionnalité

```git commit -m "add: <fonctionnalité ajoutée>"```

* modification d’une fonctionnalité déjà présente

```git commit -m "edit: <fonctionnalité modifiée>"```
* suppression d’un fichier

```git commit -m "delete: <fonctionnalité supprimée>"```