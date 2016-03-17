<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Exceptions\CustomException;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
	public function index()
	{
		try {
			$users = User::all();
			
			return response()->json($users, 200);
		}
		catch (\Exception $e)
        {
			$statusCode = $e instanceof CustomException ? $e->getCode() : 500;
			
            return response()->json([
				'errors' => ['message' => $e->getMessage()]
			], $statusCode);
        }
	}
	
	public function show($id)
	{
		try {
			$user = User::find($id);
			
			return response()->json($user, 200);
		}
		catch (\Exception $e)
        {
			$statusCode = $e instanceof CustomException ? $e->getCode() : 500;
			
            return response()->json([
				'errors' => ['message' => $e->getMessage()]
			], $statusCode);
        }
	}
	
    // public function store(Request $request)
	// {
	// 	try
	// 	{
	// 		$input = $request->all();
			
	// 		$validator = Validator::make($input, [
	// 			'name' => 'required|max:255',
	// 			'email' => 'required|email|unique:users|max:255',
	// 			'password' => 'required|min:6'
	// 		]);
			
	// 		if ($validator->fails()) {
	// 			return response()->json([
	// 				'errors' => $validator->errors()
	// 			], 400);
	// 		}
			
	// 		$user = User::create([
	// 			'name' => $input['name'],
	// 			'email' => $input['email'],
	// 			'password' => bcrypt($input['password']),
	// 		]);
			
	// 		return response()->json($user, 200);
	// 	}
	// 	catch (\Exception $e)
    //     {
	// 		$statusCode = $e instanceof CustomException ? $e->getCode() : 500;
			
    //         return response()->json([
	// 			'errors' => ['message' => $e->getMessage()]
	// 		], $statusCode);
    //     }
	// }
	
    // public function destroy($id)
    // {
	// 	try
    //     {
    //         $user = User::find($id);
			
	// 		if ($user) {
	// 			$user->delete();
	// 		}
			
    //         return response()->json($user, 200);
    //     }
	// 	catch (\Exception $e)
    //     {
	// 		$statusCode = $e instanceof CustomException ? $e->getCode() : 500;
			
    //         return response()->json([
	// 			'errors' => ['message' => $e->getMessage()]
	// 		], $statusCode);
    //     }
	// }
}
