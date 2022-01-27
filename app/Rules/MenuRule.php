<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MenuRule implements Rule
{

    public function __construct()
    {
        //
    }

    public $msg = '';


    public function validateMenu($menus){
        $ret = false;
        foreach ($menus as $key => $menu) {
            if (isset($menu['label']) && strlen($menu['label']) > 100){
                $this->msg = 'Title should be less then 100 char';
                $ret = false;
                break;
            }
            else if (isset($menu['url']) && strlen($menu['url']) > 255){
                $this->msg = 'Url too large, Url should be less then 255 char';
                $ret = false;
                break;
            }
            else if ( !isset($menu['url']) ){
                $this->msg = 'Url is required';
                $ret = false;
                break;
            }
            else if (isset($menu['attr_class']) && strlen($menu['attr_class']) > 80){
                $this->msg = 'Class attr should be less then 80 char';
                $ret = false;
                break;
            }
            else if (isset($menu['attr_id']) && strlen($menu['attr_id']) > 80){
                $this->msg = 'ID attr should be less then 255 char';
                $ret = false;
                break;
            }
            else{
               $ret = true; 
            }

            if (isset($menu['children'])) {
                 $ret = $this->validateMenu($menu['children']);
            }
        }


        return $ret;

    }

    public function passes($attribute, $value)
    {
        $ret = false;
        $menus = json_decode($value, true);
        return $this->validateMenu($menus);
    }

    public function message()
    {
        return $this->msg;
    }
}
