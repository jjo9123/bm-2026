<?php

namespace GenerateUK\SiteDataUpdates;

/**
 * Class DataUpdate1
 *
 * This class is used to programmatically update the website data.
 *
 * [DEVELOPER NOTE: For instructions on how to implement a new programmatic data update,
 * please see the plugin's README.md file.]
 *
 * @noinspection PhpUnused
 */
class DataUpdate1 extends DataUpdate {
    
    /**
     * Apply any required programmatic update(s) to the site data.
     *
     * @return bool
     *      Returns TRUE if the data update succeeded, or FALSE otherwise
     */
    public function update(): bool {
        $success = true;
        
        /* Implement code here to perform the relevant update(s) to the site data... For example:
        
        // Add a new blog post (or page):
        $success = wp_insert_post( [ 'post_title' => 'My new post title', 'post_content' => 'My new post content',
                                     'post_status' => 'publish', post_author' => 1 ] );
        // OR update an existing post (by specifying the ID of the post to update):
        $success = wp_update_post( [ 'ID' => 1, 'post_title' => 'My updated post title',
                                     'post_content' => 'My updated post content', 'post_status' => 'publish' ] );
        
        // OR add a new custom post meta value:
        $success = add_post_meta( 1, 'my_key', 'New Value' );
        // OR update an existing post meta value:
        $success = update_post_meta( 1, 'my_key', 'Updated Value' );
        
        // OR add a new custom WP option:
        $success = add_option( 'my_custom_option', 'New Value' );
        // OR update the value of an existing WP option:
        $success = update_option( 'my_custom_option', 'New Value' );
        
        // OR insert a row of data into a specified database table:
        $success = $wpdb->insert( 'my_db_table', [ 'column1' => 'foo', 'column2' => 'bar' ] );
        // OR update an existing row of data in a specified database table (by specifying the ID of the row to update):
        $success = $wpdb->update( 'my_db_table', [ 'column1' => 'foo', 'column2' => 'bar' ], [ 'ID' => 1 ] );
        
        // etc
        */
        
        // Return false and log details if any errors occurred when installing the update(s) (adapt this as required)
        if( ! $success ) {
            $this->log->error( 'A problem occurred when installing data update 1.' );
            return false;
        }
        
        // Return true if the data update(s) succeeded
        return parent::update();
    }
}