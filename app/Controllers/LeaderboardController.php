<?php

namespace App\Controllers;

use App\Models\LeaderboardModel;

class LeaderboardController extends BaseController
{
    public function index()
    {
        $leaderboardModel = new LeaderboardModel();
        $topUsers = $leaderboardModel->getTopUsers();

        $data = [
            'title' => 'Peringkat & Reward | Zona Belanja',
            'topUsers' => $topUsers
        ];

        return view('leaderboard', $data);
    }
}
