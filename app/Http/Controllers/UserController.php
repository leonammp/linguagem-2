<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use LaravelLegends\PtBrValidator\Rules\Cpf;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('users.index',compact('users'));
    }


    public function profile()
    {
        return view('users.profile');
    }

    public function saveProfile(Request $request)
    {
        $user = Auth::user();
        try {
            if ($request->hasFile('avatar')) {

                $request->validate([
                    'avatar' => 'mimes:jpeg,jpg,png|required|max:80000'
                ]);

                $avatar = $request->file('avatar');
                $filename = base64_encode(file_get_contents($avatar->path()));

                //$filename = time() . '.' . $avatar->getClientOriginalExtension();
                //Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename));

                $user->avatar = $filename;
                $user->save();
            }

            return view('users.profile', compact('user'));

        } catch (\Exception $e) {
            return view('users.profile', compact('user'));
        }
    }

    public function store(Request $request)
    {
        $values = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'cpf' => $request->cpf,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
        ];

        if (empty($request->user_id)){
            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users',
                'address' => 'required',
                'cpf' => ['nullable', new Cpf()],
                'birthday' => 'date|nullable',
                'password' => 'required'
            ]);
            $msg = 'Usuário criado com sucesso';
        }else{
            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users,email,'.$request->user_id,
                'address' => 'required',
                'cpf' => ['nullable', new Cpf()],
                'birthday' => 'date|nullable'
            ]);
            $msg = 'Usuário foi alterado com sucesso';
        }

        if (strlen(trim($request->password)) > 0)
            $values['password'] = Hash::make($request->password);

        User::updateOrCreate(['id' => $request->user_id], $values);

        return redirect()->route('user.index')->with('success',$msg);
    }

    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $user = User::where($where)->first();
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        return response()->json($user);
    }
}
