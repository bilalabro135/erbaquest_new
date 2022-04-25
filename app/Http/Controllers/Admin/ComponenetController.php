<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ComponentRequest;
use App\Models\Components;
class ComponenetController extends Controller
{
    public function index($type)
    {
        $files = Storage::disk('sections')->files('');
        foreach($files as $fileIndex => $file){
            $files[$fileIndex] = str_replace(".blade.php","",$file);
        }
        if(!in_array($type, $files))
            abort(404);

        $component = Components::where('name', $type)->first();
        $fields = (isset($component->fields)) ? unserialize($component->fields) : array();  

        return view('admin.component.index', compact('files', 'type', 'fields'));
    }
    public function save(ComponentRequest $request)
    {
        $settings = $request->getComponentSettings();

        // dd($settings);

        $count = Components::where('name', $settings['name'])->count();
        if ($count < 1) {
            $component = new Components();
            $component->name = $settings['name'];
            $component->fields = $settings['fields'];
            $component->save();
            return back()->with(['msg' => 'Component Inserted', 'msg_type' => 'success']);
        }
        else{
            $component = Components::where('name', $settings['name'])->update(['fields' => $settings['fields']]);
            return back()->with(['msg' => 'Component Updated', 'msg_type' => 'success']);
        }
    }
}
