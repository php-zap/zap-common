<?php

namespace Zap\Common;

/**
 * A map with filtered values by type.
 * @package Zap\Common
 * @author Antonio Lopez <antonio.lopez.zapata@gmail.com>
 */
class FilteredMap implements Map
{
    /**
     * Map data.
     * @var array
     */
    private $data = [];

    public static function createFromArray(array $array): Map
    {
        $filteredMap = new FilteredMap();
        $filteredMap->setAll($array);
        return $filteredMap;
    }

    public function setAll(array $data)
    {
        $this->data = array_merge($this->data, $data);
    }

    public function set(string $key, $value)
    {
        $this->data[$key] = $value;
    }

    public function get(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public function getAll(): array
    {
        return $this->data;
    }

    public function remove(string $key): bool
    {
        if (isset($this->data[$key])) {
            unset($this->data[$key]);
            return true;
        }
        return false;
    }

    /**
     * Gets an int value from the map.
     * @param string $key The key to the desired value.
     * @param int|null $default Default value to return.
     * @return int The value for the given key.
     */
    public function getInt(string $key, int $default = null): int
    {
        return intval($this->get($key, $default));
    }

    /**
     * Gets a number from the map.
     * @param string $key The key to the desired value.
     * @param float|null $default Default value to return.
     * @return float The value for the given key.
     */
    public function getNumber(string $key, float $default = null): float
    {
        return floatval($this->get($key, $default));
    }

    /**
     * Gets a string from the map.
     * @param string $key The key to the desired value.
     * @param float|null $default Default value to return.
     * @return int The value for the given key.
     */
    public function getString(string $key, string $default = null): string
    {
        return (string)($this->get($key, $default));
    }
}
