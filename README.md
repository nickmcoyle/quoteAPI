# quoteAPI
A PHP API to return a random quote from a sqlite database for fun

must enable mod rewrite in web server and htaccess
need to add a .htaccess file in the parent folder

contents of .htaccess:
<IfModule mod_rewrite.c>
 RewriteEngine On
 RewriteCond %{REQUEST_FILENAME} !-f
 RewriteCond %{REQUEST_FILENAME} !-d
 RewriteRule quote/(.*)$ quote/api.php?request=$1 [QSA,NC,L]
</IfModule>

