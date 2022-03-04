<?php

if (!function_exists('getRouteArray')) {
	function getRouteArray()
	{
        $slugs  = ['admin'];
        $routes = Route::getRoutes();

        foreach ($routes as $route)
        {
            $parts = explode('/', $route->uri());
            if (!in_array('admin', $parts)) {
                foreach ($parts as $part)
                {               
                    $slugs[] = $part;
                }
            }

        }
        return $slugs;
	}
}


if (!function_exists('prepareSlug')) {
	function prepareSlug($model, $slug){
		$exsist = true;

        while($exsist){
            $page = $model->where('slug', $slug)->first();
            if (isset($page->slug) || in_array($slug, getRouteArray())) {
                $last_char = substr($slug, -1);
                if (is_numeric($last_char) && $last_char != 9) {
                   $slug = substr_replace($slug , ($last_char + 1),-1);
                }
                else{
                    $slug = $slug . '-1';
                }
            }
            else{
                $exsist = false;
            }   
        }
        return $slug;
	}
}

if (!function_exists('get_url')) {
    function get_url($url)
    {
        if ($url != '' && $url != '#' ) {
            if(strpos($url, 'http') !== false){

            }
            else if(strpos($url, 'www') !== false){

            }
            else{
                $url = env('APP_URL') . $url;
            }
            
        }
        return $url;
    }
}