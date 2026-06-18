# PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready


# PharmaFEFO - Application Asynchrone API Ready

## Présentation

PharmaFEFO est une application web de gestion de stock pharmaceutique basée sur la méthode **FEFO (First Expired First Out)**. Elle permet aux préparateurs, pharmaciens et administrateurs de gérer efficacement les entrées, sorties, péremptions et pertes de médicaments grâce à une architecture MVC moderne utilisant une API REST et JavaScript (Fetch API).

---

# Fonctionnalités

## Épic 1 : Réception & Entrées intelligentes

### US 1.1 : Ajout de nouveaux lots

**En tant que Préparateur authentifié**

Je souhaite ajouter un nouveau lot de médicament sans recharger la page.

### Critères d'acceptation

* La route `/stock/add` est accessible uniquement au rôle `PREPARATEUR`.
* Le formulaire est intercepté avec `event.preventDefault()`.
* Les données sont envoyées via `fetch()`.
* Les données sont transmises en `JSON` ou `FormData`.
* Un message de confirmation est affiché après l'ajout.

---

## Épic 2 : Surveillance & Alertes Péremption

### US 2.1 : Filtrage dynamique des lots

**En tant que Pharmacien authentifié**

Je souhaite filtrer les lots sans recharger la page.

### Critères d'acceptation

* Endpoint API :

```
GET /api/v1/batches?criteria=critical
```

* Le contrôleur renvoie uniquement du JSON.
* JavaScript reconstruit dynamiquement le tableau HTML.
* Aucun rechargement de page.

### US 2.2 : Encadré d'alerte dynamique

**En tant que Pharmacien authentifié**

Je souhaite voir immédiatement le nombre de produits expirant le mois prochain.

### Critères d'acceptation

* Calcul automatique lors du chargement du dashboard.
* Affichage dynamique via JavaScript.

---

## Épic 3 : Sorties de Stock Intelligentes (FEFO)

### US 3.1 : Délivrance automatique

**En tant que Préparateur authentifié**

Je souhaite délivrer une boîte d'un médicament.

### Critères d'acceptation

* Requête AJAX :

```
POST /api/v1/batches/checkout
```

ou

```
PATCH /api/v1/batches/checkout
```

* Le lot FEFO est automatiquement sélectionné.
* La quantité est décrémentée instantanément.
* Si la quantité atteint 0 :

  * La ligne disparaît.
  * Ou elle est grisée automatiquement.

---

## Épic 4 : Gestion des pertes et retours

### US 4.1 : Déclaration d'un lot périmé

**En tant que Pharmacien authentifié**

Je souhaite marquer un lot comme périmé.

### Critères d'acceptation

* Le statut devient :

```php
Status::EXPIRED
```

* La quantité passe à 0.
* L'affichage est mis à jour sans rechargement.

---

### US 4.2 : Rapport financier

**En tant qu'Administrateur authentifié**

Je souhaite consulter les pertes financières.

### Route protégée

```
/admin/reports
```

### Restrictions

| Rôle        | Accès |
| ----------- | ----- |
| ADMIN       | ✅     |
| PHARMACIEN  | ❌     |
| PREPARATEUR | ❌     |

---

# Architecture du projet

```
pharmafefo/
│
├── config/
│   ├── Database.php
│   └── Environment.php
│
├── public/
│   ├── css/
│   ├── js/
│   │   ├── app.js
│   │   └── dashboard.js
│   │
│   └── index.php
│
├── src/
│   ├── Controller/
│   │   ├── Web/
│   │   │   ├── AuthController.php
│   │   │   └── AdminController.php
│   │   │
│   │   └── Api/
│   │       ├── ApiDashboardController.php
│   │       └── ApiStockController.php
│   │
│   ├── Entity/
│   │
│   ├── Enum/
│   │
│   ├── Repository/
│   │
│   └── Service/
│       ├── AuthService.php
│       └── StockService.php
│
└── templates/
```

---

# Services

## AuthService

Responsabilités :

* Vérification des sessions.
* Vérification de l'authentification.
* Vérification des rôles.
* Protection des routes.

Exemple :

```php
$authService->requireRole(Role::PREPARATEUR);
```

---

## StockService

Responsabilités :

* Gestion des entrées.
* Gestion des sorties FEFO.
* Calcul des alertes de péremption.
* Calcul des pertes.

---

# API REST

## Ajouter un lot

```
POST /api/v1/stock/add
```

## Récupérer les lots critiques

```
GET /api/v1/batches?criteria=critical
```

## Délivrer une boîte

```
PATCH /api/v1/batches/checkout
```

## Marquer un lot périmé

```
PATCH /api/v1/batches/expire
```

---

# Technologies utilisées

* PHP 8+
* MVC
* MySQL
* PDO
* JavaScript ES6
* Fetch API
* HTML5
* CSS3

---

# Sécurité

* Contrôle des rôles.
* Sessions PHP sécurisées.
* Validation des données côté serveur.
* Protection des routes API.
* Réponses JSON normalisées.

---

# Objectif principal

Mettre en place une gestion de stock pharmaceutique moderne utilisant le principe FEFO, avec une interface réactive grâce aux appels asynchrones (AJAX/Fetch API) et une architecture MVC évolutive.
