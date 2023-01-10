<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rules;
use App\Models\Partner;
use App\Models\Company;
use App\Models\mainCompany;
use App\Models\UserPermissions;
use Illuminate\Support\Facades\Storage;
use File;
use Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users = User::paginate(20);
        $Rules = Rules::all();
        $Company = Company::all();
        $mainCompany = mainCompany::all();
        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","USERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show users list view")));
		return view('users.index', ['Users' => $Users,'Rules' => $Rules,'Company' => $Company,'mainCompany' => $mainCompany,'SearchFieldMode' => false, 'SearchField' => false]);
    }


        /**
     * Search the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePartnerRequest  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {
            if($request->field){
                $Users = User::where('username', 'like','%'.$request->field.'%')->paginate(20);
                $Rules = Rules::all();
                $Company = Company::all();
                $mainCompany = mainCompany::all();
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","USERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Search user : ".$request->field)));
                return view('users.index', ['Users' => $Users,'Rules' => $Rules,'mainCompany' => $mainCompany,'Company' => $Company,'SearchFieldMode' => true, 'SearchField' => $request->field]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","USERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot search user : ".$request->field)));
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {

        try {
            $userDetails = User::where('id','=',Auth::user()->id)->get();
            $PartnersCount = Partner::whereIn('company_id',Company::where('maincompany_id','=',Auth::user()->company_id)->get('id'))->count();
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","PROFILE",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show profile of user ID : ".Auth::user()->id)));
            return view('users.profile',['userDetails' => $userDetails,'PartnersCount' => $PartnersCount]);
        } catch (\Throwable $th) {
            //throw $th;
            Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("ERROR","PROFILE",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Can not show profile of user ID : ".Auth::user()->id)));
        }
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->email && $request->password) {
            try {
                $NewUser = new User();
                $NewUser->lastname = $request->lastname;
                $NewUser->firstname = $request->firstname;
                $NewUser->username = $request->username;
                $NewUser->email = $request->email;
                $NewUser->password = Hash::make($request->password);
                $NewUser->rule_id = $request->rule;
                $NewUser->company_id = $request->companies;
                $NewUser->active = $request->active ? '1' : '0';
                $NewUser->save();

                if($request->rule == 1){
                    //Admin rule
                    $data = [
                        ['user_id'=>$NewUser->id, 'permission_id'=> 1],['user_id'=>$NewUser->id, 'permission_id'=> 2],['user_id'=>$NewUser->id, 'permission_id'=> 3],['user_id'=>$NewUser->id, 'permission_id'=> 4],
                        ['user_id'=>$NewUser->id, 'permission_id'=> 5],['user_id'=>$NewUser->id, 'permission_id'=> 6],['user_id'=>$NewUser->id, 'permission_id'=> 7],['user_id'=>$NewUser->id, 'permission_id'=> 8],
                        ['user_id'=>$NewUser->id, 'permission_id'=> 9],['user_id'=>$NewUser->id, 'permission_id'=> 10],['user_id'=>$NewUser->id, 'permission_id'=> 11],['user_id'=>$NewUser->id, 'permission_id'=> 12],
                        ['user_id'=>$NewUser->id, 'permission_id'=> 13],['user_id'=>$NewUser->id, 'permission_id'=> 14],['user_id'=>$NewUser->id, 'permission_id'=> 15],['user_id'=>$NewUser->id, 'permission_id'=> 16],
                        ['user_id'=>$NewUser->id, 'permission_id'=> 17],['user_id'=>$NewUser->id, 'permission_id'=> 18],['user_id'=>$NewUser->id, 'permission_id'=> 19],['user_id'=>$NewUser->id, 'permission_id'=> 20],
                        ['user_id'=>$NewUser->id, 'permission_id'=> 21],['user_id'=>$NewUser->id, 'permission_id'=> 22],['user_id'=>$NewUser->id, 'permission_id'=> 23],['user_id'=>$NewUser->id, 'permission_id'=> 24],
                        ['user_id'=>$NewUser->id, 'permission_id'=> 25],['user_id'=>$NewUser->id, 'permission_id'=> 26],['user_id'=>$NewUser->id, 'permission_id'=> 27],['user_id'=>$NewUser->id, 'permission_id'=> 28],
                        ['user_id'=>$NewUser->id, 'permission_id'=> 29],['user_id'=>$NewUser->id, 'permission_id'=> 30],['user_id'=>$NewUser->id, 'permission_id'=> 31],['user_id'=>$NewUser->id, 'permission_id'=> 32],
                        ['user_id'=>$NewUser->id, 'permission_id'=> 33]
                    ];
                }else if($request->rule == 2){
                    //Executive rule
                    $data = [
                        ['user_id'=>$NewUser->id, 'permission_id'=> 1],['user_id'=>$NewUser->id, 'permission_id'=> 2],['user_id'=>$NewUser->id, 'permission_id'=> 3],['user_id'=>$NewUser->id, 'permission_id'=> 4],
                        ['user_id'=>$NewUser->id, 'permission_id'=> 5],['user_id'=>$NewUser->id, 'permission_id'=> 7],['user_id'=>$NewUser->id, 'permission_id'=> 8],['user_id'=>$NewUser->id, 'permission_id'=> 9],
                        ['user_id'=>$NewUser->id, 'permission_id'=> 11],['user_id'=>$NewUser->id, 'permission_id'=> 12],['user_id'=>$NewUser->id, 'permission_id'=> 13],['user_id'=>$NewUser->id, 'permission_id'=> 15],
                        ['user_id'=>$NewUser->id, 'permission_id'=> 16],['user_id'=>$NewUser->id, 'permission_id'=> 17],['user_id'=>$NewUser->id, 'permission_id'=> 19],['user_id'=>$NewUser->id, 'permission_id'=> 24],
                        ['user_id'=>$NewUser->id, 'permission_id'=> 25],['user_id'=>$NewUser->id, 'permission_id'=> 26],['user_id'=>$NewUser->id, 'permission_id'=> 27],['user_id'=>$NewUser->id, 'permission_id'=> 28],
                        ['user_id'=>$NewUser->id, 'permission_id'=> 29],['user_id'=>$NewUser->id, 'permission_id'=> 30],['user_id'=>$NewUser->id, 'permission_id'=> 31],['user_id'=>$NewUser->id, 'permission_id'=> 32],
                        ['user_id'=>$NewUser->id, 'permission_id'=> 33]
                    ];
                }else if($request->rule == 3){
                    //Client rule
                    $data = [
                        ['user_id'=>$NewUser->id, 'permission_id'=> 1],['user_id'=>$NewUser->id, 'permission_id'=> 2],['user_id'=>$NewUser->id, 'permission_id'=> 3],['user_id'=>$NewUser->id, 'permission_id'=> 4]
                    ];
                }
                UserPermissions::insert($data);


                
                return redirect('/users');
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","USERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Add new user : ".$request->email)));
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","USER PERMISSION",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"User permission accorded to the new user with the rule ID : ".$request->rule)));

            } catch (\Throwable $th) {
                return redirect('/users');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $Users
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $User = User::where('id', $request->id)->first();
            if ($User) 
            {
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","USERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Show user details, id : ".$request->id)));
                return [
                    "lastname" => $User->lastname,
                    "firstname" => $User->firstname,
                    "username" => $User->username,
                    "email" => $User->email,
                    "rule" => $User->rule_id,
                    "companies" => $User->company_id,
                    "active" => $User->active,
                    "id" => $User->id
                ];
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $Users
     * @return \Illuminate\Http\Response
     */
    public function edit(User $Users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\User  $Users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->user_id){
            try {
                $User = User::where('id', $request->user_id)->first();
                if ($User) {
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","USERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Update user details, id : ".$request->user_id)));

                    $User->update([
                        "lastname" => $request->edit_lastname,
                        "firstname" => $request->edit_firstname,
                        "username" => $request->edit_username,
                        "email" => $request->edit_email,
                        "rule_id" => $request->edit_rule,
                        "company_id" => $request->edit_companies,
                        "active" => $request->edit_active ? '1' : '0'
                    ]);

                    if($request->edit_password){
                        $User->update(["password" => Hash::make($request->edit_password)]);
                    }

                    return redirect('/users');
                }
            } catch (\Throwable $th) {
                //throw $th;
                Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","USERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot update user details, id : ".$request->user_id)));

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $Users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        if($request->id != Auth::id()){
            try {
                $User = User::find($request->id);
                if($User){
                    if($User->delete()){
                        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","USERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Delete user , id : ".$request->id)));
                        return [
                            'Type' => 'SUCCESS',
                            'Message' => 'L\'utilisateur '.$User->username.' à bien été supprimer'
                        ];
                    }else{
                        Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","USERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"Cannot delete user, id : ".$request->id)));
                        return [
                            'Type' => 'ERROR',
                            'Message' => 'Impossible de supprimer l\'utilisateur '.$User->username.' !'
                        ];
                    }
                }else{
                    Storage::disk('local')->append("\logs\\".Auth::user()->id.".log", implode(";",array("SUCCESS","USERS",date('d-m-Y H:i:s'),$_SERVER['REMOTE_ADDR'] ?? 'XXX.XXX.XXX.XXX',"User not found in database, id : ".$request->id)));
                    return [
                        'Type' => 'WARNING',
                        'Message' => 'L\'utilisateur '.$User->username.' est introuvable dans la base de donnée!'
                    ];
                }
           } catch (\Throwable $th) {
            //throw $th;
           }
        }else{
            return false;
        }
    }
}
