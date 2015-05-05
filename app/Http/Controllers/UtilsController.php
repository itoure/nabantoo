<?php namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\City;

class UtilsController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Import cities to the database
	 *
	 * @return Response
	 */
	public function getImportCities()
	{
        //ini_set("memory_limit","256M");

        $importFilesFolder = env('APP_FILE_FOLDER').'/import/';
        $cityFile = 'CITIES.TXT';
        $file = $importFilesFolder.$cityFile;

        try{
            if (file_exists($file)) {
                // Get the file content to put into your response
                $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $nb = 0;
                foreach ($lines as $line_num => $line) {
                    if($line_num == 0) continue;

                    // remove white spaces
                    $line = preg_replace('/\s+/', ';', trim($line));
                    $expLine = explode(";", $line);
                    $code = $expLine[0];
                    $expName = array_slice($expLine, 1);
                    $name = implode(' ', $expName);

                    // insert in db
                    if(!empty($name)){
                        //City::create(['country_code' => $code, 'name' => $name]);
                    }

                    $nb++;
                }

                echo 'SUCCESS : '.$nb.' lines inserted in the cities table';die;

            }
            else{
                throw new \Exception('ERROR : NO FILE AVAILABLE');
            }
        }
        catch(\Exception $e){
            echo($e->getMessage());
        }
	}


    /**
     * Import cities to the database
     *
     * @return Response
     */
    public function getImportCountries()
    {
        $importFilesFolder = env('APP_FILE_FOLDER').'/import/';
        $countryFile = 'COUNTRY.TXT';
        $file = $importFilesFolder.$countryFile;

        try{
            if (file_exists($file)) {
                // Get the file content to put into your response
                $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $nb = 0;
                foreach ($lines as $line_num => $line) {
                    if($line_num == 0) continue;

                    // remove white spaces
                    $line = preg_replace('/\s+/', ';', trim($line));
                    $expLine = explode(";", $line);

                    $code = $expLine[0];
                    $expName = array_slice($expLine, 3);
                    $name = implode(' ', $expName);

                    // insert in db
                    if(!empty($name)){
                        Country::create(['country_code' => $code, 'name' => $name]);
                    }

                    $nb++;
                }

                echo 'SUCCESS : '.$nb.' lines inserted in the countries table';die;

            }
            else{
                throw new \Exception('ERROR : NO FILE AVAILABLE');
            }
        }
        catch(\Exception $e){
            echo($e->getMessage());
        }

    }



}
