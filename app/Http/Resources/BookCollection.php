<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
        $request,
                'status_code'=> 200,
                'status_message'=> 'suceess',
                // 'id'=>$data->id,
                //             'name'=>$data->name,
                //             'isbn'=>$data->isbn,
                //             'authors'=>[
                //                         $authors
                //                         ],
                //             'number_of_pages'=>$data->number_of_pages,
                //             'publisher'=>$data->publisher,
                //             'country'=>$data->country,
                //             'release_date'=>$data->release_date,
                $this->collection->map(function($data) {
                $book_authors = explode(',',$data->authors);
                $total_authors = count($book_authors);
                $authors = [];
                foreach ($book_authors as $author) {
                    $authors[] = $author;
                }
                
            })
        ];
    }
}
