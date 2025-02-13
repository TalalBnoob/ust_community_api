<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\Http\Request;

class SearchController extends Controller {
	public function search(Request $request) {
		$searchText = $request['text'];

		$posts = Post::query()
			->where('title', 'LIKE', "%{$searchText}%")
			->orWhere('body', 'LIKE', "%{$searchText}%")
			->get();

		foreach ($posts as $post) {
			$post->addRegularPostInfo($request->user()['id']);
		}

		$users = Student::query()
			->where('displayName', 'LIKE', "%{$searchText}%")
			->get();

		$users->merge(Staff::query()
			->where('displayName', 'LIKE', "%{$searchText}%")
			->get());

		return response()->json(['posts' => $posts, 'users' => $users]);
	}
}
