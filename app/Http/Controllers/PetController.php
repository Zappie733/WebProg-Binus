<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\User;
use App\Models\FavoritePet;
use App\Models\Category;

class PetController extends Controller
{
    public static function getAllPets(){
        $query = Pet::query();

        $pets = $query->paginate(9);

        return $pets;
    }

    public static function filterPets(Request $request){
        $categoryFilter = $request->input('category');
        $nameFilter = $request->input('name');

        $query = Pet::query();

        if (!empty($categoryFilter)) {
            $query->whereHas('category', function ($categoryQuery) use ($categoryFilter) {
                $categoryQuery->where('category', $categoryFilter);
            });
        }
    
        if (!empty($nameFilter)) {
            $query->where('name', 'like', '%' . $nameFilter . '%');
        }

        if(empty($categoryFilter) && empty($nameFilter)){
            $query = $query->paginate(9);
        } else{
            $query = $query->get();
        }

        return view('pets', ['pets' => $query, 'categoryInput' => $categoryFilter, 'nameInput' => $nameFilter]);
    }

    public static function mostSearchPets(){
        $pets = Pet::orderBy('totalView', 'desc')->limit(3)->get();

        return $pets;
    }

    public static function favoritedBy($petId){
        $pet = Pet::find($petId); 
        $jumlahFavorite = $pet->favoritePets->count();
        
        return $jumlahFavorite;
    }

    public static function checkFavorite($petId){
        $user = Auth::User();

        $isFavorited = $user->favoritePets->where('petId', $petId)->count() > 0;
        
        return $isFavorited;
    }

    public function addToFavorites(Pet $pet){
        $newFavorite = new FavoritePet();
        $newFavorite->userId = Auth::User()->id;
        $newFavorite->petId = $pet->id;
        $newFavorite->save();

        return redirect()->route('petDetail', $pet);
    }

    public function removeFromFavorite(Pet $pet){
        $removeFavorite = FavoritePet::where('petId', $pet->id)->where('userId', Auth::User()->id)->delete();
        
        return redirect()->route('petDetail', $pet);
    }

    public static function getAllFavPetOfAUser(){
        $user = Auth::User();
        // $favoritePetsData = $user->favoritePets;
        // $favoritePets = $favoritePetsData->map(function ($favoritePet) {
        //     return $favoritePet->pet;
        // });
        $favoritePets = FavoritePet::where('userId', $user->id)
        ->with('pet')
        ->paginate(6);

        return $favoritePets;
    }

    public function addNewPet(Request $request){
        $validateInput = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'petPhoto' => 'image|mimes:jpeg,png,jpg,gif|max:10240', 
            'description' => 'required',
        ],[
            'name.required' => 'Name wajib diisi',
            'category.required' => 'Category wajib diisi',
            'petPhoto.image' => 'Hanya dapat mengunggah file gambar',
            'petPhoto.mimes' => 'Format gambar tidak valid. Gunakan format JPEG, PNG, atau GIF',
            'petPhoto.max' => 'Ukuran gambar tidak boleh melebihi 10MB',
            'description.required' => 'Description wajib diisi',
        ]);
    
        $inputName = $request->input('name');
        $inputCategory = $request->input('category');
        $inputDescription = $request->input('description');
        
        $category = Category::where('category', $inputCategory)->first();

        $inputCategoryId = $category->id;
    
        $newPet = new Pet();
        $newPet->name = $inputName;
        $newPet->categoryId = $inputCategoryId;
        $newPet->description = '';
        // $newPet->description = str_replace("\r\n", "\n\n", $inputDescription);
        $newPet->description = $inputDescription;
        $newPet->totalView = 0;


        if ($request->hasFile('petPhoto')) {
            $file = $request->file('petPhoto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('image/PetImages'), $fileName);
            $newPet->petImage = $fileName;
        }

        session()->flash('berhasil','Pet berhasil diinsert ke dalam database');
        $newPet->save();

        return redirect()->Route('addNewPetPage');
    }

    public static function addView(Pet $pet){
        $pet->totalView = $pet->totalView + 1;
        $pet->save();
    }
}
