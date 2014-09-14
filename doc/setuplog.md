Notes on setting up Silex SimpleUser demo site
==============================================

## Install Silex skeleton

    PROJECT=silex-simpleuser-demo
    cd
    composer create-project fabpot/silex-skeleton ./$PROJECT
    sudo mv $PROJECT /var/www/

Tweak the Silex skeleton.

    cd /var/www/$PROJECT
    mkdir -p doc/silex-skeleton web/js/lib web/img web/css
    mv LICENSE doc/silex-skeleton/
    sudo chown -R www-data var

Update web/index_dev.php to allow access from your IP.


