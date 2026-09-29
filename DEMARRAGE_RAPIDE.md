# ⚡ DÉMARRAGE RAPIDE - 5 MINUTES

## 1️⃣ Préparation

```bash
cd c:\laragon\www\test_1
```

## 2️⃣ Avec Laragon (Recommandé)

### ✅ Si vous avez Laragon d'installé:

1. **Lancez Laragon** (double-clic sur l'icône)
2. **Ouvrez le navigateur** et allez à: http://localhost/test_1
3. **Connectez-vous** avec:
   - Identifiant: `admin`
   - Mot de passe: `admin123`

**C'est tout! ✨**

---

## 3️⃣ Sans Laragon (Manuel)

### Terminal:
```bash
# Vérifier la base de données
mysql -u root -p
CREATE DATABASE stock_manager;
EXIT;

# Appliquer les migrations
php spark migrate

# Charger les données
php spark db:seed InitialDataSeeder

# Démarrer le serveur
php spark serve
```

### Navigateur:
Allez à **http://localhost:8080**

---

## 🔐 Identifiants de Connexion

| Champ | Valeur |
|-------|--------|
| **Utilisateur** | admin |
| **Mot de passe** | admin123 |

---

## 📋 Configuration minimale

**Fichier: `app/Config/Database.php`**

```php
'default' => [
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',              // Vide pour Laragon
    'database' => 'stock_manager', // Doit exister
    'DBDriver' => 'MySQLi',
]
```

---

## ✅ Vérifier que c'est OK

Vous verrez:
- ✅ Page de connexion profesionnelle
- ✅ Dashboard avec statistiques
- ✅ 6 produits de test
- ✅ 5 catégories
- ✅ Historique de mouvements

---

## 🎯 Premiers pas après connexion

1. Regardez le **Dashboard** (statistiques)
2. Allez dans **Produits** (liste des articles)
3. Consultez **Stocks** (quantités)
4. Vérifiez les **Alertes** (stock faible)
5. Consultez les **Rapports** (analyses)

---

## 🆘 En Cas de Problème

### Erreur "Base de données non trouvée"
```bash
mysql -u root
CREATE DATABASE stock_manager;
php spark migrate
php spark db:seed InitialDataSeeder
```

### Erreur "Port 8080 déjà utilisé"
```bash
php spark serve --port 8081
# Ou trouvez le port libre en changeant le numéro
```

### Erreur "Authentification échouée"
- Vérifiez les identifiants: `admin` / `admin123`
- Vérifiez que le seed a été exécuté

---

## 📝 Notes Importantes

⚠️ **AVANT la présentation:**
- [ ] Testez la connexion
- [ ] Vérifiez les données de test
- [ ] Créez une entrée de stock de test
- [ ] Capturez quelques screenshots

⚠️ **PENDANT la présentation:**
- [ ] Déconnectez-vous proprement après
- [ ] Ne modifiez pas les données de test
- [ ] Gardez une copie de sauvegarde

---

## 🚀 Bonus: Créer un nouvel utilisateur

### Via l'interface:
1. Allez sur `/auth/register`
2. Remplissez le formulaire
3. Confirmez

### Via la console MySQL:
```sql
INSERT INTO users (username, email, password, full_name, role, status) 
VALUES ('employe1', 'employe1@company.com', 
        '$2y$10$...', 'Jean Dupont', 'employee', 'active');
```

---

## 📞 Support Technique

En cas de problème:
1. Vérifiez MySQL est en marche
2. Vérifiez PHP est en marche (version 7.4+)
3. Vérifiez l'accès à la base de données
4. Consultez les logs: `writable/logs/`

---

**Prêt à présenter? 🎉**
