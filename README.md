# Price

A collaborative grocery price tracking web app where users can look up, compare, and submit prices for items across different shops.

## Features

- Browse items and compare prices across shops, sorted by price per unit
- Stale price detection — prices older than a configurable threshold are visually struck through
- Submit price updates, new items, new shops, and new variants
- Contributor role with direct write access; non-contributors submit for review via email
- Feedback/contact form
- Google OAuth login
- Cloudflare Turnstile bot protection (1-hour session gate)
- CSRF protection on all POST requests

## Tech Stack

- **Backend:** PHP (no framework)
- **Database:** SQLite via PDO
- **Auth:** Google OAuth 2.0 (`league/oauth2-client`, `league/oauth2-google`)
- **Frontend:** jQuery, Bootstrap, Tailwind CSS (gate page only), Vanilla JS
- **Email:** Microsoft Graph API (via Azure app)
- **Bot protection:** Cloudflare Turnstile

## Project Structure

```
htdocs/price/        # Application files
  api.php            # REST-style API endpoints
  index.php          # Entry point with Turnstile gate
  init.php           # Shared session/auth logic
  template.php       # Main HTML template
  js/app.js          # Frontend logic
  css/style.css      # Styles
  docs/              # Internal documentation
config/config_price.php   # App configuration (not committed)
config/price.db           # SQLite database (not committed)
library/vendor/           # Shared Composer dependencies
```

## Setup

1. Install dependencies:
   ```bash
   cd library
   composer install
   ```

2. Copy and configure:
   ```
   config/config_price.php
   config/refresh_token_azure.txt
   ```

3. Point your web server to `htdocs/` and ensure `config/price.db` is writable.

4. Visit `/price/` to access the app.

## Notes

- `config_price.php` and `refresh_token_azure.txt` contain secrets and should not be committed.
- Stale months threshold is configured via `PRICE_STALE_MONTHS` in `config_price.php`.
- Contributors are defined in `$contributor` array in `config_price.php`.
