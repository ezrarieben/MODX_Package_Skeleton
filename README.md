# MODX Skeleton Package

This is the Skeleton I use to develop MODX Packages.
## Instructions
### Preparing the package for development
> **NOTE:** Please make sure that you have a working installation of modx before doing any of the following steps

1. Create a directory (dev folder) on your webserver where you will develop the package (e.g: /var/www/html/dev/packages)
```bash
$ mkdir [path to webroot][desired folder name]
```
2. Clone the repo into the created directory
```
git clone https://github.com/ezrarieben/MODX_Package_Skeleton.git
```
3. Copy the content of the repo into a desired folder and delete the repo folder
```bash
$ cp -R [repo folder path]/* [dev folder path]
$ rm -rf [repo folder path]
```
4. Rename the folders and files to your desired package namespace (lowercase version of the package name eg: samplepackage)
```bash
$ find [dev folder path] -execdir rename 's/samplepackage/[package namespace]/' '{}' \+
```
5. Make sure the web user (eg. www-data:www-data) has access to, aswell as exec rights on all the files + folders
```bash
$ chown -R [web user]:[web user group] [dev folder path]
$ chmod -R 755 [dev folder path]
```
6. Change the following files to fit your package structure (Class names, variables etc.)<br>
    1. Package class (eg: core/components/samplepackage/model/samplepackage/samplepackage.class.php)
    2. Controller class (eg: core/components/samplepackage/controllers/index.class.php)
    3. Connector (eg: assets/components/samplepackage/connectors/connector.php)
7. Change the following files to fit your package structure if you are using a CMP otherwise delete them
    1. home.tpl (eg: core/components/samplepackage/templates/home.tpl)
    2. Mgr js files (eg: assets/components/samplepackage/mgr/*)
### Preparing MODX for package development
1. Create the following system settings
```
[namespace].core_path [absolute path to your package core eg: /var/www/html/dev/packages/MODX_SamplePackage/core/components/samplepackage/]
[namespace].assets_url  [absolute path to your package assets eg: /var/www/html/dev/packages/MODX_SamplePackage/assets/components/samplepackage/]
```
2. Adding the CMP
    1. System menu > Menus > Create Menu
    2. Set the "Lexicon Key" to your package name
    3. Set the "Action" to index
    4. Set the "Namespace" to your defined namespace
    
### Generating a schema
1. Go to your _build folder and copy the build.schema.config.sample.php file and name the copy build.schema.config.php
```bash
$ cd [path to _build]
$ cp build.schema.config.sample.php build.schema.config.php
```
2. Adjust the MODX_BASE_PATH Constant in build.schema.config.php
```php
define('MODX_BASE_PATH', '[absolute path to modx installation]');
```
3. Adjust lines 15, 16, 32 + 33 in build.schema.php to fit your needs
```php
'model' => dirname(dirname(__FILE__)) . '[relative path to your models]',
'schema_file' => dirname(dirname(__FILE__)) . '[relative path to your schema file]'
```
```php
$modx->addPackage('[namespace]', $sources['model']); // add package to make all models available
$manager->createObjectContainer('[main class name]'); // created the database table
```
4. Execute the build.schema.php script through your browser
### Generating a transport package
1. Create a new namespace
    1. System Menu > Namespaces
    2. Create a new namespace
    3. Set the "namespace" field to your desired namespace
    4. Set the "Core path" field to the absolute path of your package core (e.g. /var/www/html/dev/packages/MODX_SamplePackage/core/)
    5. Set the "Assets path" field to the absolute path of your package assets (e.g. /var/www/html/dev/packages/MODX_SamplePackage/assets/)
2. Go to your _build folder and copy the build.transport.config.sample.php file and name the copy build.transport.config.php
```bash
$ cd [path to _build]
$ cp build.transport.config.sample.php build.transport.config.php
```
3. Open the build.transport.config.php file and change line 10 to fit your needs
```php
define('MODX_BASE_PATH', '[absolute path to modx installation]');
```
4. Open the build.transport.php file and change lines 3, 13 + 14 to fit your needs
```php
$pkg_name = '[camel case package name]';
```
```php
$pkg_version = '[version]';
$pkg_release = '[dev|alpha|beta|rc etc.]';
```
5. Execute the build.transport.php script through your browser
6. Navigate to: MODX Core Directory > Packages. You'll find a freshly generated transport package for your extra.
