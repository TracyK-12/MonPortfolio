# 🚀 Guide de Démarrage - Portfolio Tracy KAJE v2

Bienvenue dans le nouveau portfolio redesigné! Ce guide vous aidera à comprendre l'architecture et comment contribuer.

## 📌 Avant de Commencer

### Prérequis
- Git configuré (`git config --global user.name` et `user.email`)
- Éditeur de code (VS Code recommandé)
- Navigateur moderne (Chrome, Firefox, Safari, Edge)
- Serveur local optionnel (PHP, Node.js, ou Python)

### Cloner le Projet
```bash
git clone https://github.com/TracyK-12/MonPortfolio.git
cd PORTFOLIO-TKAJE-main
git checkout development
```

## 🏗️ Architecture du Projet

### Organisation des Fichiers
```
├── index.html              ← Page d'accueil (landing page)
├── about.html              ← À propos et informations perso
├── projects.html           ← Portfolio de projets
├── skills.html             ← Compétences techniques
├── contact.html            ← Formulaire de contact
├── css/style.css           ← Tous les styles (une seule feuille)
├── js/main.js              ← JavaScript pour interactions
├── img/                    ← Images et assets
└── CV/                     ← Fichiers CV multilingues
```

### Hiérarchie CSS
```
style.css
├── Variables & Reset
├── Container & Grid
├── Navbar
├── Hero Section
├── Featured Section
├── CTA Section
├── Footer
├── About Page
├── Projects Page
├── Skills Page
├── Contact Page
└── Responsive Media Queries
```

## 🎨 Guide de Style

### Variables CSS Principales
```css
:root {
    /* Couleurs */
    --primary-color: #ec4899;      /* Rose vibrant */
    --secondary-color: #8b5cf6;    /* Violet */
    
    /* Backgrounds */
    --background-light: #ffffff;
    --background-dark: #0f172a;
    
    /* Shadows */
    --shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.15);
}
```

### Composants Réutilisables
```html
<!-- Bouton primaire -->
<a href="#" class="btn btn-primary">
    <span>Texte</span>
    <i class="fas fa-arrow-right"></i>
</a>

<!-- Bouton secondaire -->
<a href="#" class="btn btn-secondary">Texte</a>

<!-- Card de contenu -->
<div class="project-card">
    <div class="project-image">
        <img src="image.jpg" alt="description">
    </div>
    <div class="project-content">
        <h3>Titre</h3>
        <p>Description</p>
    </div>
</div>

<!-- Info item -->
<div class="info-item">
    <i class="fas fa-icon"></i>
    <div>
        <h4>Titre</h4>
        <p>Contenu</p>
    </div>
</div>
```

## 🔄 Workflow Git (Bonne Pratique)

### 1. Créer une Feature
```bash
# Toujours partir de development
git checkout development
git pull origin development

# Créer sa branche feature
git checkout -b feature/nom-de-la-feature
```

### 2. Développer
```bash
# Éditer les fichiers...
# Tester localement...

# Vérifier les changements
git status

# Ajouter les fichiers
git add .

# Commiter avec message descriptif
git commit -m "feat: description courte et claire"

# Pousser vers remote
git push origin feature/nom-de-la-feature
```

### 3. Merger
```bash
# Finir de développer et tester
git checkout development
git pull origin development
git merge feature/nom-de-la-feature
git push origin development

# Nettoyer la branche
git branch -d feature/nom-de-la-feature
git push origin --delete feature/nom-de-la-feature
```

## 📝 Standards de Commit

### Format
```
type: sujet

description optionnelle

footer optionnel
```

### Types
- `feat:` Nouvelle fonctionnalité
- `fix:` Correction de bug
- `docs:` Documentation seulement
- `style:` Formatage, pas de changement logique
- `refactor:` Refactorisation sans nouveau feature
- `perf:` Amélioration performance
- `test:` Ajout ou modification tests
- `chore:` Mise à jour dépendances, config

### Exemples
```bash
# Bons commits
git commit -m "feat: ajouter section blog"
git commit -m "fix: corriger bug menu mobile"
git commit -m "docs: ajouter guide installation"
git commit -m "refactor: simplifier CSS navbar"

# Mauvais commits
git commit -m "update"
git commit -m "changes"
git commit -m "fix bug"
```

## 🧪 Tester Localement

### Option 1 : PHP Intégré
```bash
# Aller dans le dossier du projet
cd PORTFOLIO-TKAJE-main

# Lancer le serveur PHP
php -S localhost:8000

# Ouvrir http://localhost:8000
```

### Option 2 : Python
```bash
# Python 3
python -m http.server 8000

# Python 2
python -m SimpleHTTPServer 8000
```

### Option 3 : Node.js
```bash
# Installer http-server globalement
npm install -g http-server

# Lancer le serveur
http-server
```

## 🎯 Tâches Communes

### Modifier un Style
1. Ouvrir `css/style.css`
2. Trouver la section concernée (ex: `.navbar`, `.hero`, etc)
3. Modifier les propriétés CSS
4. Tester dans le navigateur (F12 DevTools)
5. Commit avec message descriptif

### Ajouter une Nouvelle Page
```bash
# 1. Créer la branche
git checkout -b feature/nouvelle-page

# 2. Dupliquer une page existante (ex: about.html)
# 3. Modifier le contenu
# 4. Ajouter le lien dans la navbar
# 5. Ajouter les CSS si nécessaire
# 6. Tester sur tous les breakpoints
# 7. Commit et push
```

### Corriger un Bug
```bash
# 1. Créer la branche
git checkout -b fix/description-bug

# 2. Identifier et fixer l'issue
# 3. Tester la correction
# 4. Commit avec message explicatif
git commit -m "fix: description du bug et solution"

# 5. Push et demander review
```

## 🚀 Avant de Déployer sur Main

### Checklist
- [ ] Code testé sur Firefox, Chrome, Safari
- [ ] Responsive testé (mobile 375px, tablet 768px, desktop 1200px)
- [ ] Pas d'erreurs console (F12)
- [ ] Pas de warnings ESLint
- [ ] Tous les liens fonctionnent
- [ ] Toutes les images s'affichent
- [ ] Formulaire de contact fonctionne
- [ ] Theme toggle fonctionne
- [ ] Mobile menu fonctionne
- [ ] Lighthouse score > 90

### Test de Performance
```bash
# Ouvrir DevTools (F12)
# Aller sur l'onglet Lighthouse
# Cliquer sur "Analyze page load"
```

## 🐛 Déboguer

### Console DevTools
```javascript
// Voir les erreurs
F12 → Console

// Vérifier les variables
console.log(variableName);

// Vérifier le DOM
console.log(document.getElementById('id'));
```

### CSS DevTools
```
F12 → Elements
Inspecter l'élément
Voir les styles appliqués
Tester les modifications en live
```

### Performance DevTools
```
F12 → Performance
Enregistrer les actions
Analyser les bottlenecks
Optimiser
```

## 💡 Tips & Tricks

### Raccourcis VS Code
```
Ctrl + / : Commenter/décommenter
Ctrl + H : Remplacer
Ctrl + Shift + L : Multi-select
Alt + Shift + F : Formater le document
F2 : Renommer le fichier
```

### Chrome DevTools Shortcuts
```
F12 : Ouvrir DevTools
Ctrl + Shift + I : Inspecter élément
Ctrl + Shift + C : Sélectionner élément
Ctrl + Shift + J : Console
Ctrl + Shift + M : Mobile view
```

### Bonnes Pratiques CSS
```css
/* ✅ BON */
.navbar {
    display: flex;
    gap: 1rem;
}

/* ❌ MAUVAIS */
.navbar {
    display: flex;
    margin-right: 15px;
}
```

## 📚 Documentation Externe

### HTML/CSS/JavaScript
- [MDN Web Docs](https://developer.mozilla.org/)
- [Can I Use](https://caniuse.com/) - Compatibilité navigateurs
- [CSS-Tricks](https://css-tricks.com/) - Tutoriels CSS

### Design & UX
- [Material Design](https://material.io/design/)
- [Figma](https://www.figma.com/) - Design collaborative
- [Coolors](https://coolors.co/) - Générateur de palettes

### Performance
- [Google PageSpeed Insights](https://pagespeed.web.dev/)
- [Lighthouse](https://developers.google.com/web/tools/lighthouse)
- [WebPageTest](https://www.webpagetest.org/)

## 🎓 Ressources d'Apprentissage

### Recommandés pour ce projet
- [ ] [Responsive Web Design](https://www.freecodecamp.org/learn/responsive-web-design/)
- [ ] [CSS Grid](https://www.youtube.com/watch?v=rg7Fvvl3V1o)
- [ ] [Flexbox](https://www.youtube.com/watch?v=-Wlt8NRtOpo)
- [ ] [CSS Custom Properties](https://www.youtube.com/watch?v=dDQ-zrxKa-k)

## 🤝 Contribution Guidelines

1. **Respecter le style du code** existant
2. **Commenter le code complexe**
3. **Tester avant de pusher**
4. **Écrire des messages de commit clairs**
5. **Mettre à jour la documentation**
6. **Pas de secrets ou données sensibles**

## ❓ FAQ

### Q: Comment changer les couleurs primaires?
**A:** Modifier les variables dans `css/style.css` ligne ~10-15

### Q: Comment ajouter une nouvelle animation?
**A:** Ajouter une `@keyframes` dans `css/style.css` et l'utiliser avec `animation: nom 0.8s ease-out`

### Q: Comment faire fonctionner le formulaire de contact?
**A:** Configurer EmailJS dans `js/main.js` (voir commentaires)

### Q: Comment mettre à jour le contenu?
**A:** Éditer les fichiers HTML correspondants (index.html, about.html, etc)

## 📞 Support

Pour des questions:
- 📧 Email: kaje.tracy@gmail.com
- 🔗 GitHub Issues: Créer une issue
- 💬 Discord: Rejoindre le serveur

---

**Bon développement!** 🚀  
N'hésitez pas à poser des questions si quelque chose n'est pas clair.

**Version**: 1.0  
**Mis à jour**: 28 Novembre 2025
