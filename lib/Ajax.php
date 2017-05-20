<?php

namespace ReCHallenge;

/**
 * Handle AJAX requests.
 *
 * @package ReCHallenge
 */
class Ajax
{
    /**
     * FlitCie refresh interval in seconds.
     */
    const FLITCIE_REFRESH_INTERVAL = 3600;

    /**
     * Hook into WordPress.
     */
    static function register_hooks()
    {

        // FlitCie
        add_action('wp_ajax_photo_album', [__CLASS__, 'flitcie']);
        add_action('wp_ajax_nopriv_photo_album', [__CLASS__, 'flitcie']);
    }

    /**
     * Load latest FlitCie entries.
     */
    static function flitcie()
    {

        $last_call = get_option("_rechallenge_flitcie_last_api_call");

        // Reload FlitCie data
        if (empty($last_call) || $last_call < time() - self::FLITCIE_REFRESH_INTERVAL) {

            $album_group_id = "57661"; // Album for 60.

            // Get latest members from album
            $latest = self::_flitcie_latest($album_group_id);

            // Get album meta from latest albums
            $albums = self::_flitcie_album_meta($latest);

            // Output response
            wp_send_json($albums);
        } else {

            // Get from db
            $data = get_option("_rechallenge_flitcie_cache");

            // Output response
            wp_send_json($data);
        }

        wp_die();
    }

    private static function _flitcie_latest($album_id)
    {

        // Make API call
        $response = wp_remote_get("https://flitcie.ch.tudelft.nl/rest/item/".$album_id, [
            'headers' => [
                'X-Gallery-Request-Key' => 'bdb82b906ea94ccf64ae7de9025b9fd5',
                'X-Gallery-Request-Method' => 'get',
            ],
        ]);

        // Check status header
        $code = wp_remote_retrieve_response_code($response);
        if ($code !== 200) {
            wp_send_json_error();
        }

        // Get body
        $json = wp_remote_retrieve_body($response);
        $data = json_decode($json);

        // Check if album has members
        if (empty($data->members)) {
            wp_send_json_error();
        }

        // Get latest members
        $latest = array_slice($data->members, -3, 3);

        return $latest;
    }

    private static function _flitcie_album_meta($members)
    {

        // Check if argument is array
        if (! is_array($members)) {
            return [];
        }

        // Make API call
        $response = wp_remote_get("https://flitcie.ch.tudelft.nl/rest/items/?type=album&urls=".json_encode($members), [
            'headers' => [
                'X-Gallery-Request-Key' => 'bdb82b906ea94ccf64ae7de9025b9fd5',
                'X-Gallery-Request-Method' => 'get',
            ],
        ]);

        // Check status header
        $code = wp_remote_retrieve_response_code($response);
        if ($code !== 200) {
            wp_send_json_error();
        }

        // Get body
        $json = wp_remote_retrieve_body($response);
        $data = json_decode($json);

        // Process data
        $albums = [];

        foreach ($data as $album) {

            // Make sure we have a URL and entity data
            if (empty($album->url) || empty($album->entity)) {
                return;
            }

            $albums[] = [
                'url' => $album->url,
                'title' => $album->entity->title,
                'cover' => $album->entity->thumb_url_public,
            ];
        }

        // Reverse albums (DESC)
        $albums = array_reverse($albums);

        // Cache
        update_option("_rechallenge_flitcie_last_api_call", time());
        update_option("_rechallenge_flitcie_cache", $albums);

        return $albums;
    }
}
