<?php
/*
Plugin Name: Site Data Updates
Description: Provides functionality to programmatically update stored data on this website as required, e.g. if site content updates are needed.
Author: Patrick Hathway - Generate UK
Author URI: http://www.generateuk.co.uk/
Version: 1.2
*/

/************************************************************************************
 * IMPORTANT DEVELOPER NOTES:                                                       *
 *                                                                                  *
 * To implement a new programmatic site data update, please follow the instructions *
 * within the plugin's README.md file.                                              *
 *                                                                                  *
 ************************************************************************************/

namespace GenerateUK\SiteDataUpdates;

// Instantiate this plugin
$dataUpdaterPlugin = new BasePlugin();
$dataUpdaterPlugin->initialise();

/**
 * Class BasePlugin
 * All functionality related to the base plugin is encapsulated within this class, to prevent naming conflicts.
 */
class BasePlugin
{
    
    /*********************************************************************************************************
     * NOTE: For instructions on how to implement new data updates, please see the plugin's README.md file.  *
     *********************************************************************************************************/
    
    /**
     * @var \GenerateUK\SiteDataUpdates\LoggerInterface
     *    This class provides functionality to log the details of any data update operations.
     */
    public LoggerInterface $log;
    
    /**
     * @var \GenerateUK\SiteDataUpdates\CLIInterface
     *    This class wraps all functionality relating to the WP CLI and associated commands, ensuring that the relevant
     *    functionality only gets invoked if the WP CLI is available and is currently running.
     */
    public CLIInterface $cli;
    
    /**
     * Can data updates be installed on this site? Installation cannot be initiated unless this is set to TRUE.
     * Calling a method such as $this->check_for_data_updates() prior to calling the $this->install_data_updates()
     * will take care of this where applicable.
     *
     * @var bool
     */
    protected bool $_canInstallUpdates = false;
    
    /**
     * @var int
     *      Keeps track of the number of currently installed site data updates. Initially this is 0, as the correct
     *      number is not yet known. When checking if updates are available, this value will be updated accordingly;
     *      the value will then be incremented when attempting to install each data update,until all available updates
     *      are installed.
     */
    protected int $_currentNumInstalledUpdates = 0;
    
    /**
     * @var ?int
     *     Store the total number of implemented data update scripts. This is based on the number of files in the
     *     plugin's `data-updates/` subdirectory that have a filename of `data-update-*.php`. It is set to a value of
     *     NULL until the file system gets checked; after which it will contain the correct number.
     */
    protected ?int $_totalDataUpdates = NULL;
    
    /**
     * @var string
     *      Stores the base directory of this plugin
     */
    protected string $_pluginDir = '';

    /**
    * Instantiate the plugin, setting up all required file includes.
    */
    public function __construct() {
        $this->_load_file_includes();
    }
    
    /**
     * Load standard PHP file includes required by this plugin.
     *
     * [PHP files associated with each specific data update are included separately as part of the data update process.]
     */
    protected function _load_file_includes(): void {
        $this->_pluginDir = plugin_dir_path( __FILE__ );
        
        require_once( $this->_pluginDir . 'interfaces/cli-interface.php' );
        require_once( $this->_pluginDir . 'interfaces/logger-interface.php' );
        require_once( $this->_pluginDir . 'interfaces/data-update-interface.php' );
    
        require_once( $this->_pluginDir . 'inc/config.php' );
        require_once( $this->_pluginDir . 'inc/cli.php' );
        require_once( $this->_pluginDir . 'inc/logger.php' );
        require_once( $this->_pluginDir . 'inc/data-update.php' );
    }
    
    /**
     * Initialise the plugin, by setting up the logger & CLI, plus all required WP action and filter hooks.
     *
     * @return void
     */
    public function initialise(): void {
        $this->_setup_logger();
        $this->_setup_cli();
        $this->_setup_actions_and_filters();
    }
    
    /**
     * Set up implemented action and filter hooks.
     *
     * @return void
     */
    protected function _setup_actions_and_filters(): void {
        // Add filter hooks
        add_filter('plugin_row_meta', array($this, 'show_num_installed_site_data_updates_in_plugin_listing'), 10, 4 );
    }
    
    /**
     * Set up the logger.
     *
     * @param ?string $logger - Optional name of logger class to instantiate. If not specified, the default class
     *                          implemented within this plugin is used.
     *
     * @return void
     */
    protected function _setup_logger( ?string $logger = NULL ): void {
        if( isset( $logger ) ) {
            $log = new $logger( $this );
            if( $log instanceof LoggerInterface ) {
                $this->log = $log;
                return;
            }
        }
        
        $this->log = new Logger( $this );
    }
    
    /**
     * Set up the WP CLI and associated commands if available.
     *
     * @param ?string $cli - Optional name of CLI class to instantiate. If not specified, the default CLI class
     *                       implemented within this plugin is used.
     *
     * @return void
     *
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    protected function _setup_cli( ?string $cli = NULL ): void {
        $useCustomCLI = false;
        if( isset( $cli ) ) {
            $newCLI = new $cli($this);
            if( $newCLI instanceof CLIInterface ) {
                $this->cli = $newCLI; $useCustomCLI = true;
            }
        }
        
        if( ! $useCustomCLI ) {
            $this->cli = new CLI( $this );
        }
        
        try {
            $this->cli->add_commands();
        } catch(\Exception $e) {
            $this->log->error( 'Error setting up CLI commands: %s', $e->getMessage() );
        }
    }
    
    /**
     * Filters the array of row meta for each/specific plugin in the Plugins list table:
     *
     * On the base site, within the listing for this plugin, display the currently installed number of installed
     * site data updates.
     *
     * @param string[] $plugin_meta An array of the plugin's metadata, including the version, author,
     *                              author URI, and plugin URI.
     * @param string   $plugin_file Path to the plugin file relative to the plugins directory.
     * @param array    $plugin_data An array of plugin data.
     * @param string   $status      Status of the plugin. Defaults are 'All', 'Active',
     *                              'Inactive', 'Recently Activated', 'Upgrade', 'Must-Use',
     *                              'Drop-ins', 'Search', 'Paused'.
     *
     * @return array
     * @noinspection PhpUnusedParameterInspection
     * @noinspection PhpMissingReturnTypeInspection
     * @noinspection PhpMissingParamTypeInspection
     */
    public function show_num_installed_site_data_updates_in_plugin_listing(
        $plugin_meta, $plugin_file, $plugin_data, $status
    ) {
        // Don't update the listing for any plugins other than this one.
        if ( ! str_contains( $plugin_file, basename( __FILE__ ) ) ) {
            return $plugin_meta;
        }
        
        // Only update plugin listing on main site (avoids complexity of retrieving stored data updates on other sites).
        if( ! is_main_site() ) {
            return $plugin_meta;
        }
        
        // Find out current number of installed data updates; add to the plugin metadata to display in plugin listing.
        $numInstalledUpdates = $this->get_number_of_installed_data_updates();
        $numRemainingUpdates = $this->get_number_of_remaining_data_updates();
        
        $style = $numRemainingUpdates > 0 ? ' style="color: orange;"' : ' style="color: green;"';
        
        $plugin_meta[] = sprintf(
            __( '<b%s>Installed site data updates: %d</b>', Config::TRANSLATION_DOMAIN ),
            $style, $numInstalledUpdates
        );
        $plugin_meta[] = sprintf(
            __( '<b%s>Remaining site data updates: %d</b>', Config::TRANSLATION_DOMAIN ),
             $style, $numRemainingUpdates
        );
        
        return $plugin_meta;
    }
    
    /**
     * Check if any site data updates are ready to be installed.
     *
     * This method must be called before calling the `$this->install_data_updates()` method.
     *
     * DEVELOPER NOTE: For instructions on how to implement a new programmatic data update,
     * please see the plugin's README.md file.
     *
     * @return false|int - The number of data updates that are ready to be installed, or FALSE if no data updates can
     *                     be installed.
     */
    public function check_for_data_updates(): int|false {
        // Check if data update installation is allowed on this site.
        if( ! $this->_check_data_update_installation_is_allowed() ) {
            return false;
        }
        
        // Find out the current number of installed site data updates.
        $this->_currentNumInstalledUpdates = $this->get_number_of_installed_data_updates();
        
        // Stop processing if number of installed updates matches total number of updates, as no data updates are needed
        if($this->_currentNumInstalledUpdates == $this->get_total_data_updates() ) {
            $this->log->success( 'All available data updates have already been installed on this site!' );
            return false;
        }
        
        // Allow data updates to be installed by calling the `$this->install_data_updates()` method.
        $this->_canInstallUpdates = true;
        
        return $this->get_total_data_updates() - $this->_currentNumInstalledUpdates;
    }
    
    /**
     * Do not allow data updates to run unless the update is being run from the main site only, an update is not
     * already in progress, and at least one data update has been implemented.
     *
     * @return bool
     */
    protected function _check_data_update_installation_is_allowed(): bool {
        if( ! is_main_site() ) {
            $this->log->error( 'Please ensure data updates are run from the main WP site, and not from a ' .
                               'sub-site. Data update script(s) might switch between site(s) automatically while ' .
                               'performing updates, before switching back to the main site.' );
            return false;
        }
        
        if( get_option( Config::UPDATE_IN_PROGRESS_OPTION ) ) {
            $this->log->error( 'A data update is already in progress!' );
            return false;
        }
        
        if( $this->get_total_data_updates() == 0 ) {
            $this->log->error( 'No data update scripts were found on this site! Please make sure the data ' .
                               'update script(s) were added to the correct location and use the correct filename ' .
                               'conventions. See the `Site Data Updates` plugin README file for further details.' );
            return false;
        }
        
        return true;
    }
    
    /**
     * Install any available data updates on the site(s).
     *
     * The `$this->check_for_data_updates()` method must be called before calling this method,
     * otherwise no data updates will get installed.
     *
     * DEVELOPER NOTE: For instructions on how to implement a new programmatic data update,
     * please see the plugin's README.md file.
     */
    public function install_data_updates(): void {
        /* Sanity check: Ensure data updates can be installed on this site. This should be the case if the
          `$this->check_for_data_updates()` method did not detect any issues. */
        if( ! $this->_canInstallUpdates ) {
            $this->log->error( 'Data updates cannot currently be installed on this site!' );
        }
        
        $errors = false;
        $this->log->info( 'Preparing to install all applicable site data updates.' );
    
        // Store the fact that an update is currently in progress, to protect against simultaneous execution of updates.
        update_option( Config::UPDATE_IN_PROGRESS_OPTION, true );
        
        // Iterate through all available data updates that are not yet installed
        $totalUpdates = $this->get_total_data_updates();
        while( $this->_currentNumInstalledUpdates < $totalUpdates ) {
            // Increment the current number of installed data updates to the index of the next update to install.
            $this->_currentNumInstalledUpdates++;
            
            // Attempt to install the data update that is currently being processed.
            $result = $this->_install_current_data_update();
            $this->cli->current_data_update_has_finished( $result );
            if( ! $result ) {
                // If data update errors occurred, remember this, and don't try to install any further updates.
                $errors = true;
                break;
            }
        }
        
        // We can remove the option keeping track of the in progress updates, now that all updates have been processed.
        delete_option( Config::UPDATE_IN_PROGRESS_OPTION );
        
        if( ! $errors ) {
            $this->log->success( 'All applicable data updates have now been installed on this site!' );
        } else {
            $this->log->warning( 'Finished installing data updates. Please note that error(s) occurred while ' .
                                 'installing these updates!' );
        }
    }
    
    /**
     * Attempt to install the data update that is currently being processed.
     *
     * Return TRUE if this data update succeeded, or FALSE if it failed.
     *
     * DEVELOPER NOTE: For instructions on how to implement a new programmatic data update,
     * please see the plugin's README.md file.
     *
     * @return bool
     */
    protected function _install_current_data_update(): bool {
        // Check if file 'data-update-n.php' exists in plugin's 'data-update' folder ("n" is the data update number)
        $dataUpdateFilepath = $this->_pluginDir . 'data-updates/data-update-' .
            $this->_currentNumInstalledUpdates . '.php';
        if( ! is_file( $dataUpdateFilepath ) ) {
            $this->log->error( 'Cannot install data update %d - file "%s" does not exist!',
                               $this->_currentNumInstalledUpdates, $dataUpdateFilepath );
            return false; // Prevent installation of any further data updates
        }
    
        $this->log->info( 'Starting installation of data update %d.', $this->_currentNumInstalledUpdates );
    
        // Load the relevant PHP file include
        require_once( $dataUpdateFilepath );
        
        // Check if the loaded PHP file contains a class named 'DataUpdateN' ("N" is the data update number)
        $dataUpdateClassname = 'GenerateUK\SiteDataUpdates\DataUpdate' . $this->_currentNumInstalledUpdates;
        if( ! class_exists( $dataUpdateClassname ) ) {
            $this->log->error( 'Cannot install this data update - class "%s" does not exist!',
                               $dataUpdateClassname );
            return false; // Prevent installation of any further data updates
        }
    
        // Check if the relevant class contains an update() method
        if( ! method_exists( $dataUpdateClassname, 'update' ) ) {
            $this->log->error( 'Cannot install this data update - class "%s" does not include an "update()" ' .
            'method!', $dataUpdateClassname );
            return false; // Prevent installation of any further data updates
        }
    
        // Instantiate the correct data update class; make sure class implements expected interface.
        /** @var DataUpdate $dataUpdate */
        $dataUpdate = new $dataUpdateClassname( $this );
        if( ! ( $dataUpdate instanceof DataUpdateInterface ) ) {
            $this->log->error( 'Cannot install this data update - class "%s" does not conform to the ' .
            'interface "DataUpdateInterface"!', $dataUpdateClassname );
            return false; // Prevent installation of any further data updates
        }
        
        // Run `update()` method of new $dataUpdate object, to attempt to install data update.
        $result = $dataUpdate->update();
        if( ! $result ) {
            $this->log->error( 'Data update %d could not be installed successfully!',
                               $this->_currentNumInstalledUpdates );
            return false; // Prevent installation of any further data updates
        }
        
        // Store the new data version, to ensure the relevant update is not re-installed in the future
        $this->_update_stored_number_of_installed_data_updates( $this->_currentNumInstalledUpdates );
        $this->log->success( 'Data update %d was installed successfully!',
                             $this->_currentNumInstalledUpdates );
        
        // Indicate that the update installed successfully
        return true;
    }
    
    /**
     * Retrieve the currently stored number of installed site data updates from the appropriate site option in the DB.
     *
     * This will be a value of 0 if the number of installed updates is unknown (e.g. if no data updates have previously
     * been installed, or if we're not currently on the main site where this number is stored).
     *
     * @return int
     */
    public function get_number_of_installed_data_updates(): int {
        if( ! is_main_site()) {
            return 0;
        }
        
        return (int)get_option( Config::NUM_INSTALLED_DATA_UPDATES_OPTION, 0 );
    }
    
    /**
     * Get the numeric index of the data update that is currently being processed.
     *
     * This will be a value of 0 if no updates have been processed yet (e.g. if no data updates have previously
     * been installed, or if we're not currently on the main site).
     *
     * @return int
     */
    public function get_current_data_update_number(): int {
        return $this->_currentNumInstalledUpdates;
    }
    
    /**
     * Find out the total number of implemented data update scripts. This is based on the number of files in the
     * plugin's `data-updates/` subdirectory that have a filename of `data-update-*.php`.
     *
     * The relevant value is cached in memory to avoid unnecessary filesystem checks.
     *
     * @return int
     */
    public function get_total_data_updates(): int {
        if ( ! isset( $this->_totalDataUpdates ) ) {
            $dataUpdateScripts = glob( $this->_pluginDir . 'data-updates/data-update-*.php' );
            $this->_totalDataUpdates = empty( $dataUpdateScripts ) ? 0 : count( $dataUpdateScripts );
        }
        
        return $this->_totalDataUpdates;
    }
    
    /**
     * Get the number of remaining data updates that still need to be installed on this site.
     *
     * This is based on the total number of data update scripts that have been implemented, minus
     * the number of updates that have been installed on this site already.
     *
     * @return int
     */
    public function get_number_of_remaining_data_updates(): int {
        return $this->get_total_data_updates() - $this->get_number_of_installed_data_updates();
    }
    
    /**
     * Store the new number of installed data updates in the DB after a data update was installed, to ensure the update
     * is not re-installed in the future.
     *
     * @param int $numInstalledUpdates
     */
    protected function _update_stored_number_of_installed_data_updates( int $numInstalledUpdates ) : void {
        update_option( Config::NUM_INSTALLED_DATA_UPDATES_OPTION, $numInstalledUpdates );
    }
    
}