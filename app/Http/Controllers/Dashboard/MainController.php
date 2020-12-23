<?php

namespace App\Http\Controllers\Dashboard;

use App\Clientinfo;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //index
    public function index()
    {
        return redirect('/dashboard/products');
        // return view('admin.home');
    }
    public function usersView()
    {   
        $clients = array();
        foreach (Clientinfo::get() as $client ) {
          $user = User::find($client->user_id);
          if($user){
 
            array_push($clients,array(

                    'user_id'=>$client->user_id,
                    'name' => $client->name,
                    'phone' => $client->phone,
                    'address' => $client->address,
                    'email' => $user->email,
                    'joined' => $user->created_at,
            ));
          }else{
              $client->delete();
          }
        }

        return view('dashboard.users.index',compact(
            'clients'
        ));
        // return view('admin.home');
    }
}
