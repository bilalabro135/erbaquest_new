<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PackagesRequest;

use App\Models\Package;
use DataTables;
use Bouncer;
use Redirect;
use Stripe;
class PackagesController extends Controller
{
    public function index(){
        return view('admin.packages.index');
    }

    public function getpackages()
    {
        $model = Package::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
             $actionBtn = '';
                if(Bouncer::can('updatePackages')){
                    $actionBtn .='<a href="' . route('packages.edit', ['package' => $row->id]) . '" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Bouncer::can('deletePackages')){
                $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="' .route('packages.delete', ['package' => $row->id]). '"><i class="fas fa-trash-alt"></i></a>';
                }
                return $actionBtn;
        })

        ->rawColumns(['action'])
        ->toJson();
    }

    public function create()
    {
        return view('admin.packages.add');
    }

    public function store(PackagesRequest $request)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/products');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "name=\"".$request->name);
        curl_setopt($ch, CURLOPT_USERPWD, config('services.stripe.secret') . ':' . '');

        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
             return Redirect::route('packages')->with(['msg' => 'Error:' . curl_error($ch), 'msg_type' => 'danger']);
        }
        else{
            $res = json_decode($result, true);
            if (isset($res['error'])) {
                return Redirect::route('packages')->with(['msg' => $res['error']['message'], 'msg_type' => 'danger']);
            }
            else{

                $stripe = new \Stripe\StripeClient(
                     config('services.stripe.secret')
                );
                $plan = $stripe->plans->create([
                    'amount' =>$request->price * 100,
                    'currency' => 'usd',
                    'interval' => $request->reccuring_every,
                    'product' => $res['id'],
                    'interval_count' => $request->duration,
                ]);
                if (isset($plan['id'])) {
                    $package = new Package();
                    $package->name = $request->name;
                    $package->description = $request->description;
                    $package->short_description = $request->short_description;
                    $package->price = $request->price;
                    $package->reccuring_every = $request->reccuring_every;
                    $package->duration = $request->duration;
                    $package->product_id = $res['id'];
                    $package->plan_id = $plan['id'];
                    $package->save();
                }
                else{
                    return Redirect::route('packages')->with(['msg' => 'Plan Creation Failed', 'msg_type' => 'danger']);
                }
            }
        }
        curl_close($ch);

       
        return Redirect::route('packages')->with(['msg' => 'Package Inserted', 'msg_type' => 'success']);
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(PackagesRequest $request, Package $package)
    {
        $package->update([
            'name' => $request->name,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'price' => $request->price,
            'reccuring_every' => $request->reccuring_every,
            'duration' => $request->duration,
        ]);

        return Redirect::route('packages')->with(['msg' => 'Package Updated', 'msg_type' => 'success']);
    }

    public function destroy($id)
    {
        $package = Package::where('id', $id)->delete();
        if ($package) {
            return Redirect::back()->with(['msg' => 'Package deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }
}
