<?php
namespace App\Http\Controllers;

use App\Book;
use App\Rules\ValidBase64Image;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use App\Constants;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('user:id,name', 'category:id,name')->paginate(5);

        return response()->json($books, 200);
    }

    /**
     * Pass data for publishing a new book
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->only(['title', 'description', 'image', 'category_id']);
        $validator = $this->getValidator($data);

        if ($validator->fails())
            return response()->json(['message' =>  Constants::VALIDATION_ERROR,'data' => $validator->errors()], Constants::STATUS_BAD_REQUEST);

        if (!empty($errors)) {
            return response()->json(['message' => Constants::VALIDATION_ERROR, 'data' => $errors], Constants::STATUS_BAD_REQUEST);
        }

        if (Category::find(request('category_id')) === null)
            return response()->json(['message' => Constants::VALIDATION_ERROR, 'data' => ['category_id' => 'This category does not belong to our database!']], Constants::STATUS_BAD_REQUEST);

        $extension = explode('/', explode(';', explode(",", $data['image'])[0])[0])[1];
        $imageName = md5(time()). '.' . $extension;
        Image::make($data['image'])->save(Book::getImagesStoragePath() . $imageName);

        $data['user_id'] = auth()->user()->id;
        $data['image'] = $imageName;

        if (!Book::create($data)) {
            return response()->json(['message' => Constants::RESOURCE_NOT_SAVED], Constants::STATUS_OK);
        }

        return response()->json(['message' => Constants::RESOURCE_SAVED], Constants::STATUS_OBJECT_CREATED);
    }

    /**
     * Returns a prepared validator for validating book data
     * @param $requestData array
     * @return Validator
     */
    private function getValidator($requestData)
    {
        return Validator::make($requestData, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|numeric',
            'image' => ['required', new ValidBase64Image(10485760, ['jpg', 'jpeg', 'png'])] // 10MB + mimes: jpg,jpeg,png
        ]);
    }
}
