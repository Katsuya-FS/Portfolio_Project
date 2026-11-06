# Black Clover themed PHP portfolio

A responsive, single page PHP portfolio inspired by Asta’s Devil Union and Yuno’s Full Spirit Dive. It uses plain PHP 8.2+, vanilla CSS, and JavaScript modules.

## Project structure

```text
portfolio/
├── index.php                 # XAMPP-friendly entry point
├── .htaccess                 # Routes requests to public/ and blocks source folders
├── api/                      # Vercel PHP function entry points
│   ├── index.php
│   └── contact.php
├── public/                   # Public PHP pages and site assets
│   ├── index.php             # Front controller
│   ├── contact.php           # Validated JSON endpoint retained for future use
│   ├── .htaccess
│   └── assets/{css,js,img}/
├── src/
│   ├── helpers.php           # Loads the focused helper modules
│   ├── helpers/              # Escaping, templates, URLs, and CSRF
│   ├── config.php            # Site and contact configuration
│   └── data/                 # Profile, stack, education, projects
├── templates/
│   ├── layout.php
│   └── partials/             # Header, hero, stack, education, projects, contact/footer
├── scripts/build-vercel.mjs  # Copies public assets into the Vercel output
├── vercel.json               # PHP runtime, routes, and build settings
├── .vercelignore              # Excludes local-only files from Vercel uploads
└── .gitignore
```

## Run locally

1. Place the project in `C:\xampp\htdocs\Portfolio`
2. Start Apache in XAMPP Control Panel
3. Open the site in your browser:

```text
http://localhost/Portfolio/
```

## Run deployed

You can access the deployed version via: https://www.alcordocyronejames.online/

## Contact email setup

The Contact section shows direct email, GitHub, LinkedIn, and Facebook links. Set `PORTFOLIO_EMAIL`, `PORTFOLIO_GITHUB`, `PORTFOLIO_LINKEDIN`, and `PORTFOLIO_FACEBOOK` in the web server environment, or create an untracked `config.local.php` at the project root:

```php
<?php
return [
    'email' => 'you@example.com',
    'mail_to' => 'you@example.com',
    'socials' => [
        'github' => 'https://github.com/yourusername',
        'linkedin' => 'https://linkedin.com/in/yourusername',
        'facebook' => 'https://www.facebook.com/yourusername',
    ],
];
```

`config.local.php` and `.env` are excluded by `.gitignore`. There is no message form in the Contact section.

The Projects section is a keyboard accessible carousel with five sample projects, a visible horizontal scrollbar, and blurred side cards. Select a project card to open its details. The Contact section contains only direct email and social links. The theme preference is stored in a one-year `theme` cookie; first-time visitors use their system color preference.

### Vercel

The project includes a Vercel configuration for this PHP site. It uses the community-maintained `vercel-php` runtime, sends page requests to `api/index.php`, and publishes only the contents of `public/assets/` as static files. The PHP source is handled by the runtime instead of being offered as a download.

Import the repository into Vercel with the project root as the Root Directory. Keep the Build Command and Output Directory settings on their defaults from `vercel.json`, then deploy. If you use the optional email and social configuration, add `PORTFOLIO_EMAIL`, `PORTFOLIO_GITHUB`, `PORTFOLIO_LINKEDIN`, and `PORTFOLIO_FACEBOOK` in Vercel's Environment Variables; do not upload `.env` or `config.local.php`.

The PHP runtime is community-maintained rather than an officially supported Vercel runtime. See the [Vercel PHP runtime setup](https://github.com/vercel-community/php#usage) and [Vercel runtime documentation](https://vercel.com/docs/functions/runtimes).

### Apache shared hosting

Upload the project and point the domain's document root to `public/` if your host allows it. If the domain must serve the project root, keep the root `.htaccess` and root `index.php`; enable `mod_rewrite` and `AllowOverride All`. Confirm PHP 8.2+, HTTPS, and a configured mail transport. Set the mail and social environment variables or upload an untracked `config.local.php`.
