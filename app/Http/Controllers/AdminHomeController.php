<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;


class AdminHomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $userPerMonth = array();

        for ($i = 1; $i <= 12; $i++) {
            $age = 12 - $i;
            $userPerMonth[$i] =
                count(User::whereMonth('created_at', '=', date('n') - $age)
                ->whereYear('created_at', '=' ,date('Y') )
                ->get());
        }
        return view('admin.home')->with(['users' => $userPerMonth]);
    }
}
