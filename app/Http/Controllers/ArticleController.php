<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\FavoriteArticle;
use App\Models\Category;

class ArticleController extends Controller
{
    public static function trendingArticles(){
        $trendingArticles = Article::orderBy('totalView', 'desc')->limit(6)->get();

        return $trendingArticles;
    }

    public static function newestArticle(){
        $newArticles = Article::orderBy('created_at', 'desc')->limit(3)->get();

        return $newArticles;
    }

    public static function getAllArticles(){
        $query = Article::query();

        $articles = $query->paginate(5);

        return $articles;
    }

    public static function filterArticles(Request $request){
        $categoryFilter = $request->input('category');
        $titleInput = $request->input('title');

        $query = Article::query();

        if (!empty($categoryFilter)) {
            $query->whereHas('category', function ($categoryQuery) use ($categoryFilter) {
                $categoryQuery->where('category', $categoryFilter);
            });
        }
    
        if (!empty($titleInput)) {
            $query->where('title', 'like', '%' . $titleInput . '%');
        }

        if(empty($categoryFilter) && empty($titleInput)){
            $query = $query->paginate(5);
        } else{
            $query = $query->get();
        }

        // dd($query);
        return view('articles', ['articles' => $query, 'categoryInput' => $categoryFilter, 'titleInput' => $titleInput]);
    }

    public static function favoritedBy($articleId){
        $article = Article::find($articleId); 
        $jumlahFavorite = $article->favoriteArticles->count();
        
        return $jumlahFavorite;
    }

    public static function checkFavorite($articleId){
        $user = Auth::User();

        $isFavorited = $user->favoriteArticles->where('articleId', $articleId)->count() > 0;
        
        return $isFavorited;
    }

    public function addToFavorites(Article $article){
        $newFavorite = new FavoriteArticle();
        $newFavorite->userId = Auth::User()->id;
        $newFavorite->articleId = $article->id;
        $newFavorite->save();

        return redirect()->route('articleDetail', $article);
    }

    public function removeFromFavorite(Article $article){
        $removeFavorite = FavoriteArticle::where('articleId', $article->id)->where('userId', Auth::User()->id)->delete();
        
        return redirect()->route('articleDetail', $article);
    }

    public static function getAllFavArticleOfAUser(){
        $user = Auth::User();
        // $favoriteArticlesData = $user->favoriteArticles;
        // $favoriteArticles = $favoriteArticlesData->map(function($favoriteArticle){
        //     return $favoriteArticle->article;
        // });

        $favoriteArticles = FavoriteArticle::where('userId', $user->id)
        ->with('article')
        ->paginate(3);

        return $favoriteArticles;
    }

    public static function addView(Article $article){
        $article->totalView = $article->totalView + 1;
        $article->save();
    }

    public function addNewArticle(Request $request){
        $validateInput = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'petPhoto' => 'image|mimes:jpeg,png,jpg,gif|max:10240', 
            'description' => 'required',
        ],[
            'title.required' => 'Title wajib diisi',
            'category.required' => 'Category wajib diisi',
            'petPhoto.image' => 'Hanya dapat mengunggah file gambar',
            'petPhoto.mimes' => 'Format gambar tidak valid. Gunakan format JPEG, PNG, atau GIF',
            'petPhoto.max' => 'Ukuran gambar tidak boleh melebihi 10MB',
            'description.required' => 'Description wajib diisi',
        ]);
    
        $inputTitle = $request->input('title');
        $inputCategory = $request->input('category');
        $inputDescription = $request->input('description');
        
        $category = Category::where('category', $inputCategory)->first();

        $inputCategoryId = $category->id;
    
        $newArticle = new Article();
        $newArticle->title = $inputTitle;
        $newArticle->categoryId = $inputCategoryId;
        $newArticle->description = '';
        // $newArticle->description = str_replace("\r\n", "\n\n", $inputDescription);
        $newArticle->description = $inputDescription;
        $newArticle->totalView = 0;


        if ($request->hasFile('articleImage')) {
            $file = $request->file('articleImage');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('image/ArticleImages'), $fileName);
            $newArticle->articleImage = $fileName;
        }

        session()->flash('berhasil','Article berhasil diinsert ke dalam database');
        $newArticle->save();

        return redirect()->Route('addNewArticlePage');
    }
}
