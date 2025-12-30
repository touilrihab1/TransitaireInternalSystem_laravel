<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Database\Seeders\clientsSeeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Hash;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;

class UsertClient extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::where('isclient', 1)
            ->leftJoin('user_client', 'user_client.id_user', '=', 'users.id')
            ->leftJoin('clients', 'user_client.id_client', '=', 'clients.id')
            ->orderBy('users.id', 'DESC')
            ->select('clients.*', 'users.*')
            ->get();
    
        return view('clients.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles = Role::pluck('name','name')->all();
        // $permission = Permission::get();
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|same:confirm-password',
            'codeTiers' => 'required'


        ]);
        $input['name'] = $request->name;
        $input['email'] = $request->email;
        $input['password'] = $request->password;
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->isclient = 1;
        $user->save();
        $user->assignRole('client');
        $id_client = DB::table('clients')
            ->select('Id')
            ->where('Code_Tiers', $request->codeTiers)
            ->first();
        DB::insert('insert into user_client (id_client, id_user) values (?, ?)', [$id_client->Id, $user->id]);
        return redirect()->route('clients.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        $client = DB::table('user_client')
            ->leftJoin('clients', 'user_client.id_client', '=', 'clients.id')
            ->where('user_client.id_user', $user->id)
            ->select('clients.*')
            ->first();

        if ($client) {
            return view('clients.show', compact('user', 'client'));
        } else {
            // Handle the case when the client record is not found
            abort(404); // or return a custom error view
        }
    }

    /**
     * Show the form for editing the specified resource.
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('clients.index')
            ->with('success', 'User deleted successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('clients.edit', compact('user'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password'

        ]);
        $id_client = DB::table('clients')
            ->select('Id')
            ->where('Code_Tiers', $request->codeTiers)
            ->first();

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('user_client')->where('id_user', $id)->update(['id_client' => $id_client->Id]);
        return redirect()->route('clients.index')
            ->with('success', 'User updated successfully');
    }

}