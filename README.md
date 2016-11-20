# ncrl
mgiozzo
bumbone

//changest to version 0.0.6

 Euroteam v.0.0.5/app/code/local/Euroteam/Ncrl/Block/Form.php               |   5 -
 Euroteam v.0.0.5/app/code/local/Euroteam/Ncrl/Block/Formmax.bak.php        |  27 +++
 Euroteam v.0.0.5/app/code/local/Euroteam/Ncrl/Model/Observer.php           |  32 +++
 .../app/code/local/Euroteam/Ncrl/controllers/Checkout/CartController.php   | 116 +++++++++++
 .../app/code/local/Euroteam/Ncrl/controllers/FormController.php            |   2 +-
 Euroteam v.0.0.5/app/code/local/Euroteam/Ncrl/etc/config.xml               |  28 ++-
 .../local/Euroteam/Ncrl/sql/newspaper_setup/mysql4-upgrade-0.0.5-0.0.6.php |  20 ++
 .../app/design/frontend/base/default/template/newspaper/        |  55 ++---
 .../app/design/frontend/base/default/template/newspaper/formax.bak.phtml   | 365 ++++++++++++++++++++++++++++++++++
 .../template/venustheme/tempcp/cartedit/checkout/cart/item/default.phtml   | 307 ++++++++++++++++++++++++++++
 Euroteam v.0.0.5/app/etc/modules/Euroteam_Ncrl.xml                         |   2 +-
 Euroteam v.0.0.5/skin/frontend/base/default/js/custom.js                   |  26 ++-


 admin@magento ncrl/Euroteam v.0.0.5$ cp -R app /var/www/magento/bonobo/
 admin@magento ncrl/Euroteam v.0.0.5$ cp -R skin /var/www/magento/bonobo/

 admin@magento magento/bonobo$ sudo rm -rf var/cache/ var/session/



provagiac