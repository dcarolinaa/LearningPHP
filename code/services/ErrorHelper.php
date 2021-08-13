<?php
namespace App\services;

class ErrorHelper
{
    private $store;

    public function __construct(&$store)
    {
        $this->store = & $store;
        if (!isset($this->store['_errors'])) {
            $this->store['_errors'] = [];
        }
    }

    public function set($attribute, $error, $value)
    {
        if (!isset($this->store['_errors'][$attribute])) {
            $this->store['_errors'][$attribute] = [];
        }

        $this->store['_errors'][$attribute][$error] = $value;
    }

    public function get($key)
    {
        if (isset($this->store['_errors'][$key])) {
            $value = $this->store['_errors'][$key];
            unset($this->store['_errors'][$key]);

            return $value;
        }

        return null;
    }

    public function getAll()
    {
        $errors = $this->store['_errors'];
        $this->store['_errors'] = [];
        return count($errors) ? $errors : false;
    }

    public function hasErrors()
    {
        return count($this->store['_errors']) > 0;
    }
}
