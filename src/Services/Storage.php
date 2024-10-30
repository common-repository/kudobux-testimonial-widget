<?php

namespace Kudobuzz\Services;

class Storage
{
    /**
     * Save an option
     *
     * @param array $options
     * @return void
     */
    public static function save($options)
    {
        foreach($options as $key => $value) {
            update_option($key, $value);
        }
    }

    public static function saveOrUpdate(array  $options)
    {
        foreach($options as $key => $value) {
            if (get_option($key) || !empty(get_option($key))){
                add_option($key, $value);
            }
            update_option($key, $value);
        }
    }

    /**
     * Retrieve an option
     *
     * @param string $key
     * @return void
     */
    public static function get($key)
    {
        return get_option($key);
    }

    /**
     * Update an option
     *
     * @param array $options
     * @return void
     */
    public static function update($options)
    {
        foreach ($options as $key => $value) {
            update_option($key, $value);
        }
    }

    /**
     * Delete an option
     *
     * @param array|string $key
     * @return void
     */
    public static function remove($keys)
    {
        if (is_array($keys)) {
            foreach($keys as $key) {
                delete_option($key);
            }
        }

        delete_option($keys);
    }
}