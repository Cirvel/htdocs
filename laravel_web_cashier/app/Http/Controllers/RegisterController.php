<?php

namespace App\Http\Controllers;

use App\Models\Registers;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RegisterController extends Controller
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

        $registers = Registers::all();

        return view('registers.index', ['registers_fetch' => $registers]);
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

        return view('registers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate data
        $pField = $request->validate([
            "designation" => ["required","max:35"],
        ]);

        // Stores data
        Registers::create($pField);

        // Returns to index
        return redirect()->route('registers.index')->with('success','Data successfully stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * previously:
     * String $id
     */
    public function edit(string $id)
    {
        // Find row id
        $register = Registers::findOrFail($id);
        
        // Redirect to edit form with the collected data
        return view('registers.edit', ['register' => $register]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate data before updating
        $request->validate([
            "designation" => ["required","max:35"],
        ]);
        // Updates data
        Registers::findOrFail($id)->update([
            'designation' => $request->designation,
        ]);

        // Returns user to index
        return redirect()->back()->with('success','Data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        // Destroy data with the corresponding id
        Registers::destroy($id);

        // Refresh page
        return redirect()->back()->with('success','Data successfully destroyed');
    }

    public function search(Request $request)
    {
        // Only activates if it was from an ajax call
        if($request->ajax())
        {
            // Select data by ('_column','_criteria','_input') and order them by ('_column','_sort | DESC | ASC')
            $data = Registers::where($request->filter,'like','%'.$request->search.'%')->orderBy($request->filter,$request->sort)->get();
            $token = $request->session()->token(); // Get token from request

            // Ready output variable for 
            $output = '';
            if (count($data)>0){
                $output = '
                    <table class="table table-striped" id="search-list">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10ch;">#</th>
                                <th scope="col">Designation</th>
                                <th scope="col" style="width: 15ch;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                foreach($data as $register){
                    $output .=
                    '
                    <tr>
                        <td scope="row">'. $register->id .'</td>
                        <td>'. $register->designation .'</td>
                        <td>
                            <form onsubmit="return confirm('."'Are you sure you want to delete this data?'".')" action="'. route('registers.destroy', ['register' => $register]) .'" method="POST">
                                <a href="'. route('registers.edit', ['register' => $register]).'" class="text-decoration-none">
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
                    <table class="table table-striped" id="search-list">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10ch;">#</th>
                                <th scope="col">Designation</th>
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
