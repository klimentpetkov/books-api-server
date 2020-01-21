<?php

namespace App;

use App\Notifications\BookPublished;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'image', 'user_id', 'category_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function($book) {
            $readers = User::where([
                ['role', '=', 'reader'],
                ['receive_notifications', '=', '1']
            ])->get();

            Notification::send($readers, new BookPublished($book));
        });
    }

    /* Accessors & Mutators */

    public function getImageAttribute($value)
    {
        // Base64 encoded image
        /*$imagePath = static::getImagesStoragePath() . $value;
        $type = pathinfo($imagePath, PATHINFO_EXTENSION);
        $data = file_get_contents($imagePath);

        return 'data:image/' . $type . ';base64,' . base64_encode($data);*/

        // Url path for image access
        return  static::getImageUrlPath() . $value;
    }

    /* Relations */
    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /* Helpers */
    /**
     * Creates images storage path
     * @return string
     */
    public static function getImagesStoragePath(): string
    {
        return storage_path('app' . DIRECTORY_SEPARATOR .
            'public' . DIRECTORY_SEPARATOR .
            'images' . DIRECTORY_SEPARATOR);
    }

    /**
     * Creates url path for direct image access
     * @return string
     */
    public static function getImageUrlPath(): string
    {
        return url('/') . '/api/image/';
    }
}
