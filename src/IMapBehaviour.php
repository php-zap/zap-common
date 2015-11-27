<?php

namespace Zap\Common;

/**
 * Interface for a map.
 * @package Zap\Common
 * @author Antonio Lopez <antonio.lopez.zapata@gmail.com>
 */
interface IMapBehaviour
{
    /**
     * Creates a new map from an array.
     * @param array $array The data for the new map.
     * @return IMapBehaviour The new instance.
     */
    public static function createFromArray(array $array): IMapBehaviour;

    /**
     * Merges the given array to the existing map.
     * @param array $data The new data to add to the existing map.
     */
    public function setAll(array $data);

    /**
     * Sets a new key-value pair to the map.
     * @param string $key The key for the map.
     * @param mixed $value The value for that key.
     */
    public function set(string $key, $value);

    /**
     * Gets a value from the map.
     * @param string $key The key to the desired value.
     * @param mixed|null $default Default value to return.
     * @return mixed The value for the given key.
     */
    public function get(string $key, $default = null);

    /**
     * Returns all the data.
     * @return mixed The whole array.
     */
    public function getAll(): array;

    /**
     * Removes a key from the map.
     * @param string $key The key for the value to remove.
     * @return bool True if it could be removed, false otherwise.
     */
    public function remove(string $key): bool;
}
