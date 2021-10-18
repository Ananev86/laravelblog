<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use Sluggable;
    protected $fillable=[
        'title','description','content','category_id','thumbnail'
    ];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    static function  uploadImage(Request $request,$image=null)
{
      if($request->hasFile('thumbnail'))
        {
            if($image)
            {
                Storage::delete($image);
            }
            $folder=date('Y-m-d');
            //return $request->file('thumbnail')->store("images/{$folder}");
            return $request->file('thumbnail')->storeAs("images/{$folder}",$request->file('thumbnail')->getClientOriginalName());
        }
      return null;
}


 public function tags()
 {
     return $this->belongsToMany(Tag::class);
 }
 public function category()
 {
     return $this->belongsTo(Category::class);
 }
 public function getImage()
 {
      if($this->thumbnail)
      {
          return asset('public/uploads/'.$this->thumbnail);
      }
      return asset('public/uploads/images/nn.png');
 }
}
