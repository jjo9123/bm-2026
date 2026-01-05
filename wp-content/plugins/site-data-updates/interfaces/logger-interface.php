<?php

namespace GenerateUK\SiteDataUpdates;

/**
 * Interface LoggerInterface
 *
 * Classes based on this interface provide functionality to log the details of any data update operations.
 *
 * DEVELOPER NOTE: For instructions on how to implement a new programmatic data update,
 * please see the plugin's README.md file.
 */
interface LoggerInterface {
    
    /**
     * Class constructor.
     *
     * @param BasePlugin $plugin
     *      Pass in an instance of the BasePlugin class, to provide access to its public methods
     */
    public function __construct( BasePlugin $plugin );
    
    /**
     * Output an error message to the log(s).
     *
     * @param string $message   - Message to output. You can use %d or %s as numeric or string placeholders, in addition
     *                          to the various other format specifiers supported by PHP's sprintf() function.
     * @param mixed  ...$args   - 0 or more arguments that will replace the placeholder(s) in the $message string above.
     *
     * @return void
     */
    public function error( string $message, ...$args ): void;
    
    /**
     * Output a warning message to the log(s).
     *
     * This message will be prefixed with a mini summary of the data updates that have been processed so far.
     *
     * @param string $message   - Message to output. You can use %d or %s as numeric or string placeholders, in addition
     *                          to the various other format specifiers supported by PHP's sprintf() function.
     * @param mixed  ...$args   - 0 or more arguments that will replace the placeholder(s) in the $message string above.
     *
     * @return void
     */
    public function warning( string $message, ...$args ): void;
    
    /**
     * Output a success message to the log(s).
     *
     * This message will be prefixed with a mini summary of the data updates that have been processed so far.
     *
     * @param string $message   - Message to output. You can use %d or %s as numeric or string placeholders, in addition
     *                          to the various other format specifiers supported by PHP's sprintf() function.
     * @param mixed  ...$args   - 0 or more arguments that will replace the placeholder(s) in the $message string above.
     *
     * @return void
     */
    public function success( string $message, ...$args ): void;
    
    /**
     * Output an info message to the log(s).
     *
     * This message will be prefixed with a mini summary of the data updates that have been processed so far.
     *
     * @param string $message   - Message to output. You can use %d or %s as numeric or string placeholders, in addition
     *                          to the various other format specifiers supported by PHP's sprintf() function.
     * @param mixed  ...$args   - 0 or more arguments that will replace the placeholder(s) in the $message string above.
     *
     * @return void
     */
    public function info( string $message, ...$args ): void;
    
    /**
     * Output an info message to the log(s).
     *
     * This message will be prefixed with a mini summary of the data updates that have been processed so far.
     *
     * @param string $message   - Message to output. You can use %d or %s as numeric or string placeholders, in addition
     *                          to the various other format specifiers supported by PHP's sprintf() function.
     * @param mixed  ...$args   - 0 or more arguments that will replace the placeholder(s) in the $message string above.
     *
     * @return void
     */
    public function debug( string $message, ...$args ): void;
    
}