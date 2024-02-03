<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\MethodCall;

use function Laravel\Prompts\alert;
use function Laravel\Prompts\confirm;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->id()){ // If not auth, redirect to login
            return redirect()->route('session.login');
        }elseif (!auth()->user()->is_admin) { // If not admin, redirect to home
            return redirect()->route('home');
        }

        $categories = Categories::all();

        return view('categories.index', ['categories_fetch' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->id()){ // If not auth, redirect to login
            return redirect()->route('session.login');
        }elseif (!auth()->user()->is_admin) { // If not admin, redirect to home
            return redirect()->route('home');
        }

        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate data
        $pField = $request->validate([
            'name' => ['required','max:35'],
            'description' => 'required',
        ]);

        // Stores data
        Categories::create($pField);

        // Returns to index
        return redirect()->route('categories.index')->with('success','Data successfully stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find row id
        $category = Categories::findOrFail($id);
        
        // Redirect to edit form with the collected data
        return view('categories.edit',['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate data before updating
        $request->validate([
            'name' => ['required','max:35'],
            'description' => 'required',
        ]);
        // Updates data
        Categories::findOrFail($id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Returns user to index
        return redirect()->back()->with('success','Data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Destroy data with the corresponding id
        Categories::destroy($id);

        // Refresh page
        return redirect()->back()->with('success','Data successfully destroyed');
    }

    public function search(Request $request)
    {
        // Only activates if it was from an ajax call
        if($request->ajax())
        {   
            // Select data by ('_column','_criteria','_input') and order them by ('_column','_sort | DESC | ASC')
            $data = Categories::where($request->filter,'like','%'.$request->search.'%')->orderBy($request->filter,$request->sort)->get();
            $token = $request->session()->token(); // Get token from request

            // Ready output variable for 
            $output = '';
            if (count($data)>0){
                $output = '
                <table class="table table-striped" id="search_list">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10ch;">#</th>
                            <th scope="col" style="width: 25ch">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col" style="width: 15ch;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
                foreach($data as $category){
                    $output .=
                    '
                    <tr>
                        <td scope="row">'. $category->id .'</td>
                        <td>'.$category->name .'</td>
                        <td>'.$category->description.'</td>
                        <td>
                            <form onsubmit="return confirm('."'Are you sure you want to delete this data?'".')" action="'.route('categories.destroy', ['category' => $category]).'" method="POST">
                                <a href="'.route('categories.edit', ['category' => $category]).'" class="text-decoration-none">
                                    <button type="button" class="btn btn-warning mb-1"><i class="fas fa-edit"></i></button>
                                </a>
                                <input type="hidden" name="_token" value="'. $token .'"/>
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-danger mb-1"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    '
                    ; 
                }
                $output .= '
                    </tbody>
                </table>
                ';
            } else {
                $output = '
                <table class="table table-striped" id="search_list">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10ch;">#</th>
                            <th scope="col" style="width: 25ch">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col" style="width: 15ch;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>    
                ';
            }

            return $output;
        }
    }
}
