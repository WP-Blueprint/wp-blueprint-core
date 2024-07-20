# Installation Guide

Follow these steps to install and configure the WP Blueprint Core package in your project.

## Step 1: Install the Package via Composer

Run the following command in your project directory to add the WP Blueprint Core package as a dependency:

```bash
composer require wp-blueprint/core
```

This command tells Composer to download the WP Blueprint Core package and include it in your project's `composer.json` file.

## Step 2: Autoload Your Dependencies

To use the package in your project, you need to include Composer's autoload file. Add the following code to your project's main PHP file (e.g., `functions.php` for WordPress themes, or the main plugin file for WordPress plugins):

```php
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;
```

This code checks if the Composer autoload file exists in the `vendor` directory of your project. If it does, the file is included with `require_once`, ensuring that all Composer-managed dependencies, including the WP Blueprint Core package, are properly autoloaded and available for use in your project.
