<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Items;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
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

        $items = Items::all();

        return view('items.index', ['items_fetch' => $items]);
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

        $categories = Categories::all();
        return view('items.create',['categories' => $categories]);
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
            'category_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        // Stores data
        Items::create($pField);

        // Returns to index
        return redirect()->route('items.index')->with('success','Data successfully stored');
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
     */
    public function edit(string $id)
    {
        // Find row id
        $item = Items::findOrFail($id);
        $categories = Categories::all();
        
        // Redirect to edit form with the collected data
        return view('items.edit', ['item' => $item],['categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate data before updating
        $pField = $request->validate([
            'name' => ['required','max:35'],
            'description' => 'required',
            'category_id',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        // Updates data
        Items::findOrFail($id)->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
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
        Items::destroy($id);

        // Refresh page
        return redirect()->back()->with('success','Data successfully destroyed');
    }

    public function search(Request $request)
    {   
        // Only activates if it was from an ajax call
        if($request->ajax())
        {
            
            $data = Items::with('categoryFK:*')->where($request->filter,'like','%'.$request->search.'%')->select(['items.*'])->orderBy($request->filter,$request->sort)->get();
            $token = $request->session()->token(); // Get token from request
            if ($request->filter == "category_id")
            { // Search filter that uses the category name to find it instead of id
                $data = Items::whereHas('categoryFK', function($p) use($request) {$p->where('name','like','%'.$request->search.'%');})->get();
            } elseif ($request->filter == "quantity" or $request->filter == "price" or $request->filter == "id")
            { // Search for integer field, descending mean lower and vice versa
                if($request->sort == "asc")
                { // Higher than search value
                    $data = Items::with('categoryFK:*')->where($request->filter,'>=',$request->search)->select(['items.*'])->orderBy($request->filter,$request->sort)->get();
                } else // $request->sort == "desc"
                { // Lower than search value
                    $data = Items::with('categoryFK:*')->where($request->filter,'<=',$request->search)->select(['items.*'])->orderBy($request->filter,$request->sort)->get();
                }
            }
            // Ready variable for return
            $output = '';
            if (count($data)>0){ // If theres 1 or more row
                $output = '
                <div id="table-categories" class="table-responsive mt-3">
                    <table class="table table-striped" id="search_list">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10ch;">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Category</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Price</th>
                                <th scope="col" style="width: 15ch;">Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                foreach($data as $item){
                    $output .=
                    '<tr>
                        <td scope="row">'.$item->id.'</td>
                        <td>'.$item->name.'</td>
                        <td>'.$item->description.'</td>
                        <td>'.$item->categoryFK->name.'</td>
                        <td>'.$item->quantity .'x</td>
                        <td>Rp. '.number_format($item->price, 2).'</td>
                        <td>
                            <form onsubmit="return confirm('."'Are you sure you want to delete this data?'".')" action="'. route('items.destroy', ['item' => $item]) .'" method="POST">
                                <a href="'. route('items.edit', ['item' => $item]).'" class="text-decoration-none">
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
            } else { // If none, show empty
                $output = '
                <div id="table-categories" class="table-responsive mt-3">
                    <table class="table table-striped" id="search_list">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10ch;">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Category</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Price</th>
                                <th scope="col" style="width: 15ch;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                ';
            }

            return $output; // Return modified table
        }
    }
    
}
