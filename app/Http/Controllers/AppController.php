<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pet;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PetController;

class AppController extends Controller
{
    public function loginPage(){
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('login');
    }

    public function login(Request $request){
        $validateInput = $request->validate([
            'email' => 'required | email',
            'password' => 'required',
        ],[
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Penulisan email belum sesuai',
            'password' => 'Password wajib diisi',
        ]);

        $inputEmail = $request->input('email');
        $inputPassword = $request->input('password');

        $user = User::where('email', $inputEmail)->first();

        if ($user) {
            if (Hash::check($inputPassword, $user->password)) {
                Auth::Login($user);
                
                return redirect()->Route('home');
            }
        }
    
        session()->flash('pesan','User tidak ditemukan');

        return redirect()->Route('loginPage');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('loginPage');
    }

    public function registerPage(){
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('register');
    }

    public function register(Request $request){
        $validateInput = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'dob' => 'required|date',
            'gender' => 'required',
            'profilePhoto' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ],[
            'username.required' => 'Username wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email telah digunakan',
            'password.required' => 'Password wajib diisi',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi',
            'password_confirmation.same' => 'Konfirmasi password tidak cocok dengan password',
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
    
        $newUser = new User();
        $newUser->username = $inputUserName;        
        $newUser->email = $inputEmail;        
        $newUser->password = Hash::make($inputPassword);
        $newUser->dob = $inputDOB; 
        $newUser->gender = $inputGender; 
        $newUser->isAdmin = 0;

        if ($request->hasFile('profilePhoto')) {
            $file = $request->file('profilePhoto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            // $file->storeAs('public/image/ProfilePhotos/', $fileName);
            $file->move(public_path('image/ProfilePhotos'), $fileName);
            $newUser->profilePhoto = $fileName;
        }

        $newUser->save();

        session()->flash('pesanRegister','Register telah berhasil, silahkan login');

        return redirect()->Route('loginPage');
    }

    public function home(){
        $trendingArticles = ArticleController::trendingArticles();
        // $newestArticles = ArticleController::newestArticle();
        $mostSearchPets = PetController::mostSearchPets();
        return view('home', [
                                'trendingArticles' => $trendingArticles,
                                // 'newestArticles' => $newestArticles,
                                'mostSearchPets' => $mostSearchPets
                            ]);
    }

    public function petsPage(){
        $pets = PetController::getAllPets();

        return view('pets', ['pets' => $pets, 'categoryInput' => '', 'nameInput' => '']);
    }

    public function petDetail(Pet $pet){
        PetController::addView($pet);
        $totalFavorite = PetController::favoritedBy($pet->id);
        $isFavorited = PetController::checkFavorite($pet->id);
        return view('petDetail', ['pet' => $pet, 'totalFavorite' => $totalFavorite, 'isFavorited' => $isFavorited]);
    }

    public function articlesPage(){
        $articles = ArticleController::getAllArticles();

        return view('articles', ['articles' => $articles, 'categoryInput' => '', 'titleInput' => '']);
    }

    public function articleDetail(Article $article){
        ArticleController::addView($article);
        $totalFavorite = ArticleController::favoritedBy($article->id);
        $isFavorited = ArticleController::checkFavorite($article->id);
        return view('articleDetail', ['article' => $article, 'totalFavorite' => $totalFavorite, 'isFavorited' => $isFavorited]);
    }

    public function favoritesPage(){
        $favoritePets = PetController::getAllFavPetOfAUser();
        $favoriteArticles = ArticleController::getAllFavArticleOfAUser();

        return view('favorites', ['favoritePets' => $favoritePets, 'favoriteArticles' => $favoriteArticles]);
    }

    public function profilePage(){
        return view('profile');
    }

    public function users(){
        $admins = UserController::getAllAdmins();
        $users = UserController::getAllUsers();
        return view('users', ['admins' => $admins, 'users' => $users]);
    }

    public function addNewPetPage(){
        return view('newPet');
    }

    public function addNewArticlePage(){
        return view('newArticle');
    }
}
