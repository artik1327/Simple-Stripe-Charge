#Simple-Stripe-Charge

###This is a simple project

##Setup

    <VirtualHost *:80>
        ServerAdmin webmaster@localhost
        ServerName WhaMedia.com
        ServerAlias www.WhaMedia.com
        DocumentRoot /var/www/html/WhaMedia/public
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>


## Routes

    1. Example "WhaMedia.com" - Default Route with Stripe Form
    2. Example "WhaMedia.com/payment/charge" - Stripe charging route