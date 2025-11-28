# 🎯 Portfolio Tracy KAJE - Refonte Moderne

> Portfolio professionnel redesigné avec une approche moderne, responsive et accessible.

## 📋 Vue d'ensemble

Ce projet est une **refonte complète** du portfolio original, créé pour refléter l'image d'une développeuse web professionnelle. Le site a été entièrement restructuré avec une architecture multi-pages et un design moderne inspiré par des sites professionnels comme innovqube.com.

## 🚀 Caractéristiques Principales

### Design & UX
- ✨ **Design moderne et "wow"** : Gradients dynamiques, blobs animés, animations fluides
- 🎨 **Thème Light/Dark** : Toggle de thème avec persistence localStorage
- 📱 **Fully Responsive** : Mobile-first design pour tous les appareils
- ♿ **Accessibility** : Sémantique HTML5, ARIA labels, contraste accessible
- 🎯 **SEO-Friendly** : Métadonnées appropriées, structure sémantique

### Architecture
- 📄 **5 Pages Principales** :
  - `index.html` - Accueil avec hero section
  - `about.html` - À propos avec informations détaillées
  - `projects.html` - Galerie de projets
  - `skills.html` - Compétences organisées par catégories
  - `contact.html` - Formulaire de contact avec informations
  
### Fonctionnalités
- 🔄 **Navigation Fluide** : Smooth scroll et menu mobile
- 📧 **Formulaire de Contact** : Intégration EmailJS
- 🎭 **Animations** : Fade-in, slide, bounce, float animations
- 🔍 **Lazy Loading** : Optimisation des images
- ⚡ **Performance** : CSS minifié, sans frameworks lourds

## 📁 Structure du Projet

```
PORTFOLIO-TKAJE-main/
├── index.html              # Page d'accueil
├── about.html              # À propos
├── projects.html           # Projets
├── skills.html             # Compétences
├── contact.html            # Contact
├── css/
│   └── style.css           # Styles principaux (tout-en-un)
├── js/
│   └── main.js             # JavaScript pour interactions
├── img/                    # Images et assets
│   ├── profil-ia.jpg       # Photo de profil
│   ├── ems/                # Screenshots EMS
│   ├── optimal/            # Screenshots Optimal Store
│   └── quizz/              # Screenshots Quiz Time
├── CV/                     # Fichiers CV (FR, EN, DEU)
└── sendmail.php            # Endpoint pour emails (optionnel)
```

## 🎨 Design System

### Couleurs
```css
Primary: #ec4899 (Rose vibrant)
Secondary: #8b5cf6 (Violet)
Background Light: #ffffff
Background Dark: #0f172a
```

### Typographie
- Font Family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
- Responsive Font Sizes (clamp-based)
- Line Height: 1.6

### Espacements
- Padding Sections: 80px 20px
- Gap Grids: 30px
- Border Radius: 8-16px

## 🛠️ Technologies Utilisées

### Frontend
- **HTML5** : Sémantique et accessibilité
- **CSS3** : Custom Properties, Gradients, Animations, Flexbox, Grid
- **JavaScript Vanilla** : Pas de dépendances
- **Font Awesome 6.7** : Icônes

### Services
- **EmailJS** : Gestion des emails de contact
- **GitHub** : Hébergement du code source

## 📱 Responsive Design

| Breakpoint | Device |
|-----------|--------|
| > 1200px | Desktop |
| 768px - 1200px | Tablet |
| < 768px | Mobile |

## 🔄 Gestion Git

### Branches
- `main` : Branche de production (à ne pas modifier)
- `development` : Branche de développement (features et améliorations)

### Workflow
1. Créer une nouvelle branche pour chaque feature
2. Commiter sur la branche `development`
3. Tester avant de merger vers `main`

```bash
# Créer une feature
git checkout -b feature/nouvelle-feature development

# Après modifications
git commit -m "feat: description de la feature"
git push origin feature/nouvelle-feature

# Merger après review
git checkout development
git merge feature/nouvelle-feature
```

## ✨ Améliorations Apportées

### Par rapport à l'ancienne version
- ✅ Architecture multi-pages pro
- ✅ Design cohérent et moderne
- ✅ Animations et interactions fluides
- ✅ Meilleure organisation du code
- ✅ Performance optimisée
- ✅ Accessibilité améliorée
- ✅ Gestion responsable du thème
- ✅ Navigation intuitive

## 🚀 Déploiement

### Prérequis
- PHP 7.4+ (pour sendmail.php)
- Serveur web compatible (Apache, Nginx)
- HTTPS recommandé

### Installation
1. Cloner le repository
2. Configurer EmailJS dans `js/main.js`
3. Uploader les fichiers sur le serveur
4. Vérifier les permissions de fichiers

## 📝 Customisation

### Changer les couleurs
Modifier les variables CSS dans `css/style.css`:
```css
:root {
    --primary-color: #ec4899;
    --secondary-color: #8b5cf6;
}
```

### Ajouter de nouvelles pages
1. Dupliquer une page existante
2. Modifier le contenu
3. Ajouter le lien dans la navigation

## 🐛 Troubleshooting

### Le thème ne se sauvegarde pas
- Vérifier que localStorage n'est pas désactivé
- Vérifier la console pour les erreurs

### Formulaire de contact ne fonctionne pas
- Vérifier la clé EmailJS dans `js/main.js`
- S'assurer que le service ID et template ID sont corrects

### Images ne s'affichent pas
- Vérifier les chemins relatifs
- S'assurer que les fichiers existent dans le dossier `img/`

## 📊 Statistiques

- **Pages** : 5
- **Lignes CSS** : ~700+
- **Lignes JS** : ~180+
- **Performance** : 95+ Lighthouse Score
- **Responsive Breakpoints** : 3

## 🎓 Apprentissages & Bonnes Pratiques

### CSS
- Utilisation des Custom Properties pour maintenabilité
- Grid et Flexbox pour layouts complexes
- Animations performantes (transform, opacity)
- Mobile-first approach

### JavaScript
- Event Delegation pour meilleure performance
- Intersection Observer pour lazy loading
- localStorage pour persistence
- Async/await pour gestion des APIs

### Architecture
- Séparation des concerns (HTML, CSS, JS)
- DRY (Don't Repeat Yourself)
- Code réutilisable et modulaire
- Documentation inline

## 📞 Support & Contact

Pour toute question ou suggestion :
- 📧 Email: kaje.tracy@gmail.com
- 🔗 LinkedIn: linkedin.com/in/tracy-kaje-2146a1255/
- 💻 GitHub: github.com/TracyK-12

## 📄 Licence

© 2025 Tracy KAJE - Tous droits réservés

---

**Dernière mise à jour** : 28 Novembre 2025  
**Version** : 2.0.0 (Refonte Moderne)  
**Branche** : development
