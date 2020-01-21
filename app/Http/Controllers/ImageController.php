<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $image
     * @return \Illuminate\Http\Response
     */
    public function show($image)
    {
        $imagePath = Book::getImagesStoragePath() . $image;

        if (!file_exists($imagePath))
            $imagePath = Book::getImagesStoragePath() . 'no_image.jpg';

        return Response::download($imagePath);
    }
}
