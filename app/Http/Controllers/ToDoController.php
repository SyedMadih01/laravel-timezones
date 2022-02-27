<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use PhpParser\Node\Expr;

class ToDoController extends Controller
{
    public function create(Request $request) {

        $validatedData = $request->validate([
            'description' => 'required|max:255',
            'deadline' => 'required'
        ]);

        try{
            $task = new ToDo();
        $task->task_description = $request->description;
        $task->deadline = date('Y-m-d H:i:s',strtotime($request->deadline));
        $task->created_by = auth()->user()->id;
        $task->save();

        return redirect('home')->with('message','Task Added!');

        } catch (Exception $ex){

            return redirect('home')->with('error-message',$ex->getMessage());

        }

    }
}
