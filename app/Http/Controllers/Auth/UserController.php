<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        $models = User::with('roles')->paginate(10);
        return view('admin.pages.user.index',['models'=>$models]);
    }
    public function create()
    {
        $roles=Role::all();
        return view('admin.pages.user.form',['roles'=>$roles]);
    }
    public function store(UserStoreRequest $request){


        $data=$request->except('_token','img');

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('ProfileImages', $imageName, 'public');


            $data['img'] = 'ProfileImages/'.$imageName;

        }


        if ($request->has('status')) {
            $data['status'] = $request->input('status') === 'on' ? 1 : 0;
        }
        $data['password'] = Hash::make($request->input('password'));

        $user= User::create($data);
        $user->syncRoles($request->role);
        return  redirect()->route('user.index')->with('success','İstifadəçi uğurla əlavə edildi');

    }

    public function updateStatus(Request $request, $id)
    {
        $model =User::findOrFail($id);
        $model->status = $request->status;
        $model->save();
        return response()->json(['message' => 'Status uğurla dəyişdirildi']);
    }


    public function edit($id){
        $roles=Role::all();
        $model = User::findorfail($id);
        return view('admin.pages.user.form',['model'=>$model,'roles'=>$roles]);
    }
    public function destroy($id)
    {

        $user = User::findorfail($id);


        if ($user) {
            $user->delete();
            return back()->with('success', 'user silindi.');
        }


        return back()->with('error', 'User tapilmadi.');
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validated();


        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }



        if ($request->hasFile('img')) {
            if (!is_null($user->img)) {
                Storage::disk('public')->delete($user->img);
            }
            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs('ProfileImages', $imageName, 'public');


            $data['img'] = 'ProfileImages/'.$imageName;

        }

        if (!($request->has('status'))) {
            $data['status'] = 0;
        }else{
            $data['status'] = 1;
        }
        $user->syncRoles($request->role);

        $user->update($data);
        return  redirect()->route('user.index')->with('success','İstifadəçi update edildi');

    }
}
