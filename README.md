# Web Development Project

An introductory static website by Fadhili Manyasa, created to demonstrate HTML5 structure, CSS styling, navigation, semantic elements, tables, and media.

## Student

- **Name:** Fadhili Manyasa
- **Registration number:** COM/0103/24
- **Course:** Introduction to Web Development

## Pages

- `index.html` — project home page
- `about.html` — project description and technologies
- `contact.html` — contact details and Kibabii University map
- `data.html` — example student records table
- `gallery.html` — real-person photos, video, audio, and a technology table
- `semantic.html` — example page demonstrating semantic HTML elements

The misspelled legacy filenames `abou.html`, `galley.html`, and `semantic 2 .html` redirect to their correctly named pages.

## Project files

```text
.
├── .vscode/
│   └── launch.json
├── about.html
├── abou.html
├── contact.html
├── data.html
├── galley.html
├── gallery-computer-lab.jpg
├── gallery-code.svg
├── gallery-data.svg
├── gallery-pair-programming.jpg
├── gallery-web.svg
├── gallery.html
├── index.html
├── logo.svg
├── README.md
├── semantic 2 .html
└── semantic.html
```

The HTML pages, SVG illustrations, and two gallery photos are local files. The gallery is curated by Fadhili Manyasa, while original media creators and licenses are credited on the page. The gallery photos are shared under Creative Commons licenses. The gallery's in-page video and keyboard-typing audio are hosted externally and require an internet connection. The video is credited to Coverr-Free-Footage and shared under the Pixabay Content License; the audio is shared under CC0. Credits and source/license links are on the gallery page. A PHP/MySQL password-reset flow is available at `forgot-password.php`; it assumes that the application's account system stores users in the schema documented in `database/password_reset.sql`. This project does not include registration or login.

## Run locally

1. Start Apache and MySQL from the XAMPP Control Panel.
2. Import `database/password_reset.sql` into MySQL using phpMyAdmin.
3. Configure PHP's `mail()` function to deliver email (see [XAMPP's sendmail configuration](https://www.apachefriends.org/faq_windows.html)) and set a valid sender address with the `PASSWORD_RESET_FROM` environment variable.
4. Open `http://localhost/CSC2130-project/forgot-password.php`.

Set `DB_HOST`, `DB_NAME`, `DB_USER`, and `DB_PASSWORD` to configure the MySQL connection. Defaults target a local XAMPP MySQL installation (`127.0.0.1`, database `csc2130_project`, user `root`, empty password); change them before deployment. Set `PASSWORD_RESET_BASE_URL` to the public URL of `reset-password.php` when deploying the site somewhere other than `http://localhost/CSC2130-project/`. Reset links expire after 30 minutes.

The site’s static pages can still be opened directly or with Live Server, but PHP pages and endpoints require Apache/PHP. The `.vscode/launch.json` configuration is for the static site and does not run PHP.
