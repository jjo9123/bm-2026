# Site Data Updates Plugin

## Introduction

This plugin provides a relatively straightforward mechanism to make website content and/or
data changes programmatically within WordPress website(s), by implementing custom database
content update (aka 'migration') PHP script(s) that utilise standard WordPress functions
such as `wp_update_post()` to update content.

The plugin will automatically keep track of how many data updates are currently installed 
on the site, plus how many are still remaining, so that you can focus on writing just the
code that makes the relevant data updates, without worrying about the underlying 
implementation of the entire functionality. It is inspired by similar functionality 
that is directly built into other platforms and frameworks - such as Drupal, Magento, Oro,
Symfony, Laravel, and Phinx within CakePHP.

This provides one potential solution to safely deploy content changes into the `live` or
`production` environment (or indeed into any other copy of the site), with a far lower 
risk of inadvertently overwriting live content than replicating the entire database. The 
latter approach is strongly discouraged in general, see e.g. 
https://wpengine.com/support/development-workflow-best-practices#Database_Moves_Down_Code_Moves_Up

For details of other potential ways to safely deploy content changes into live 
environments, please also see:
https://wiki.guk.agency/manual/development-processes/article/wp-engine-development-deployment-workflow#_Tocl7vpl4g3dvn2

## Important Developer Notes

Each time you need to implement a new programmatic update of site data, create a new PHP 
file within the plugin's `data-updates` folder. This file should contain the PHP code to 
programmatically update the relevant site data as required, in a format similar to the 
example below:

```php
<?php

// Filepath: data-updates/data-update-1.php

namespace GenerateUK\SiteDataUpdates;

class DataUpdate1 extends DataUpdate {
    public function update(): bool {
        // Implement code here to perform the relevant update(s) to the site data, e.g.
        $success = update_post_meta( 1, 'my_key', 'New Value' );

        /* Return false & log details if any errors occurred when installing the update(s)
           (adapt this as required) */
        if( ! $success ) {
            $this->log->error( 'A problem occurred when installing data update 1.' );
            return false;
        }

        // Return true if the data update(s) succeeded
        return true;
    }
} ?>
```

The code in the new PHP file needs to meet the following requirements:

 * The file must be named `data-update-n.php` - where `n` is an integer referring to the 
   numerical index of the data update to install. So the name of the new file will 
   be `data-update-1.php` if this is the first data update that needs to be installed 
   on the site, `data-update-2.php` if this is the second data update that you are 
   implementing, `data-update-3.php` for the third data update, etc.

 * The file must contain a PHP class named `DataUpdateN`, where `N` is the same number
   that you specified in the filename. So if the filename is `data-update-1.php`, the
   PHP class should be named `DataUpdate1`; if the filename is `data-update-2.php`, the
   PHP class name should be `DataUpdate2`, etc.

 * The class must implement the interface `DataUpdateInterface`, as defined within the 
   plugin's `interfaces/data-update-interface.php` file. E.g. it must contain a public
   `update()` method. If it extends the `DataUpdate` class, this is handled automatically.

 * The `update()` method can include calls to built-in WP functions such as 
   `wp_insert_post()`, `wp_update_post()`, `add_post_meta()`, `update_post_meta()`
   `add_option()`, `update_option()`, `$wpdb->insert()`, `$wpdb->update()` etc, to update 
   any site data or content as required.

 * The `update()` method must return a value of `TRUE` if the update(s) succeeded, or 
   `FALSE` if it/they failed.

 * The `update()` method can also optionally log further details about any errors that 
   occurred, e.g. by calling the `$this->log->error()` method - this may be useful for
   debugging purposes.

 * If data update(s) need to be installed on multiple sites, use the built-in WP function 
   `switch_to_blog()` to apply the data update(s) on each site - _however it is important
   to use the `restore_current_blog()` WP function to return to the original site at the 
   end, regardless of whether the update(s) succeeded or not._

 * Note that the `/data-updates/data-update-1.php` file is supplied as an example - feel 
   free to update the code within this file to contain your own data update code (if you 
   haven't done so already), based on the above requirements.

In most cases, no further code changes should be required for this plugin to correctly 
handle the data update.

## Plugin Usage

To use this plugin, you first need to activate it via the WP admin area, or using the
[WP CLI](https://wp-cli.org/).

To install any available data updates that are not yet installed on this site, you then
need to open your terminal application, log into the server via SSH if needed, navigate to 
the directory containing the website files, and run the following command via the WP CLI:

```shell
$ wp data-updates install
```

**Note: If the website is hosted on WP Engine, you can run this command very easily 
without connecting to the server via SSH, by simply logging in to the WP Engine dashboard
and accessing the relevant site & environment, then clicking on the _Advanced_ tab, and 
entering the `data-updates install` command into the black area displayed at the top.**

By default, it will show you how many updates will be installed, and then ask you if you
want to proceed - type `y` and press enter to proceed, or anything else to halt 
installation. To skip this confirmation prompt, include the `--yes` flag in the command 
(_be careful if you do this!_). This may be necessary if you run the command via WP 
Engine's web UI as described above. So in other words, enter the command:

```shell
$ wp data-updates install --yes
```

By default, the command will display relatively detailed information about the 
installation process, including any errors encountered, so you can track progress and 
debug any issues. To suppress much of the command output, you can optionally use the 
`--quiet`flag:

```shell
$ wp data-updates install --quiet
```

You can quickly check the currently installed version of the site data, by navigating to 
the 'Plugins' area in the WP Dashboard of the **main** site. The number of currently 
installed site data updates - plus the number of site data updates that are not yet 
installed - are displayed within the listing for this plugin. These are shown in green if
all updates are installed, or orange if not. *Please note that this info is not displayed 
in the plugin listings on any sub-sites.*

Alternatively, you can see similar information by running the following CLI command:

```shell
$ wp data-updates status
```

The plugin can also store messages in the site logs, e.g. to keep track of data update 
installation progress, and to provide additional information to make it easier to debug
any data update errors. To enable this feature, the `wp-config.php` file on this site 
must be set up to include the following constants:

```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
```

When you do this, the resulting site log file will be located at `/wp-content/debug.log`

Each log message includes the plugin name, the type of log message, a description of 
the current operation, followed by a mini summary of the current plugin data update 
status - i.e. how many data updates are currently installed (if this is known, or 0 if 
this is unknown), which data update is currently being processed, and how many data update 
scripts were implemented in total.