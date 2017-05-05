#Prevent the httpoxy vulnerability see: https://httpoxy.org/
<IfModule mod_headers.c>
    RequestHeader unset Proxy
</IfModule>

<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews
    </IfModule>

    RewriteEngine On
    
    # Remove www uncomment to activate
    #RewriteCond %{HTTP_HOST} ^www\.(.*)$ [NC]
    #RewriteRule ^(.*)$ http://%1/$1 [R=301,L]

    # Force ssl uncomment to activate
    #RewriteCond %{HTTPS} !on
    #RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [R=301,L]
    #RewriteCond %{HTTP_HOST} !^$
    #RewriteCond %{HTTP_HOST} !^www\. [NC]
    #RewriteRule ^ http%1://www.%{HTTP_HOST}%{REQUEST_URI} [R=301,L]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)/$ /$1 [L,R=301]

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
</IfModule>
# Use PHP70 as default
AddHandler application/x-httpd-php70 .php
<IfModule mod_suphp.c>
    suPHP_ConfigPath /opt/php70/lib
</IfModule>
