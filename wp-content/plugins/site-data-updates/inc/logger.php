<?php

namespace GenerateUK\SiteDataUpdates;

/**
 * Class Logger
 *
 * This class provides functionality to log the details of any data update operations. The logged messages are output to
 * the CLI console (if the data update is being run via the CLI), as well as to the `/wp-content/debug.log` file (if the
 * `WP_DEBUG` and `WP_DEBUG_LOG` constants are defined & set to `TRUE` - e.g. within the `wp-config.php` file).
 *
 * DEVELOPER NOTE: For instructions on how to implement a new programmatic data update,
 * please see the plugin's README.md file.
 */
class Logger implements LoggerInterface {
    
    /**
     * @var BasePlugin
     */
    protected BasePlugin $plugin;
    
    /**
     * Logger class constructor.
     *
     * @param BasePlugin $plugin
     *      Pass in an instance of the BasePlugin class, to provide access to its public methods & properties
     */
    public function __construct( BasePlugin $plugin ) {
        $this->plugin = $plugin;
    }
    
    /**
     * Output an error message to the log(s) - e.g. to the CLI and/or to the `/wp-content/debug.log` file.
     *
     * This message will be prefixed with a mini summary of the data updates that have been processed so far.
     *
     * @param string $message - Message to output. You can use %d or %s as numeric or string placeholders, in addition
     *                          to the various other format specifiers supported by PHP's sprintf() function.
     * @param mixed  ...$args - 0 or more arguments that will replace the placeholder(s) in the $message string above.
     *
     * @return void
     * @throws \WP_CLI\ExitException
     */
    public function error( string $message, ...$args ): void {
        $formattedMsg = $this->_get_formatted_message( $message, $args );
        $this->plugin->cli->error_message( $formattedMsg );
        $this->log_to_file( $formattedMsg, 'error' );
    }
    
    /**
     * Output a warning message to the log(s) - e.g. to the CLI and/or to the `/wp-content/debug.log` file.
     *
     * This message will be prefixed with a mini summary of the data updates that have been processed so far.
     *
     * @param string $message - Message to output. You can use %d or %s as numeric or string placeholders, in addition
     *                          to the various other format specifiers supported by PHP's sprintf() function.
     * @param mixed  ...$args - 0 or more arguments that will replace the placeholder(s) in the $message string above.
     *
     * @return void
     */
    public function warning( string $message, ...$args ): void {
        $formattedMsg = $this->_get_formatted_message( $message, $args );
        $this->plugin->cli->warning_message( $formattedMsg );
        $this->log_to_file( $formattedMsg, 'warning' );
    }
    
    /**
     * Output a success message to the log(s) - e.g. to the CLI and/or to the `/wp-content/debug.log` file.
     *
     * This message will be prefixed with a mini summary of the data updates that have been processed so far.
     *
     * @param string $message - Message to output. You can use %d or %s as numeric or string placeholders, in addition
     *                          to the various other format specifiers supported by PHP's sprintf() function.
     * @param mixed  ...$args - 0 or more arguments that will replace the placeholder(s) in the $message string above.
     *
     * @return void
     */
    public function success( string $message, ...$args ): void {
        $formattedMsg = $this->_get_formatted_message( $message, $args );
        $this->plugin->cli->success_message( $formattedMsg );
        $this->log_to_file( $formattedMsg, 'success' );
    }
    
    /**
     * Output an info message to the log(s) - e.g. to the CLI and/or to the `/wp-content/debug.log` file.
     *
     * This message will be prefixed with a mini summary of the data updates that have been processed so far.
     *
     * @param string $message - Message to output. You can use %d or %s as numeric or string placeholders, in addition
     *                          to the various other format specifiers supported by PHP's sprintf() function.
     * @param mixed  ...$args - 0 or more arguments that will replace the placeholder(s) in the $message string above.
     *
     * @return void
     */
    public function info( string $message, ...$args ): void {
        $formattedMsg = $this->_get_formatted_message( $message, $args );
        $this->plugin->cli->info_message( $formattedMsg );
        $this->log_to_file( $formattedMsg, 'info' );
    }
    
    /**
     * Output an info message to the log(s) - e.g. to the CLI and/or to the `/wp-content/debug.log` file.
     *
     * This message will be prefixed with a mini summary of the data updates that have been processed so far.
     *
     * @param string $message - Message to output. You can use %d or %s as numeric or string placeholders, in addition
     *                          to the various other format specifiers supported by PHP's sprintf() function.
     * @param mixed  ...$args - 0 or more arguments that will replace the placeholder(s) in the $message string above.
     *
     * @return void
     */
    public function debug( string $message, ...$args ): void {
        $formattedMsg = $this->_get_formatted_message( $message, $args );
        $this->plugin->cli->debug_message( $formattedMsg );
        $this->log_to_file( $formattedMsg, 'debug' );
    }
    
    /**
     * Format a message by substituting any placeholder symbols (if applicable), and adding the current site ID as
     * a prefix to the resulting string.
     *
     * @param string $message - Message to output. You can use %d or %s as numeric or string placeholders,
     *   in addition to the various other format specifiers supported by PHP's sprintf() function.
     * @param array $args - Array containing zero or more elements that will replace the placeholder(s) in the
     *   $message string above.
     *
     * @return string
     */
    protected function _get_formatted_message( string $message, array $args ): string {
        return ( count( $args ) > 0 ? vsprintf( $message, $args ) : $message ) .
               sprintf( ' [Data Updates Status: Installed - %d, Current - %d, Total - %d]',
                        $this->plugin->get_number_of_installed_data_updates() ,
                        $this->plugin->get_current_data_update_number(),
                        $this->plugin->get_total_data_updates()
               );
    }
    
    /**
     * Store a log message in the `/wp-content/debug.log` file, e.g. to keep track of data update installation progress,
     * and to provide additional information to make it easier to debug any data update errors.
     *
     * Log messages will only be stored in this file if the `WP_DEBUG` and `WP_DEBUG_LOG` constants are defined and set
     * to `TRUE` - e.g. within the `wp-config.php` file. Messages will be prefixed with the `Site Data Updates` title
     * followed by the type of message (e.g. 'ERROR', 'INFO', etc), to avoid confusion as a result of messages logged by
     * other plugins.
     *
     * @param mixed $message - Log message to store
     * @param string $type - Type of message - typically this is set to 'error', 'warning', 'success', 'info' or 'debug'
     * @param bool $format - Format the output as supplied, retaining linebreaks, indentation etc? False by default.
     */
    public function log_to_file( mixed $message, string $type, bool $format = false ): void {
        if( ! defined( 'WP_DEBUG' ) ||
            ! defined( 'WP_DEBUG_LOG' ) ||
            ! WP_DEBUG ||
            ! WP_DEBUG_LOG
        ) {
            return;
        }
        
        $title = 'Site Data Updates - ' . strtoupper( $type ) . ': ';
        
        if( ! $format ) {
            error_log( $title . $message );
        } else {
            error_log( $title );
            error_log( '=================' );
            error_log( print_r( $message, true ) );
            error_log( '=================' );
        }
    }
    
}