# Renewing the Azure Refresh Token

The Microsoft refresh token expires after **90 days of inactivity**. When it expires, email sending will fail with `AADSTS700082`.

## Step 1 — Add the Redirect URI in Azure Portal

1. Go to [https://portal.azure.com](https://portal.azure.com)
2. Search for **App registrations** in the top search bar
3. Click on the app with client ID `657546db-e614-41a9-85cd-f9a9792ccf1d`
4. Click **Authentication** in the left menu
5. Under **Web** → **Redirect URIs**, click **Add URI**
6. Type exactly: `https://rumah.kuceng.my/price/reauth.php`
7. Click **Save**

## Step 2 — Run the Reauth Script

Visit: `https://rumah.kuceng.my/price/reauth.php`

- It will redirect you to Microsoft login
- Sign in as `juriah@kuceng.my`
- After consent, it redirects back and saves the new refresh token to `refresh_token_azure.txt`
- You will see a green ✅ success message

## Step 3 — Delete the Script

Once you see the success message, delete `reauth.php` — it contains the client secret and must not stay publicly accessible.

## Notes

- The `refreshAndSaveToken()` function in `config_price.php` automatically saves the new refresh token on every use, so as long as `mailer()` is called at least once every 90 days, the token will keep rolling and won't expire again.
- The reauth script is located at `htdocs/price/reauth.php`
- The refresh token is stored at `config/refresh_token_azure.txt`
