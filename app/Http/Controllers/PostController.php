<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function post(Request $request)
    {


        $total_user = User::count();
        if ($request->ajax()) {
            $num = 100;
            $posts = User::paginate($num);
            // echo $posts->count();
            $html = '';
            $page = (int)$request->page;
            $i = $num * ($page - 1);
            foreach ($posts as $post) {
                $i++;
                $html .= "
                <tr>
                    <td>$i</td>
                    <td>$post->uid</td>
                    <td>$post->name</td>
                    <td>$post->email</td>
                    <td>$post->mobile </td>
                    <td>$post->country</td>
                </tr>
            ";
            }

            return $html;
        }

        return view('post', compact('total_user'));
    }
}
