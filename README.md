# Black Clover themed PHP portfolio

A responsive, single page PHP portfolio inspired by Asta’s Devil Union and Yuno’s Full Spirit Dive. It uses plain PHP 8.2+, vanilla CSS, and JavaScript modules. Personal copy, education details, and sample projects are placeholders; edit them before publishing.

## Project structure

```text
portfolio/
├── index.php                 # XAMPP-friendly entry point
├── .htaccess                 # Routes requests to public/ and blocks source folders
├── public/                   # Web root for PHP's local server / production
│   ├── index.php             # Front controller
│   ├── contact.php           # Validated JSON endpoint retained for future use
│   ├── .htaccess
│   └── assets/{css,js,img}/
├── src/
│   ├── helpers.php           # Escaping, template, URL, and CSRF helpers
│   ├── config.php            # Site and contact configuration
│   └── data/                 # Profile, stack, education, projects
├── templates/
│   ├── layout.php
│   └── partials/             # Header, hero, stack, education, projects, contact/footer
├── .env.example
└── .gitignore
```

## Run locally

With PHP 8.2+ installed, run from this folder:

```sh
php -S localhost:8000 -t public
```

Open <http://localhost:8000>. For XAMPP, place the project at `C:\xampp\htdocs\Portfolio`, start Apache, then open <http://localhost/Portfolio>. The root `index.php` forwards to the public front controller; Apache's rewrite rules route static assets and the contact endpoint into `public/`.

For the strongest source-file protection on a live host, set the site document root to the project's `public/` folder. Keep `src/` and `templates/` outside the publicly served directory where possible.

## Personalize content

- `src/data/profile.php`: name, role, pitch, About copy, and location.
- `src/data/stack.php`: technologies grouped into Frontend, Backend, Database, and Tools.
- `src/data/education.php`: Elementary, High School, Senior High School, and College records.
- `src/data/projects.php`: project title, short summary, challenge, solution, stack tags, screenshot path, live URL, and repository URL.
- `src/config.php`: email and social links shown in the Contact section.
- `public/assets/img/`: replace the included project placeholder SVG with your screenshots, and update each image path and alt text in the project data.
- `public/assets/css/tokens.css`: theme colors and spacing tokens.

The clover mark is inline SVG in the header and uses theme colors. The hero canvas switches from ember-like particles in Devil Union to green drifting particles in Spirit Dive.

## Contact email setup

The Contact section shows direct email, GitHub, and LinkedIn links. Set `PORTFOLIO_EMAIL` and social URLs in the web server environment, or create an untracked `config.local.php` at the project root:

```php
<?php
return [
    'email' => 'you@example.com',
    'mail_to' => 'you@example.com',
    'socials' => [
        'github' => 'https://github.com/yourusername',
        'linkedin' => 'https://linkedin.com/in/yourusername',
    ],
];
```

`config.local.php` and `.env` are excluded by `.gitignore`. There is no message form in the Contact section.

The Projects section is a keyboard accessible carousel with five sample projects, a visible horizontal scrollbar, and blurred side cards. Select a project card to open its details. The Contact section contains only direct email and social links. The theme preference is stored in a one-year `theme` cookie; first-time visitors use their system color preference.

## Deployment

### Vercel

The project includes a Vercel configuration for this PHP site. It uses the community-maintained `vercel-php` runtime, sends page requests to `api/index.php`, and publishes only the contents of `public/assets/` as static files. The PHP source is handled by the runtime instead of being offered as a download.

Import the repository into Vercel with the project root as the Root Directory. Keep the Build Command and Output Directory settings on their defaults from `vercel.json`, then deploy. If you use the optional email and social configuration, add `PORTFOLIO_EMAIL`, `PORTFOLIO_GITHUB`, and `PORTFOLIO_LINKEDIN` in Vercel's Environment Variables; do not upload `.env` or `config.local.php`.

The PHP runtime is community-maintained rather than an officially supported Vercel runtime. See the [Vercel PHP runtime setup](https://github.com/vercel-community/php#usage) and [Vercel runtime documentation](https://vercel.com/docs/functions/runtimes).

### Apache shared hosting

Upload the project and point the domain's document root to `public/` if your host allows it. If the domain must serve the project root, keep the root `.htaccess` and root `index.php`; enable `mod_rewrite` and `AllowOverride All`. Confirm PHP 8.2+, HTTPS, and a configured mail transport. Set the mail and social environment variables or upload an untracked `config.local.php`.

### Nginx with PHP-FPM

Point Nginx at the `public/` directory and pass only PHP files to PHP-FPM. Example server block (adjust paths, PHP-FPM socket, and domain):

```nginx
server {
    listen 80;
    server_name portfolio.example.com;
    root /var/www/portfolio/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        try_files $uri =404;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
    }

    location ~ /\. {
        deny all;
    }
}
```

Enable HTTPS before launch so the session cookie receives the `Secure` flag.
