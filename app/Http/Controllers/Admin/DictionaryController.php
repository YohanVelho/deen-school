<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use File;


class DictionaryController extends Controller
{
    /**
     * Remove the specified resource from storage.
     * @return Response
    */
    public function index()
    {
   	  $languages = DB::table('admin_languages')->get();


   	  $columns = [];
	  $columnsCount = $languages->count();


	    if($languages->count() > 0){
	        foreach ($languages as $key => $language){
	            if ($key == 0) {
	                $columns[$key] = $this->openJSONFile($language->slug);
	            }
	            $columns[++$key] = ['data'=>$this->openJSONFile($language->slug), 'lang'=>$language->slug];
	        }
	    }


   	  return view('admin.pages.translation.index', compact('languages','columns','columnsCount'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
    */
    public function store(Request $request)
    {
   	    $request->validate([
		    'key' => 'required',
		    'value' => 'required',
		]);


		$data = $this->openJSONFile('pt');
        $data[$request->key] = $request->value;


        $this->saveJSONFile('pt', $data);


        return redirect()->route('admin.languages');
    }


    /**
     * Remove the specified resource from storage.
     * @return Response
    */
    public function destroy($key)
    {
        $languages = DB::table('admin_languages')->get();


        if($languages->count() > 0){
            foreach ($languages as $language){
                $data = $this->openJSONFile($language->slug);
                unset($data[$key]);
                $this->saveJSONFile($language->slug, $data);
            }
        }
        return response()->json(['success' => $key]);
    }


    /**
     * Open Translation File
     * @return Response
    */
    private function openJSONFile($code){
        $jsonString = [];
        if(File::exists(base_path('resources/lang/'.$code.'.json'))){
            $jsonString = file_get_contents(base_path('resources/lang/'.$code.'.json'));
            $jsonString = json_decode($jsonString, true);
        }
        return $jsonString;
    }


    /**
     * Save JSON File
     * @return Response
    */
    private function saveJSONFile($code, $data){
        ksort($data);
        $jsonData = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        file_put_contents(base_path('resources/lang/'.$code.'.json'), stripslashes($jsonData));
    }


    /**
     * Save JSON File
     * @return Response
    */
    public function transUpdate(Request $request){
        $data = $this->openJSONFile($request->code);
        $data[$request->pk] = $request->value;


        $this->saveJSONFile($request->code, $data);
        return response()->json(['success'=>'Done!']);
    }
}
