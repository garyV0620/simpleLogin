<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginCredRequest;
use App\Http\Requests\UserInfoRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegister(){
        return view('authentication.register');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //delete the session for upload image
        session()->forget('tempImagePath');
        session()->forget('path');
        return view('authentication.login');
    }

    public function authenticate(loginCredRequest $request){
        $credentials = $request->validated();

        if(Auth::attempt($credentials)){
            //check in API login then create a api_token
            if($request->expectsJson()){
                $user = Auth::user();
                if(empty($user->api_token) || is_null($user->api_token)){
                    $user->update(['api_token' => Str::random(80)]);
                }

                return $this->sendResponse(['email' => $user->email, 'token' => $user->api_token], $user->email.' login Successful. Use the token provided in Bearer Token');
            }
            //if not an API request just log in
            return redirect()->route('dashboard')->with('message', Auth::user()->email . ' Login Successfully!');
        }
        if($request->expectsJson()){
            return $this->sendError("Email or Password not correct", [], 202);
        }
        return back()->withErrors(['invalid' => 'Email or Password not correct'])->onlyInput('email');
    }

    public function logout(Request $request){
        $email = Auth::user()->email;
        
        //logout in API
        if($request->expectsJson()){
            Auth::user()->update(['api_token' => null]);
            return $this->sendResponse(['email' => $email], $email . ' LogOut successfully. Token revoke and need to logIn again to replace token');
        }

        //logout in webpages
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('message', $email.' Logout Success!');
    }

    public function dashboard(Request $request){
        //check if request is from an api
        if($request->expectsJson()){
            $allUsers = User::all();
            return $this->sendResponse(UserResource::collection($allUsers), 'Fetch all User Success');
        }
        //need to put select so that table can be dynamic
        $allUsers = User::select(['id', 'firstName', 'email', 'role'])->get();
        return view('pages.dashboard', ['userData' => $allUsers]);
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
        
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|max:10',
            'lastName' => 'required|max:10',
            'email' => ['required', 'unique:users,email'],
            'password' => 'required|confirmed|min:3',
            'gender' => 'required',
            'image' => 'image',
        ]);

        //check if a file is upload and if no error and if no session
        //if Storage is used it is relative the Storage/app/path
        if($request->hasFile('image') && !$validator->errors()->has('image')){
            // upload image temporary
            //this path has public/
            $path = Storage::putFileAs('public/temporary', $request->file('image'), $request->file('image')->getClientOriginalName());
            //this will remove the /public in path and add storage/ in the path
            //this path is needed to show image on the UI
            $tempStorage = Storage::url($path);
            session(['tempImagePath' => $tempStorage ?? '', 'path' => $path]);
        }
        //if error in validate redirect with input
        if ($validator->fails()) {
            return redirect('showRegister')
                        ->withErrors($validator)
                        ->withInput();
        }
        $validatedData = $validator->validated();
        
        $validatedData['password'] = bcrypt($validatedData['password']);
        if($request->hasFile('image')){
            $newFileName =  $validatedData['lastName'] . time(). '.' . $request->file('image')->getClientOriginalExtension();
            $validatedData['image'] = $newFileName;
        }
        //save data to the DB
        $user = User::create($validatedData);

        //check if session exist then copy the file to img then delete temporary save
        if(session()->has('tempImagePath')){
            //copy the temp save file
            Storage::copy(session('path'), 'public/img/'. $newFileName);
            
            session()->forget('tempImagePath');
            session()->forget('path');
        }
        //to delete we need the path with public/
        // Get an array of all files within the directory
        $files = Storage::files('public/temporary');
        // Loop through and delete each file
        foreach ($files as $file) {
            Storage::delete($file);
        }
        return redirect()->route('login')->with('message', $user->email . ' has been Register successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
