<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PhpParser\Node\Scalar\MagicConst\Dir;
use Illuminate\Support\Facades\File;
use League\CommonMark\Normalizer\SlugNormalizer;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;
    public $slug;
    public $excerpt;
    public $date;
    public $body;
    

    public function __construct($title, $slug, $excerpt, $date, $body){
        $this->title = $title;
        $this->slug = $slug;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
    }

    public static function all(){
        return cache()->rememberForever('posts.all', function(){
            return collect(File::files(resource_path("posts")))
            ->map(function($file){
                return YamlFrontMatter::parseFile($file);
            })
            ->map(function($document){
                return new Post(
                    $document->title,
                    $document->slug,
                    $document->excerpt,
                    $document->date,
                    $document->body()
                );
            })
            ->sortBy('date');
    });

        
    }

    public static function find($slug){
        return static::all()->firstWhere('slug', $slug);
    
    }

    public static function findOrFail($slug){
        $post = static::find($slug);
        
        if (!$post) {
            throw new ModelNotFoundException();
        }

        return $post;
    }
}   