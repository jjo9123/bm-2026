<?php

/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace GenerateUK\SiteDataUpdates;

/**
 * Class CLI
 *
 * This class wraps all functionality relating to the WP CLI & associated commands that are implemented by this plugin,
 * ensuring that the relevant functionality only gets invoked if the WP CLI is available and is currently running.
 *
 * DEVELOPER NOTE: For instructions on how to implement a new programmatic data update,
 * please see the plugin's README.md file.
 */
class CLI implements CLIInterface {
    
    /**
     * @var BasePlugin
     */
    protected BasePlugin $plugin;
    
    /**
     * Progress bar object provided by the WP CLI.
     *
     * @var \cli\progress\Bar|\WP_CLI\NoOp
     */
    protected \cli\progress\Bar|\WP_CLI\NoOp $_progressBar;
    
    /**
     * CLI class constructor.
     *
     * @param BasePlugin $plugin
     *      Pass in an instance of the BasePlugin class, to provide access to its public methods & properties
     */
    public function __construct( BasePlugin $plugin ) {
        $this->plugin = $plugin;
    }
    
    /**
     * Add the WP CLI commands supported by this plugin. This will only occur if the WP CLI is currently running.
     *
     * @throws \Exception
     */
    public function add_commands(): void {
        if ( ! $this->is_cli_running() ) {
            return;
        }
        
        \WP_CLI::add_command( 'data-updates status', [ $this, 'status_command' ] );
        \WP_CLI::add_command( 'data-updates install', [ $this, 'install_command' ] );
    }
    
    /**
     * Get the current status of installed site data updates.
     *
     * ## EXAMPLES
     *
     *     wp data-updates status
     *
     * @throws \WP_CLI\ExitException
     */
    public function status_command(): void {
        if ( ! $this->is_cli_running() ) {
            return;
        }
        
        $this->_intro_message();
        
        $totalUpdates = $this->plugin->get_total_data_updates();
        $numInstalledUpdates = $this->plugin->get_number_of_installed_data_updates();
        $numRemainingUpdates = $this->plugin->get_number_of_remaining_data_updates();
        
        if ( $totalUpdates == 0 ) {
            $this->error_message( 'No data update scripts were found on this site! Please make sure the data ' .
            'update script(s) have been added to the correct location and use the correct filename conventions. See ' .
            'the `Site Data Updates` plugin README file for further details.', true );
        }
        
        if( ! is_main_site() ) {
            $this->warning_message( 'Please ensure this command is run for the main WP site - otherwise the info below ' .
                              'may not be correct, and no site data updates will be installed...' );
        }
        
        $this->info_message(
            sprintf( '%d site data update scripts have been implemented in total.', $totalUpdates ) );
        $this->info_message(
            sprintf( '%d of these data updates were installed on this site so far.', $numInstalledUpdates ) );
        $this->info_message(
            sprintf( '%d data updates are not yet installed on this site.', $numRemainingUpdates ) );
        
        if ( $numRemainingUpdates == 0 ) {
            $this->success_message( 'All available data updates have already been installed on this site!' );
        } else if ( $numInstalledUpdates == 0 ) {
            $this->warning_message( 'No data updates have been installed on this site yet...' );
        }
    }
    
    /**
     * Install all remaining site data updates.
     *
     * ## OPTIONS
     *
     * [--yes]
     * : Automatically install all remaining data updates without first confirming that you want to proceed.
     *
     * ## EXAMPLES
     *
     *     wp data-updates install
     *     wp data-updates install --yes
     *
     * @noinspection PhpUnusedParameterInspection*/
    public function install_command( $args, $assoc_args ): void {
        if ( ! $this->is_cli_running() ) {
            return;
        }
        
        $this->_intro_message();
        
        $availableUpdates = $this->plugin->check_for_data_updates();
        if( ! $availableUpdates ) {
            return;
        }
        
        $this->info_message( sprintf(
            '%d data update(s) are ready to be installed on this site.', $availableUpdates ) );
        \WP_CLI::confirm( "Are you sure you want to proceed?", $assoc_args );
        
        $this->_progressBar = \WP_CLI\Utils\make_progress_bar(
            'Installing data updates...', $availableUpdates );
        $this->plugin->install_data_updates();
    }
    
    /**
     * Display an intro message when a WP CLI command gets run.
     *
     * @return void
     */
    protected function _intro_message(): void {
        $this->info_message( \WP_CLI::colorize( '%CSite Data Updates:%n' ) );
    }
    
    /**
     * This method runs after each individual data update has been processed.
     *
     * It can be used to update the CLI's UI, based on the outcome from the installation of the relevant data update.
     *
     * @param bool $result - TRUE if the data update succeeded, FALSE otherwise.
     *
     * @return void
     *
     * @noinspection PhpUnusedParameterInspection
     */
    public function current_data_update_has_finished( bool $result ): void {
        if( ! $this->is_cli_running() ) {
            return;
        }
        
        // Increment the WP CLI progress bar.
        $this->_progressBar->tick();
        
        // Finish displaying the WP CLI progress bar if all data updates have been installed.
        if( $this->plugin->get_number_of_remaining_data_updates() == 0 ) {
            $this->_progressBar->finish();
        }
    }
    
    /**
     * Display error message prefixed with "Error: ".
     *
     * @param string|\WP_Error|\Exception|\Throwable $message Message to write to STDERR.
     * @param boolean|integer                        $exit    Exit script when error message gets displayed?
     *
     * @return void
     *
     * @throws \WP_CLI\ExitException
     */
    public function error_message( string|\WP_Error|\Exception|\Throwable $message, bool $exit = false ): void {
        if ( ! $this->is_cli_running() ) {
            return;
        }
        
        \WP_CLI::error( $message, $exit );
    }
    
    /**
     * Display warning message prefixed with "Warning: ".
     *
     * Warning message is written to STDERR.
     *
     * @param string|\WP_Error|\Exception|\Throwable $message Message to write to STDERR.
     *
     * @return void
     */
    public function warning_message( string|\WP_Error|\Exception|\Throwable $message ): void {
        if ( ! $this->is_cli_running() ) {
            return;
        }
        
        \WP_CLI::warning( $message );
    }
    
    /**
     * Display success message prefixed with "Success: ".
     *
     * Success message is written to STDOUT.
     *
     * Typically recommended to inform user of successful script conclusion.
     *
     * @param string $message Message to write to STDOUT.
     *
     * @return void
     */
    public function success_message( string $message ): void {
        if ( ! $this->is_cli_running() ) {
            return;
        }
        
        \WP_CLI::success( $message );
    }
    
    /**
     * Display informational message without prefix.
     *
     * Message is written to STDOUT, or discarded when `--quiet` flag is supplied.
     *
     * @param string $message Message to write to STDOUT.
     *
     * @return void
     */
    public function info_message( string $message ): void {
        if ( ! $this->is_cli_running() ) {
            return;
        }
        
        \WP_CLI::log( $message );
    }
    
    /**
     * Display debug message prefixed with "Debug: " when `--debug` is used.
     *
     * Debug message is written to STDERR, and includes script execution time.
     *
     * Helpful for optionally showing greater detail when needed.
     *
     * @param string|\WP_Error|\Exception|\Throwable $message Message to write to STDERR.
     * @param string|bool $group Organize debug message to a specific group. Use `false` to not group the message.
     *
     * @return void
     */
    public function debug_message( string|\WP_Error|\Exception|\Throwable $message, $group = false ): void {
        if ( ! $this->is_cli_running() ) {
            return;
        }
        
        \WP_CLI::debug( $message, $group );
    }
    
    /**
     * Is the code in this class being executed as a result of being run via a WP CLI command?
     *
     * This can be used to ensure that calls to `\WP_CLI` class methods won't get executed, unless the WP CLI
     * is definitely available, and is currently being run - thus avoiding the potential risk of fatal errors.
     *
     * For example:
     *
     * ```
     * if ( ! $this->is_cli_running() ) {
     *     return;
     * }
     *
     * \WP_CLI::log( 'Output a message to the WP CLI console.' );
     * ```
     *
     * @return bool
     */
    public function is_cli_running(): bool {
        if ( defined( 'WP_CLI' ) && WP_CLI ) {
            return true;
        }
        
        return false;
    }
}