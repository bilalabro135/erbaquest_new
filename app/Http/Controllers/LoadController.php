<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Settings;

class LoadController extends Controller
{
    public function index(Pages $pages,  $id)
    {
        try{
            $Settings = Settings::get('general');
            if (isset($Settings['blog_page']) && $Settings['blog_page'] == $pages->slug) {
                $controller = app('App\Http\Controllers\Common\BlogController');            
            }
            else{
                if (!isset($pages->template) || $pages->template == null || $pages->template == '') {
                    abort(404);
                }
                $template =  ucfirst($pages->template);
                $controller_name = "{$template}Controller";
                $controller = app("App\Http\Controllers\Common\\" . $controller_name);
            }
        }
        catch (Exception $e){
            abort(404);
        }

        return $controller->show($pages,  $id);
    }
}
