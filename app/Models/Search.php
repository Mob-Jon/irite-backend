<?php

namespace App\Models;
// use Spatie\Searchable\Searchable;
// use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model implements Searchable
{
    use HasFactory;

    // protected $guarded = [];

    // public function category(){
    //     return $this->belongsTo('App\Category');
    // }

    // public function getSearchResult(): SearchResult
    // {
    //     $url = route('admin.gifts.show', $this->id);
 
    //     return new SearchResult(
    //         $this,
    //         $this->name,
    //         $url
    //     );
    // }

    protected $fillable = [
        'title'
    ];
}
