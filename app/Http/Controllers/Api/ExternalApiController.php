<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ExternalApiController extends Controller
{
    //This controller calls the Ice and Fire API and returns the response in JSON format
    ///This api call uses Laravel HTTP Client in calling Ice and Fire API
    public function index (Request $request){
    	////Input validation
    	 $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 280);
        }
    	$response = Http::withHeaders([
            'Accepts' => 'application/json'
        ])->get(
            'https://www.anapioficeandfire.com/api/books',
        [
            'name' => $request->name,
        ]
        );
        if ($response->status() == 200) {
        	//// The response that shows when the API response status is 200 and returns with 0:n number of data that match the request that was made
        	$response = json_decode($response,true);
        	$status_code = 200;
        	$status_message = 'success';
        	$total_books = count($response);
        	$data = [];
        	$res = [];
        	// return $total_books;
        	// return $response;
        		foreach ($response as $responses) {
        		$data[] = [ 
        					'name' => $responses['name'],
		                    'isbn'=> $responses['isbn'],
		                    'authors'=> 
		                    	[
		                    		$authors[] = $responses['authors']
		                    	],
		                    'number_of_pages'=> $responses['numberOfPages'],
					        'publisher' =>$responses['publisher'],
					        'country'=>$responses['country'],
					        'release_date'=>$responses['released'],
                ];
        	}
        	// return $data
        	return response()->json([
        		'status_code'=>$status_code,
        		'status_message'=>$status_message,
        		'data'=>$data 
        		]);
        		      		
        	
        	}
        	else{
        		//// The response that shows when the API response returns with response status that is not 200 or some errors
        		return response()->json([
        		'status_code'=>$response->status(),
        		'status_message'=>'Fatal errors were encountered!',
        		'data'=>[]
        		]);
        	}
        	
        }
        
}
