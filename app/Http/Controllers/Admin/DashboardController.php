<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Review;
use App\Models\Film;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get user registration stats for the last 30 days
        $userStats = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', Carbon::now()->subDays(30))
        ->where('is_admin', 0) // Only regular users, not admins
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date')
        ->get();

        // Get review stats for the last 30 days
        $reviewStats = Review::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', Carbon::now()->subDays(30))
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date')
        ->get();

        // Fill in missing dates with 0 count
        $dates = [];
        $userCounts = [];
        $reviewCounts = [];
        
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = $date;
            
            $userCount = $userStats->where('date', $date)->first();
            $userCounts[] = $userCount ? $userCount->count : 0;
            
            $reviewCount = $reviewStats->where('date', $date)->first();
            $reviewCounts[] = $reviewCount ? $reviewCount->count : 0;
        }

        // Get overall statistics
        $totalUsers = User::where('is_admin', 0)->count();
        $totalReviews = Review::count();
        $totalFilms = Film::count();
        $totalAdmins = User::where('is_admin', 1)->count();
        $todayUsers = User::where('is_admin', 0)
            ->whereDate('created_at', Carbon::today())
            ->count();
        $todayReviews = Review::whereDate('created_at', Carbon::today())->count();

        return view('admin.dashboard', compact(
            'dates',
            'userCounts', 
            'reviewCounts',
            'totalUsers',
            'totalReviews',
            'totalFilms',
            'totalAdmins',
            'todayUsers',
            'todayReviews'
        ));
    }
}
