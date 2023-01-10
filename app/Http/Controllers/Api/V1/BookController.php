<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;
use App\Http\Resources\BookCollection;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::OrderBy('name','ASC')->get();
        // return new BookCollection($books);
        $authors = [];
        $data = [];
        foreach ($books as $book) {
                $book_authors = explode(',',$book->authors);
                $total_authors = count($book_authors);
                // foreach ($book_authors as $author) {
                //     $authors[] = $author;
                // }
            $data[] = [ 
                'id'=>$book->id,
                'name'=>$book->name,
                'isbn'=>$book->isbn,
                'authors'=>[
                            $book_authors
                            ],
                'number_of_pages'=>$book->number_of_pages,
                'publisher'=>$book->publisher,
                'country'=>$book->country,
                'release_date'=>$book->release_date
            ];
        }

        return response()->json([
                'status_code'=> 200,
                'status_message'=> 'suceess',
                'data'=>$data 
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'isbn' => 'required|string|max:255',
            'authors' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'number_of_pages' => 'required|int',
            'publisher' => 'required|string|max:255',
            'release_date' => 'required|date|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 280);
        }

        $book = new Book([
            'name'=> $request->name,
            'isbn'=> $request->isbn,
            'authors'=> $request->authors,
            'country'=> $request->country,
            'number_of_pages'=> $request->number_of_pages,
            'publisher'=> $request->publisher,
            'release_date'=> $request->release_date,
            ]);
        // return $book_authors;
        if ($book->save()) {
            $book_authors = explode(',',$book->authors);
            $total_authors = count($book_authors);
            $authors = [];
            foreach ($book_authors as $author) {
                $authors[] = $author;
            }
            return response()->json([
                'status_code'=> 200,
                'status_message'=> 'suceess',
                'data'=>[
                            'book'=>[
                                        'name'=>$book->name,
                                        'isbn'=>$book->isbn,
                                        'authors'=>[
                                                    $authors
                                                    ],
                                        'number_of_pages'=>$book->number_of_pages,
                                        'publisher'=>$book->publisher,
                                        'country'=>$book->country,
                                        'release_date'=>$book->release_date

                                    ]
                        ]
                ],201);
        }
        else{
            response()->json([
                'message'=> 'We are unable to save your requests'
                ],501);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $book_detail = Book::findOrfail($id);
        if ($book_detail !=null) {
            $book_authors = explode(',',$book_detail->authors);
            $total_authors = count($book_authors);
            $authors = [];
            foreach ($book_authors as $author) {
                $authors[] = $author;
            }
            // return $book_authors;
             return response()->json([
                    'status_code'=> 200,
                    'status_message'=> 'suceess',
                    'data'=>[
                                'book'=>[
                                            'id'=>$book_detail->id,
                                            'name'=>$book_detail->name,
                                            'isbn'=>$book_detail->isbn,
                                            'authors'=>[
                                                        $authors
                                                        ],
                                            'number_of_pages'=>$book_detail->number_of_pages,
                                            'publisher'=>$book_detail->publisher,
                                            'country'=>$book_detail->country,
                                            'release_date'=>$book_detail->release_date

                                        ]
                            ]
                    ],201);
        }
        else{
            return response()->json([
                    'message'=> 'Invalid Book ID'
                ]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'isbn' => 'required|string|max:255',
            'authors' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'number_of_pages' => 'required|int',
            'publisher' => 'required|string|max:255',
            'release_date' => 'required|date|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 280);
        }
        $book_detail = Book::findOrfail($id);
        if ($book_detail != null) {
            $book_detail->name = $request->name;
            $book_detail->isbn = $request->isbn;
            $book_detail->authors = $request->authors;
            $book_detail->country = $request->country;
            $book_detail->number_of_pages = $request->number_of_pages;
            $book_detail->publisher = $request->publisher;
            $book_detail->release_date = $request->release_date;

            $book_authors = explode(',',$book_detail->authors);
            $total_authors = count($book_authors);
            $authors = [];
            foreach ($book_authors as $author) {
                $authors[] = $author;
            }
            // return $book_authors;
            if ($book_detail->save()) {
                return response()->json([
                    'status_code'=> 200,
                    'status_message'=> 'suceess',
                    'message'=>'The book '.$book_detail->name.' was updated successfully',
                    'data'=>[
                                'book'=>[
                                            'id'=>$book_detail->id,
                                            'name'=>$book_detail->name,
                                            'isbn'=>$book_detail->isbn,
                                            'authors'=>[
                                                        $authors
                                                        ],
                                            'number_of_pages'=>$book_detail->number_of_pages,
                                            'publisher'=>$book_detail->publisher,
                                            'country'=>$book_detail->country,
                                            'release_date'=>$book_detail->release_date

                                        ]
                            ]
                    ],201);
        }
        else{
            response()->json([
                'message'=> 'We are unable to save your requests'
                ],501);
        }
        }
        else{
            return response()->json([
                    'message'=> 'Invalid Book ID'
                ],501);
        }
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if ($book !=null) {
            $book->delete();
                return response()->json([
                        'status_code'=>204,
                        'status'=>'success',
                        'message'=>'The book '.$book->name.' was deleted successfully',
                        'data'=>[]
                    ]);
        }else{
            return response()->json([
                    'message'=> 'Invalid Book ID'
                ]);
        }
    }
}
