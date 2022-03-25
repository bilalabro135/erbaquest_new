<?php

namespace App\Http\Controllers\Common;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SettingsRequest;
use App\Models\Settings;
use App\Models\Pages;
use Bouncer;
class SettingsController extends Controller
{    
    public function index(Request $request)
    {    
        $type = $request->type;
        $Settings = Settings::get($request->type);        
        $roles = Bouncer::role()->all()->pluck('name');
        $pages = Pages::where('status', 'published')->get();
        if (view()->exists('admin.settings.' . $request->type)) {
            return view('admin.settings', compact('type', 'Settings', 'roles', 'pages'));            
        }
        else{
            abort(404);
        }
    }
    public function save(SettingsRequest $request)
    {
        $validator = $request->validated();
        $msg = '';
        $settingData = $request->getSettings();
        $ifSettingGroupExsist = Settings::where('name', '=', $settingData['name'])->count();
        if ($ifSettingGroupExsist > 0) {
            Settings::where('name', '=', $settingData['name'])->update(['value' => $settingData['value']]);
            $msg = 'Setting Updated';
        }
        else{
            $Settings = new Settings();
            $Settings->name = $settingData['name'];
            $Settings->value = $settingData['value'];            
            $Settings->save();
            $msg = 'Setting Inserted';
        }
        return back()->with(['msg' => $msg, 'msg_type' => 'success']);
    }

}
