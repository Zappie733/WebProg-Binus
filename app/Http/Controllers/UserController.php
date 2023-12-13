<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function profileUpdate(Request $request){
        $validateInput = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::User()->id,
            'password' => 'required',
            'dob' => 'required|date',
            'gender' => 'required',
            'profilePhoto' => 'image|mimes:jpeg,png,jpg,gif|max:10240', 
        ],[
            'username.required' => 'Username wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email telah digunakan',
            'password.required' => 'Password wajib diisi',
            'dob.required' => 'Tanggal lahir wajib diisi',
            'dob.date' => 'Format tanggal lahir tidak valid',
            'gender.required' => 'Gender wajib diisi',
            'profilePhoto.image' => 'Hanya dapat mengunggah file gambar',
            'profilePhoto.mimes' => 'Format gambar tidak valid. Gunakan format JPEG, PNG, atau GIF',
            'profilePhoto.max' => 'Ukuran gambar tidak boleh melebihi 10MB',
        ]);
    
        $inputUserName = $request->input('username');
        $inputEmail = $request->input('email');
        $inputPassword = $request->input('password');
        $inputDOB = $request->input('dob');
        $inputGender = $request->input('gender');
    
        $user = Auth::User();

        $user->username = $inputUserName;        
        $user->email = $inputEmail;        
        $user->dob = $inputDOB; 
        $user->gender = $inputGender; 

        if ($request->hasFile('profilePhoto')) {
            $file = $request->file('profilePhoto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            // $file->storeAs('public/image/ProfilePhotos/', $fileName);
            $file->move(public_path('image/ProfilePhotos'), $fileName);
            $user->profilePhoto = $fileName;
        }

        if(!Hash::check($inputPassword,Auth::User()->password)){
            session()->flash('passwordNotMatch','Password tidak sesuai, update gagal');
        } else{
            session()->flash('berhasil','Profile berhasil diupdate');
            $user->save();
        }

        return redirect()->Route('profilePage');
    }

    public static function getAllAdmins(){
        $admins = User::where('isAdmin', 1)->paginate(5);

        return $admins;
    }

    public static function getAllUsers(){
        $users = User::where('isAdmin', 0)->paginate(5);

        return $users;
    }
}

