<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalSettings extends Model
{

    protected $settings;

    public function __construct( $settings)
    {
        $this->settings = (isset($settings->value)) ?  unserialize($settings->value) : array();
    }

    public function getAll(){
        return $settings;
    }
    public function getValue(string  $key){
        if (isset($this->settings[$key])) {
            return $this->settings[$key];
        }
        return false;
    }
}
