<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class QueryBuilderController extends Controller
{
    public function index()
    {
        $queries = [];

        // 1. All users
        $queries['all_users'] = DB::table('users')->get();

        // 2. User with id 1
        $queries['user_id_1'] = DB::table('users')->where( 'id' ,1)->get();

        // 3. Select specific columns
        $queries['name_email'] = DB::table('users')->select('name', 'email')->get();

        // 4. Name contains 'm'
        $queries['name_like_m'] = DB::table('users')->where('name', 'like', '%m%')->get();

        // 5. Created after 2023-01-01
        $queries['created_after'] = DB::table('users')->where('created_at', '>=', '2023-01-01')->get();

        // 6. Order by name ASC
        $queries['ordered_by_name'] = DB::table('users')->orderBy('name', 'asc')->get();

        // 7. Limit 5 users
        $queries['limit_5'] = DB::table('users')->limit(5)->get();

        // 8. Count users
        $queries['count'] = DB::table('users')->count();

        // 9. Average age
        $queries['avg_age'] = DB::table('users')->avg('age');

        // 10. Max age
        $queries['max_age'] = DB::table('users')->max('age');

        return view('queries', compact('queries'));
    }
}
