<?php

namespace GenerateUK\SiteDataUpdates;

/**
 * Interface DataUpdateInterface
 *
 * Each implemented site data version update class must conform to this interface,
 * for the data updates to function as expected.
 *
 * DEVELOPER NOTE: For instructions on how to implement a new programmatic data update,
 * please see the plugin's README.md file.
 */
interface DataUpdateInterface
{
    
    /**
     * Class constructor.
     *
     * @param BasePlugin $plugin
     *      Pass in an instance of the BasePlugin class, to provide access to its public methods
     */
    public function __construct( BasePlugin $plugin );
    
    /**
     * Apply all required programmatic updates to the site data. If these updates succeed, the
     * stored number of data updates that have been installed will automatically be incremented.
     *
     * @return bool
     *      Returns TRUE if the data update succeeded, or FALSE otherwise
     */
    public function update(): bool;
    
}