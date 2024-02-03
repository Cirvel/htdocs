<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Database screen
     */
    public function index()
    {
        if(!auth()->id()){ // If not auth, redirect to login
            return redirect()->route('session.login');
        }elseif (!auth()->user()->is_admin) { // If not admin, redirect to home
            return redirect()->route('home');
        }

        $users = User::all();

        return view('users.index', ['users_fetch' => $users]);
    }
    /**
     * Login screen
     */
    public function index_2()
    {
        return view('session.index');
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

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate data
        $pField = $request->validate([
            'username' => ['required','min:4','max:20'],
            'password' => ['required','min:4','max:100'],
            'nickname' => ['required','min:4','max:35'],
            'email' => ['required','email'],
            'is_admin',
        ]);
        
        $pField['username'] = strip_tags($pField['username']);
        $pField['nickname'] = strip_tags($pField['nickname']);
        $pField['password'] = bcrypt($pField['password']);
        $pField['email'] = strip_tags($pField['email']);
        $pField['is_admin'] = $request['is_admin'] == "on" ? 1 : 0;
        
        // Stores data
        User::create($pField);

        // Returns to index
        return redirect()->route('users.index')->with('success','Data successfully stored');
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
        $user = User::findOrFail($id);
        
        // If user is trying to edit itself, redirect them
        if (auth()->id() == $id) {
            return redirect()->route('users.index');
        }

        // Redirect to edit form with the collected data
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate data before updating
        $pField = $request->validate([
            'username' => ['required','min:4','max:20'],
            // 'password' => ['required','min:4','max:100'],
            'nickname' => ['required','min:4','max:35'],
            'email' => ['required','email'],
            'is_admin',
        ]);

        $request['username'] = strip_tags($pField['username']);
        $request['nickname'] = strip_tags($pField['nickname']);
        $request['email'] = strip_tags($pField['email']);
        $request['is_admin'] = $request['is_admin'] == "on" ? 1 : 0;

        User::findOrFail($id)->update([
            'username' => $request->username,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'is_admin' => $request['is_admin'],
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
        User::destroy($id);

        // If user destroy an account with their id on it, log out
        if (auth()->hasUser() && auth()->id() == $id) {
            return redirect()->route('session.logout');
        };

        // Refresh page
        return redirect()->back()->with('success','Data successfully destroyed');
    }

    /**
     * Logout of account
     */
    public function logout() {
        // Logout user same way as session_destroy()
        auth()->logout();
        // Redirect user to home page
        return redirect()->route('session.login');
    }

    /**
     * Login to user
     */
    public function auth(Request $request) {
        // Requires all field to be filled
        $validateField = $request->validate([
            "username"  => "required",
            "password"  => "required",
        ]);

        // Check for account with same username and password together
        if (auth()->attempt(['username' => $validateField['username'], 'password' => $validateField['password'] ])) {
            $request->session()->regenerate();
            return redirect("/")->with("success","Account successfully logged in.");
        }
        
        return redirect()->route('session.login')->with("error","Invalid username or password.");
        // return redirect("")->with("error","Invalid username or password.");
    }

    public function login(Request $request) {
        // Requires all field to be filled
        // $validateField = $request->validate([
        //     "username"  => "required",
        //     "password"  => "required",
        // ]);

        // Check for account with same username and password together
        // if (auth()->attempt(['username' => $validateField['username'], 'password' => $validateField['password'] ])) {
        //     $request->session()->regenerate();
        //     return redirect()->route('home')->with("success","Account successfully logged in.");
        // }
        
        return redirect()->back()->with("failed","Invalid username or password.");
    }

    /**
     * Create new account
     */
    public function register(Request $request) { // Dep: Illuminate\Http\Request
        // Check if field met criteria
        $incomingFields = $request->validate([
            'nickname'  => ['required','min:4','max:20'],
            'username'  => ['required','min:5','max:35'],
            'password'  => ['required','min:8','max:200'],
            'email'     => ['required','email'],
        ]);
        // Encrypts password
        $incomingFields['password'] = bcrypt($incomingFields['password']);

        // Create user row
        $newUser = User::create($incomingFields); // Dep: App\Models\User
        // Automatically authenticate newly registered accoutn
        auth()->login($newUser);

        // Redirect user to Home
        return redirect()->route('home')->with('success','Account successfuly registered.');
    }
    
    /**
     * Search for user
     */
    public function search(Request $request)
    {
        // Only activates if it was from an ajax call
        if($request->ajax())
        {   
            // Select data by ('_column','_criteria','_input') and order them by ('_column','_sort | DESC | ASC')
            $data = User::where($request->filter,'like','%'.$request->search.'%')->orderBy($request->filter,$request->sort)->get();
            $token = $request->session()->token(); // Get token from request

            // Ready output variable for 
            $output = '';
            if (count($data)>0){
                $output = '
                <table class="table table-striped" id="search_list">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10ch;">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Nickname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Is Admin</th>
                            <th scope="col" style="width: 15ch;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
                foreach($data as $user){
                    $output .=
                    '<tr>
                        <td scope="row">'. $user->id .'</td>
                        <td>'. $user->username .'</td>
                        <td>'. $user->password .'</td>
                        <td>'. $user->nickname .'</td>
                        <td>'. $user->email .'</td>
                        <td>';
                        if ($user->is_admin == 1) { // If user is an admin
                            $output .= '<i class="fas fa-star fa-sm fa-fw"></i> Admin';
                        } else { // if user is not an admin
                            $output .= '<i class="fas fa-cash-register fa-sm fa-fw"></i> Cashier';
                        }
                    $output .=
                    '</td>
                        <td>';
                            if (!auth()->id() == $user->id){ // If the row is the user, remove option
                                $output .=
                                '
                                <form onsubmit="return confirm('."'Are you sure you want to delete this data?'".')" action="'.route('users.destroy', ['user' => $user]).'" method="POST">
                                <a href="'.route('users.edit', ['user' => $user]) .'" class="text-decoration-none">
                                <button type="button" class="btn btn-warning mb-1"><i class="fas fa-edit"></i></button>
                                </a>
                                <input type="hidden" name="_token" value="'. $token .'"/>
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-danger mb-1"><i class="fas fa-trash"></i></button>
                                </form>
                                ';
                            } else { // Instead give them the option to log out
                                $output .=
                                '
                                <a href="/logout">
                                <button class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"></i> <span class="d-none d-md-inline">Log out</span> </button>
                                </a>
                                ';
                            }
                    $output .=
                        '</td>
                    </tr>'
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
