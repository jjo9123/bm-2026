<?php

/************************************************************************************
 * The configuration values for this plugin can be updated here.                    *
 *                                                                                  *
 * To implement a new programmatic site data update, please follow the instructions *
 * within the plugin's README.md  file.                                             *
 *                                                                                  *
 ************************************************************************************/

namespace GenerateUK\SiteDataUpdates;

/**
 * Class Config
 */
class Config {
    
    /**
     * @var string
     *      The name of the WP option where the currently installed version of site data is stored
     */
    const NUM_INSTALLED_DATA_UPDATES_OPTION = 'guk_num_installed_site_data_updates';
    
    /**
     * @var string
     *      The name of the WP option that is stored if a data update is currently in progress
     */
    const UPDATE_IN_PROGRESS_OPTION = 'guk_site_data_update_in_progress';
    
    /**
     * @var string
     *      Domain to use for string translation
     */
    const TRANSLATION_DOMAIN = 'guk-site-data-updates';
    
}