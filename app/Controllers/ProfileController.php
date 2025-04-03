<?php namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index()
    {
 
        $userModel = new UserModel();
        $userId = session()->get('user_id'); 
        $user = $userModel->find($userId); 

        
        return view('profile/index', [
            'user' => $user
        ]);
    }

    public function update()
    {
        
    }
}
