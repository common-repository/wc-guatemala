=== Guatemala States and Cities for WooCommerce ===
Contributors: xicoofficial, digitallabs
Tags: woocommerce, Guatemala, departamentos, ciudades, states cities,woocommerce departamentos de Guatemala, woocommerce ciudades de Guatemala, desplegable, departamentos desplegables, ciudades desplegables, city dropdown, state dropdown, city select, cities select, seleccionar ciudades,seleccionar departamentos
Requires at least: 5.8
Tested up to: 6.0
Requires PHP: 7.4
Stable tag: 3.0.4
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Wordpress plugin that adds Cities and Zones from Guatemala to woocomerce. Spetially usefull for replacing the post code field, since guatemalans hardly use or know their post code.

== Description ==

This WooCommerce plugin transforms the text input for states, cities and postcode into pre-populated dropdowns with information of Guatemala locations.

This will be shown in checkout pages, edit addresses pages, shipping calculator, etc.

= Supported Countries =
 * Guatemala

== Installation ==

= Minimum Requirements =

WordPress 4.0  or greater
Woocommerce 5.9 or greater
PHP version 7.2 or greater
MySQL version 5.6 or greater

= Automatic installation =

- Automatic installation is the easiest option as WordPress handles the file transfers itself and you don’t need to leave your web browser. To do an automatic install of WooCommerce, log in to your WordPress dashboard, navigate to the Plugins menu and click `Add New`.
- Search for "Departamentos y Ciudades de Guatemala para Woocommerce", install and activate.
- Available [@Github](https://github.com/DigitalLabsAgcy/wp-p-woocommerce-guatemala).


= Manual installation =

[See wordpress codex](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation)


= Updating =


Automatic updates should work like a charm; as is the best practice, back up should be undertaken before updates.

If on the off-chance you do encounter issues with the shop/category pages after an update you simply need to flush the permalinks by going to WordPress > Settings > Permalinks and hitting 'save'. That should return things to normal.


This section describes how to install the plugin and get it working.

e.g.

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Settings->Plugin Name screen to configure the plugin
4. (Make your instructions match the desired user flow for activating and installing your plugin. Include any steps that might be needed for explanatory purposes)


== Frequently Asked Questions ==

= It includes all the cities of the 22 departments?

It cinludes only the municipalities of each of the 22 departments.

= Something else you have not told me?

* In the shipping area so you can impose rules you must first add the department in the field of states

= They are not loading the states or departments at the checkout to what is due?

[Please view topic](https://wordpress.org/support/topic/conflicto-con-checkout-field-editor-for-woocommerce)

== Screenshots ==
1. States dropdown.
2. States dropdown on search.
3. Cities dropdown on search
4. Choose department WooCommerce.
5. Shipping rule by city
6. Reflection shipping rule by city

== Changelog ==
= 3.0.4 =
* 2022/10/30 Update - New 'alternative' names for municipalities and cities added to the database.

= 3.0.3 =
* 2022/10/02 Fix - Update SQL statement that triggered 'unexpected output' during activation.

= 3.0.2 =
* 2022/10/02 Fix - Update readme.txt file that prevented tags to be indexed propertly on WordPress repository.

= 3.0.1 =
* 2022/10/02 Fix - Tables weren't created after update.

= 3.0.0 =
* 30/09/2022 Tested with WC 6.9
* Added featured for replacing postcode with zones or towns dropdown.

= 1.0.1 =
* 17/10/2020 Tested with WC 4.4

= 1.0 =
* 01/09/2020 First release.


== Upgrade Notice ==
= 3.0 =
* Replace information with updated database of states, municipalities and zones or towns within municipalities.
* Updates postcode field dinamically after selecting municipality.

= 2.1 =
* Load states and cities alphabetically instead of following the order from the database.

= 2.0 =
* Fix compatibility issues with WooCommerce +5.0.0
* Read database for posible custom states/municipalities/cityes information.

= 1.0 =
* Include sanitization/escaping to comply with the WordPress development guidelines.


