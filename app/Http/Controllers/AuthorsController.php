<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ResponseBuilder;
use Illuminate\Http\Request; 
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class AuthorsController extends Controller
{

    use ResponseBuilder;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }
    

    /**
     * list all authors
     */
    public function index()
    {
          return $this->successResponse(Author::all());
    }


    /**
     * show author
     */
    public function show($author_uuid)
    {
        $author = Author::where('uuid',$author_uuid)->firstOrFail();
        
        return $this->successResponse($author,JsonResponse::HTTP_OK);
        
    }


    /**
     * add an author to the library
     */
    public function create(Request $request) : JsonResponse
    {

        $this->validate($request,[
            'name' => 'required|max:255',
            'gender' => 'required|max:255|in:male,female',
            'country' => 'required|max:255'
        ]);
        
        $data = $request->all();
        $data['uuid'] = Str::uuid();
          
        $author = Author::create($data);
         
        return $this->successResponse($author,JsonResponse::HTTP_CREATED);
        


    }



    /**
     * update an authors info
     */
    public function update(Request $request,$author_uuid)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'gender' => 'required|max:255|in:male,female',
            'country' => 'required|max:255'
        ]);

       $author = Author::where('uuid',$author_uuid)->firstOrFail();

        
        $author->update($request->all());

        return $this->successResponse('Author Updated Successfully',JsonResponse::HTTP_OK);
       
    }

    /**
     * 
     * delete an author
     */
    public function destroy($author_uuid)
    {
        $author = Author::where('uuid',$author_uuid)->firstOrFail();

         
        $author->delete();
        return $this->successResponse('Author deleted successfully',JsonResponse::HTTP_OK);
        
    }




}
