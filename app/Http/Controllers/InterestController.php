<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Interest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class InterestController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // get all interests
        $modInterest = new Interest();
        $interestList = $modInterest->getAllInterests();

        $data = new \stdClass();
        $data->interestList = $interestList;

        return view('interest/index')->with('data', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        // get all categories
        $arrCategory = array(''=>'');
        $categoryList = Category::all();
        foreach($categoryList as $category){
            $arrCategory[$category->cat_id] = $category->cat_name;
        }

        $data = new \stdClass();
        $data->arrCategory = $arrCategory;

        return view('interest/create')->with('data', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        $fileFolder = env('APP_IMG_FOLDER');

        $rules = array(
            'name' => 'required|string',
            'category' => 'required|integer',
            'image' => 'image',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::action('InterestController@create')->withErrors($validator)->withInput();
        } else {
            $name = Input::get('name');
            $category = Input::get('category');
            $image = Input::file('image');

            // photo
            $imageName = null;
            if($image){
                if ($image->isValid()) {
                    // resizing an uploaded file
                    Image::make($image)->crop(150, 150)->save($fileFolder.'/interests/'.$image->getClientOriginalName());
                    //$image->move($fileFolder.'/interests/', $image->getClientOriginalName());
                    $imageName = $image->getClientOriginalName();

                }
            }

            // save interest
            Interest::create(array(
                'int_name' => $name,
                'category_id' => $category,
                'int_image' => $imageName,
            ));

            return Redirect::action('InterestController@index');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $interest = Interest::findOrFail($id);

        // get all categories
        $categoryList = Category::all();
        foreach($categoryList as $category){
            $arrCategory[$category->cat_id] = $category->cat_name;
        }

        $data = new \stdClass();
        $data->arrCategory = $arrCategory;
        $data->interest = $interest;

        return view('interest/edit')->with('data', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
