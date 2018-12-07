<?php

namespace App\Traits;

use App\Friendship;
use App\User;

trait Friendable
{
	public function addFriend($id)
	{
		$Friendship = Friendship::create([
			'requestor' => $this->id,
			'user_requested' => $id

		]);

		if($Friendship)
		{
			return $Friendship;
		}

		return 'Failed';
	}

	public function accept_friend($requestor)
	{
		$friendship = Friendship::where('requestor', $requestor)
						->where('user_requested', $this->id)
						->first();
		if($friendship)
		{
			$friendship->update([
				'status' => 1
			]);

			return response()->json('$friendship', 200);
		}
		return response()->json('fail', 501);
	}

	public function friends()
	{
		$friends = array();


		$f1 = Friendship::where('status', 1)
			->where('requestor', $this->id)
			->get();

		foreach ($f1 as $friendship):
			array_push($friends, \App\User::find($friendship->user_requested));
		endforeach;

		$friends2 = array();

		$f2 = Friendship::where('status', 1)
			->where('user_requested', $this->id)
			->get();

		foreach($f2 as $friendship):
			array_push($friends2, \App\User::find($friendship->requestor));
		endforeach;

		return array_merge($friends, $friends2);
	}

	public function pending_friend_requests()
	{
		$users = array();

		$friendships = Friendship::where('status', 0)
				->where('user_requested', $this->id)
				->get();

		foreach($friendships as $friendship):
			array_push($users, \App\User::find($friendship->requestor));
		endforeach;

		return $users;
	}

	public function pending_friend_requests_sent()
	{
		$users = array();

		$friendships = Friendship::where('status', 0)
				->where('requestor', $this->id)
				->get();
		foreach ($friendships as $friendship):
			array_push($users, \App\User::find($friendship->user_requested));
		endforeach;

		return $users;
	}

	public function friends_ids()
	{
		return collect($this->friends())->pluck('id')->toArray();
	}

	public function is_friends_with($user_id)
	{
		if(in_array($user_id, $this->friends_ids()))
		{
			return response()->json('true', 200);
		}
		else
		{
			return response()->json('false', 200);
		}
	}

}

?>