<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Items;
use App\Models\Registers;
use App\Models\Struk;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class StrukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->id()) { // If not auth, redirect to login
            return redirect()->route('session.login');
        }
    
        // Get data
        $nickname = auth()->id() ? auth()->user()->nickname : "Anonymous"; // Get nickname, use latter if none
        $catalog = Items::all(); // Get all items into catalog
        $categories = Categories::all(); // Get all categories
        $registers = Registers::all(); // Get all registers
        $cart = session()->get('cart'); // Get cart save


        return view('struk.index',
        [
            'nickname' => $nickname,
            'catalog' => $catalog,
            'cart' => $cart,
            'categories' => $categories,
            'registers' => $registers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $product = Items::find($request['itemDropdown']); // Get product through id
        // $oldCart = session()->has('cart') ? session()->get('cart') : null; // Check for cart
        // $cart = new Struk($oldCart); // Create new cart
        // $cart->store($product,$product->id);

        // $request->session()->put('cart',$cart);

        // OLD

        // session()->flush();

        // $request->validate([
        //     'id' => 'required',
        //     'item_id' => ['required'.'unique:item_id'],
        //     'quantity' => ['required','min:1'],
        // ]);

        // $pField = collect([ 
        //     'id'=>'1',
        //     'item_id'=>$request['itemDropdown'],
        //     'quantity'=>$request['amount'],
        // ]);
        
        // session()->push('cart', $pField);

        $id = $request['item'];

        $item   = Items::findOrFail($id);
        $struk  = session()->get('cart', []);
        if(isset($struk[$id]))
        { // If item is already in the struk, simply alter its amount
            $struk[$id]['amount'] = $request['amount'];
        } else { // Insert new item in struk if it did not exists previously
            $struk[$id] = [
                "item_name" => $item->name,
                "category_name" => $item->categoryFK->name,
                "price" => $item->price,
                "amount" => $request['amount'],
                "total" => $request['amount'] * $item->price,
            ];
        }

        session()->put('cart',$struk);

        return redirect()->back()->with('success','Data successfully stored');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function flush()
    {
        $cart = session()->get('cart');
        session()->flush();

        return redirect()->back()->with('success','Data successfully removed');
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart',$cart);
            }
            session()->flash('success','Insert Message Here');

            return redirect()->back()->with('success','Data successfully removed');
        }
    }

    /**
     * Refresh items dropdown upon changing the item category selection
     */
    public function dropdown(Request $request)
    {
        if ($request->ajax()) {
            // Select items with the chosen dropdown id
            $data = Items::where('category_id', '=', $request->search )->orderBy('name','desc')->get();
            if (count($data) > 0) { // If theres 1 or more row
                $output = '<select class="form-select form-select-lg" name="item-dropdown" id="item-dropdown">
            ';
                foreach ($data as $item) {
                    $output .=
                        '
                        <option value="'.$item->id.'">'.$item->name.'</option>
                        ';
                }
                $output .= '</select>';
            } else { // If none, show empty
                $output = '<select class="form-select form-select-lg" name="item-dropdown" id="item-dropdown">
                <option value="0">
                    No data found
                </option>
                </select>';
            }
        }

        return $output; // Return modified table
    }
    /**
     * Search engine for catalogue
     */
    public function search(Request $request)
    {
        // Only activates if it was from an ajax call
        if ($request->ajax()) {

            $data = Items::with('categoryFK:*')->where($request->filter, 'like', '%' . $request->search . '%')->select(['items.*'])->orderBy($request->filter, $request->sort)->get();
            $token = $request->session()->token(); // Get token from request
            if ($request->filter == "category_id") { // Search filter that uses the category name to find it instead of id
                $data = Items::whereHas('categoryFK', function ($p) use ($request) {
                    $p->where('name', 'like', '%' . $request->search . '%');
                })->get();
            } elseif ($request->filter == "quantity" or $request->filter == "price" or $request->filter == "id") { // Search for integer field, descending mean lower and vice versa
                if ($request->sort == "asc") { // Higher than search value
                    $data = Items::with('categoryFK:*')->where($request->filter, '>=', $request->search)->select(['items.*'])->orderBy($request->filter, $request->sort)->get();
                } else // $request->sort == "desc"
                { // Lower than search value
                    $data = Items::with('categoryFK:*')->where($request->filter, '<=', $request->search)->select(['items.*'])->orderBy($request->filter, $request->sort)->get();
                }
            }
            // Ready variable for return
            $output = '';
            if (count($data) > 0) { // If theres 1 or more row
                $output = '
                <div class="row row-cols-1 row-cols-md-2 g-2 text-center" id="search_list">';
                foreach ($data as $item) {
                    $output .=
                        '<div class="col card">
                        <div class="offcanvas-bottom d-flex">
                            <p><b>' . $item->name . '</b></p>
                            <div class="ms-auto">
                                <p>' . $item->categoryFK->name . '</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <b>' . $item->quantity . 'x | Rp. ' . number_format($item->price, 2) . '</b>
                        </div>
                    </div>';
                }
                $output .= '
                </div>';
            } else { // If none, show empty
                $output = '
                <div class="row row-cols-1 row-cols-md-2 g-2 text-center" id="search_list">
                Null
                </div>
                ';
            }

            return $output; // Return modified table
        }
    }
}
