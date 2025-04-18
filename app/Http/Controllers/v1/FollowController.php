<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Follower;
use App\Models\User;
use App\Notifications\NewFollowNotification;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request, string $followed_id)
    {
        $isUserExist = User::query()->find($followed_id);
        $isFollowed = Follower::query()->where('follower_id', $request->user()['id'])->where('followed_id', $followed_id)->first();

        if ($isFollowed) {
            return response()->json(['message' => 'already followed'], 409);
        }
        if (!$isUserExist) {
            return response()->json(['message' => 'user dose not exist'], 404);
        }

        Follower::create([
            'follower_id' => $request->user()['id'],
            'followed_id' => $isUserExist['id']
        ]);

        $username = User::addUserProfileInfo($request->user()['id'])->displayName;

        $isUserExist->notify(new NewFollowNotification($username));

        return response()->json(['message' => 'user has been followed']);
    }

    public function unfollow(Request $request, string $followed_id)
    {
        $isFollowed = Follower::query()->where('follower_id', $request->user()['id'])->where('followed_id', $followed_id)->first();

        if (!$isFollowed) {
            return response()->json('follow not found', 404);
        }

        $isFollowed->delete();

        return response()->json(['message' => 'user has been un followed']);
    }
}
