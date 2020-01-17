<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

use App\Models\Project;
use App\Models\Customer;
use App\Models\Kit;
use App\Models\Packet;

class DashboardController extends Controller
{
    public function index()
    {   $user = Auth::user();
        if($user->role->name == 'admin') {
            $names = array('Proje Sayısı', 'Kullanıcı Sayısı', 'Kit Sayısı', 'Paket Sayısı');
            $backgrounds = array('aqua', 'green', 'yellow', 'red');
            $counts = array();
            array_push($counts, Project::all()->count());
            array_push($counts, Customer::all()->count());
            array_push($counts, Kit::all()->count());
            array_push($counts, Packet::all()->count());
            
            $dashboardCountList = array();
            foreach ($counts as $key => $count) {
                $_newItem = array('name' => $names[$key], 'count' => $count, 'background' => $backgrounds[$key]);
                array_push($dashboardCountList, $_newItem);
            }
            
            // This code only before 2020
            // and database only 2019 data
            $montlyCustomerCount = DB::table('customers')
                ->select(DB::raw("MONTH(created_at) as month"), DB::raw('count(id) as count_customer'))
                ->where('created_at', '<', Carbon::now())
                ->orderBy('created_at', 'asc')                
                ->groupBy(DB::raw("MONTH(created_at)"))
                ->get();
                
            $montlyProjectCount = DB::table('projects')
                ->select(DB::raw("MONTH(created_at) as month"), DB::raw('count(id) as count_project'))
                ->where('created_at', '<', Carbon::now())
                ->orderBy('created_at', 'asc')                
                ->groupBy(DB::raw("MONTH(created_at)"))
                ->get();

            return view('dashboard-admin', compact('dashboardCountList', 'montlyCustomerCount', 'montlyProjectCount'));
        }
        else {
            $names = array('Proje Sayısı', 'Sera Sayısı', 'Aktif Kit Sayısı', 'Pasif Kit Sayısı');
            $backgrounds = array('aqua', 'green', 'yellow', 'red');
            $counts = array();

            $projects = $user->customer->projects;
            array_push($counts, $projects->count());

            $projectAreaCount = 0;
            $activeProjectAreaKitCount = 0;
            $passiveProjectAreaKitCount = 0;
            foreach ($projects as $project) {
                $projectAreaCount += $project->projectArea->count();            

                foreach ($project->projectArea as $projectArea) {                    
                    foreach ($projectArea->projectAreaKits as $projectAreaKit) {
                        if ($projectAreaKit->is_online == 1)
                            $activeProjectAreaKitCount++;
                        else
                            $passiveProjectAreaKitCount++;
                    }
                }
            }

            array_push($counts, $projectAreaCount);
            array_push($counts, $activeProjectAreaKitCount);
            array_push($counts, $passiveProjectAreaKitCount);  
            
            $dashboardCountList = array();
            foreach ($counts as $key => $count) {
                $_newItem = array('name' => $names[$key], 'count' => $count, 'background' => $backgrounds[$key]);
                array_push($dashboardCountList, $_newItem);
            }

            $notifications = $user->customer->notifications->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]);

            return view('dashboard-customer', compact('dashboardCountList', 'notifications'));
        }  
    }

    public function permissionDenied()
    {
        return view('permission-denied');
    }
}
