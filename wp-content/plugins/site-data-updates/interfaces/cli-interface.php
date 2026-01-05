<?php

/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace GenerateUK\SiteDataUpdates;

/**
 * Interface CLIInterface
 *
 * Classes based on this interface provide functionality to run data updates and output status messages via a CLI.
 * The class must take responsibility to ensure that the relevant functionality only gets invoked if the applicable CLI
 * is available and is currently running.
 *
 * DEVELOPER NOTE: For instructions on how to implement a new programmatic data update,
 * please see the plugin's README.md file.
 */
interface CLIInterface {
    
    /**
     * Class constructor.
     *
     * @param BasePlugin $plugin
     *      Pass in an instance of the BasePlugin class, to provide access to its public methods & properties
     */
    public function __construct( BasePlugin $plugin );
    
    /**
     * Add the CLI commands that can be executed. This should only occur if the relevant CLI is currently running.
     *
     * @throws \Exception
     */
    public function add_commands(): void;
    
    /**
     * Display an error message within the CLI.
     *
     * @param string|\WP_Error|\Exception|\Throwable $message Message to write to STDERR.
     * @param boolean|integer                        $exit    Exit script when error message gets displayed?
     *
     * @return void
     *
     * @throws \WP_CLI\ExitException
     *
     */
    public function error_message( string|\WP_Error|\Exception|\Throwable $message, bool $exit = false ): void;
    
    /**
     * Display a warning message within the CLI.
     *
     * @param string|\WP_Error|\Exception|\Throwable $message Message to write to STDERR.
     *
     * @return void
     */
    public function warning_message( string|\WP_Error|\Exception|\Throwable $message ): void;
    
    /**
     * Display a success message within the CLI.
     *
     * Typically recommended to inform user of successful script conclusion.
     *
     * @param string $message Message to write to STDOUT.
     *
     * @return void
     */
    public function success_message( string $message ): void;
    
    /**
     * Display an informational message within the CLI.
     *
     * @param string $message Message to write to STDOUT.
     *
     * @return void
     */
    public function info_message( string $message ): void;
    
    /**
     * Display a debug message within the CLI.
     *
     * Helpful for optionally showing greater detail when needed.
     *
     * @param string|\WP_Error|\Exception|\Throwable $message Message to write to STDERR.
     * @param string|bool                            $group   Organize debug message to a specific group. Use `false`
     *                                                        to not group the message.
     *
     * @return void
     */
    public function debug_message( string|\WP_Error|\Exception|\Throwable $message, bool $group = false ): void;
    
    /**
     * Is the code in this class being executed as a result of being run via a CLI command?
     *
     * This can be used to ensure that calls to CLI class methods won't get executed, unless the CLI is definitely
     * available, and is currently being run - thus avoiding the potential risk of fatal errors.
     *
     * For example:
     *
     * ```
     * if ( ! $this->is_cli_running() ) {
     *     return;
     * }
     *
     * // Add code to output a message to the CLI here.
     * ```
     *
     * @return bool
     */
    public function is_cli_running(): bool;
    
    /**
     * This method runs after each individual data update has been processed.
     *
     * It can be used to update the CLI's UI, based on the outcome from the installation of the relevant data update.
     *
     * @param bool $result - TRUE if the data update succeeded, FALSE otherwise.
     *
     * @return void
     */
    public function current_data_update_has_finished( bool $result ): void;
}