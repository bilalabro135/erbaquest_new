<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pages;
use App\Models\Blog;
use App\Models\Category;
use App\Http\Requests\Admin\MenuRequest;
use Redirect;

class MenuController extends Controller
{
    public function index($type)
    {

        $menusArray = config('settings.menus');
        if (!in_array($type, $menusArray)) {
            abort(404, 'Menu not exists');
        }
        $menus = Menu::where('type', $type)->where('parent_id', null)-> orderBy('order', 'asc')->get();
        $all_menus = Menu::where('type', $type)->get();
        $pages = Pages::where('status', 'published')->get();
        $blogs = Blog::where('status', 'published')->get();
        $categories = Category::all();
        return view('admin.menu.index', compact('menus', 'pages', 'blogs', 'categories', 'all_menus'));
    }

    public function add($menu, $type, $parent = null)
    {
        if (!empty($menu)) {
            foreach ($menu as $key => $value) {
                
                $label =(empty($value['label'])) ? 'No Label' : $value['label'];
                $url = (empty($value['url'])) ? '#' : $value['url'];

                if (isset($value['id'])) {
                    if (isset($value['delete']) && $value['delete']) {
                         Menu::where('id', $value['id'])->delete();
                         if (array_key_exists('children', $value)) {
                             foreach($value['children'] as $childkey => $child){
                                $value['children'][$childkey]['delete'] = true;
                             }
                         }
                    }
                    else{
                        $updateMenu = Menu::where('id', $value['id'])->update([
                            'title' => $label,
                            'link' => $url,
                            'order' => $key,
                            'parent_id' => $parent,
                            'attr_class' => (!isset($value['attr_class']) || empty($value['attr_class'])) ? '' : $value['attr_class'],
                            'attr_id' => (!isset($value['attr_id']) ||empty($value['attr_id'])) ? '' : $value['attr_id'],
                        ]);
                    }
                }
                else{            
                    $addMenu = new Menu;
                    $addMenu->title = $label;
                    $addMenu->link = $url;
                    $addMenu->type = $type;
                    $addMenu->order = $key;
                    $addMenu->parent_id = $parent;
                    $addMenu->attr_class =  (!isset($value['attr_class']) || empty($value['attr_class'])) ? '' : $value['attr_class'];
                    $addMenu->attr_id =  (!isset($value['attr_id']) ||empty($value['attr_id'])) ? '' : $value['attr_id'];
                    $addMenu->save();
                }

                $link_id = (isset($value['id'])) ? $value['id'] : $addMenu->id;
                if (array_key_exists('children', $value))
                    $this->add($value['children'], $type, $link_id);
            }
        }
        
    }

    public function store(MenuRequest $request)
    {
        $menu = json_decode($request->menu, true);
        // dd($menu);
        $this->add($menu, $request->menu_type);
        return Redirect::route('menus', ['type'=>$request->menu_type ])->with(['msg' => 'Menu Updated', 'msg_type' => 'success']);
    }


}
