<?php

namespace App\Http\Controllers;
use \App\User;
use \App\Post;
use Image;
use Auth;
use DB;


use Illuminate\Http\Request;

class ProfileController extends Controller
{
   public function profile($username){
   		$user = User::where('username', $username)->first();
      // dd($user);

   		return redirect()->view('users.profile')->with(compact('user'));

   	}

   	public function update_avatar(Request $request){
   		
   			
   		if($request->hasFile('avatar')){
   			$avatar = $request->file('avatar');
   			$filename = time() . '.'. $avatar->getClientOriginalExtension();
   			Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename));

   			$user = Auth::user();
   			$user->avatar = $filename;
   			$user->save();
   		}


   			return view('users.profile', compact('user'));

   	}

   	public function feed(){
   		$posts = Post::all();
   		return view('/users/profile', compact('posts'));
   	}

     public function show($id)
    {
        $post = Post::orderBy('created_at', 'desc')->get();
        $post = Post::findOrFail($id);
       
        return view('posts.show', compact('post'));
    }
       public function create()
    {
        return view('posts.create');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $posts = Post::paginate(5);

        return view('posts.index', compact('posts')->withname('profile/{username}'));
    }

      public function store(Request $request)
    {
       
        Post::create($request->all());

        return redirect('/profile/{username}');

    }

     public function edit($id)
    {
        $post = Post::findOrFail($id);
       
       return view('posts.edit', compact('post')->withname('profile/{username}'));
        
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if( ! isset($request->live))
            $post->update(array_merge($request->all(), ['live' => false]));
        else
            $post->update($request->all());

        return redirect('/profile/{username}');

    }

    public function findFriends(){
        $uid = Auth::user()->id;

        $allUsers = DB::table('users')->where('id', '!=', $uid)->get();

        return view('profile.findFriends', compact("allUsers"));
    }

    public function sendRequest($id){
      Auth::user()->addFriend($id);
      return back();
    }

    public function requests(){
      $uid = Auth::user()->id;

      $FriendRequests = DB::table('friendships')
            ->rightJoin('users', 'users.id', '=', 'friendships.requestor')
            ->where('status', 0)
            ->where('friendships.user_requested', '=', $uid)->get();

      return view('profile.requests', compact('FriendRequests'));
    }

    public function accept($firstname, $id){
       $uid = Auth::user()->id;

       $checkRequest = DB::table('friendships')->where('requestor', $id)
                  ->where('user_requested', $uid)
                  ->first();
        if($checkRequest)
        {
          // echo "yes, Update here";
          $updateFriendship = DB::table('friendships')
                    ->where('user_requested', $uid)
                    ->where('requestor', $id)
                    ->update(['status'=> 1]);

              if($updateFriendship){

                return back()->with('msg', 'You are now friend with '. $firstname);
              }
              
        } else{
            return back()->with('msg', 'You are now friend with '. $firstname);
          }
    }

    public function friends(){
      $uid = Auth::user()->id;

      $friends1 = DB::table('friendships')
            ->leftJoin('users', 'users.id', 'friendships.user_requested') //who is not log in
            ->where('status', 1)
            ->where('requestor', $uid) //who is logged in
            ->get();

        

      $friends2 = DB::table('friendships')
          ->leftJoin('users', 'users.id', 'friendships.requestor')
          ->where('status', 1)
          ->where('user_requested', $uid)
          ->get();

      $friends = array_merge($friends1->toArray(), $friends2->toArray());

      return view('profile.friends', compact('friends'));
    }

    public function requestRemove($id){
        $uid = Auth::user()->id;

        DB::table('friendships')
            ->where('user_requested', $uid)
            ->where('requestor', $id)
            ->delete();

        return back()->with('msg', 'Request has been deleted');
    }

    public function editProfile(){

      return view('profile.editProfile');
    }
  
    public function updateProfile($id, Request $request){
      $user_id = Auth::user()->id;
      // $user = DB::table('users')->where('id', $user_id)->first();
      $user = User::find($user_id);
      // dd($user);
      $rules = array(
          'firstname' => 'required',
          'lastname' => 'required',
          'address' => 'required',
          'phone' => 'required|numeric',
          'bio' => 'required'
      );

      $this->validate($request, $rules);
      $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'phone' => $request->phone,
            'bio' => $request->bio
        ]);
      $user = User::find($user_id); 
      $friends = Auth::user()->friends();
     
      return redirect('profile/' . $user->username)->with(compact('user'));
      $friends = Auth::user()->friends();
    }
    
    public function allFriends($id, Request $request){
      $friends = Auth::user()->friends();
      dd($friends);

    }

}
