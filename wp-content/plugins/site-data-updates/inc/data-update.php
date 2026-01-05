<?php

namespace GenerateUK\SiteDataUpdates;

/**
 * Class DataUpdate
 *
 * Base class containing abstract functionality, which may be useful for site data update operations.
 * Each implemented data version update class can inherit from this base class.
 *
 * DEVELOPER NOTE: For instructions on how to implement a new programmatic data update,
 * please see the plugin's README.md file.
 */
abstract class DataUpdate
    implements DataUpdateInterface
{

    /**
     * @var BasePlugin
     */
    protected BasePlugin $plugin;
    
    /**
     * @var \GenerateUK\SiteDataUpdates\LoggerInterface
     *      This class provides functionality to log the details of any data update operations.
     */
    protected LoggerInterface $log;

    /**
     * DataUpdate class constructor.
     *
     * @param BasePlugin $plugin
     *      Pass in an instance of the BasePlugin class, to provide access to its public methods & properties
     */
    public function __construct( BasePlugin $plugin ) {
        $this->plugin = $plugin;
        $this->log = $plugin->log;
    }
    
    /**
     * Apply any required programmatic updates to the site data.
     *
     * @return bool
     *      Returns TRUE if the data update succeeded, or FALSE otherwise
     */
    public function update(): bool {
        return true;
    }
    
}