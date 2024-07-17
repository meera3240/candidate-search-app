<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * search
     * @param Request $request
     * @return \Illuminate\Container\Container|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse|mixed|object
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::select('users.name', 'departments.name as department_name', 'designations.name as designation_name')
                ->join('departments', 'users.department_id', '=', 'departments.id')
                ->join('designations', 'users.designation_id', '=', 'designations.id');

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where(DB::raw('LOWER(users.name)'), 'like', '%' . strtolower($search) . '%')
                        ->orWhere(DB::raw('LOWER(departments.name)'), 'like', '%' . strtolower($search) . '%')
                        ->orWhere(DB::raw('LOWER(designations.name)'), 'like', '%' . strtolower($search) . '%');
                });
            }

            $users = $query->get();

            return response()->json($users);
        }

        return view('pages.web.user.index');
    }

}
