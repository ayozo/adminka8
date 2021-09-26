<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;
use function GuzzleHttp\Psr7\str;

class TaskController extends Controller
{
    public function index(){
        $tasks = DB::table('tasks')->paginate(1);
//        dd($task);
        return view('pages.task.index', compact('tasks'));

    }

    public function add(){
        return view('pages.task.add');
    }

    public function store(Request $request){
        $v = $this->validate($request,[
            'name' => ['required', 'string', ],
            'start' => ['required', 'string', 'regex:/[0-9]{4}-[0-9]{2}-[0-9]{2}/'],
            'end' => ['required', 'string', 'regex:/[0-9]{4}-[0-9]{2}-[0-9]{2}/'],
        ]);
        if (strtotime($request->start) > strtotime($request->end)){
            return back()->with('error', 'start date must be small than end date');
        }
         Task::create([
            'name' => $request->name,
            'start' => $request->start,
            'started' => $request->start,
            'ended' => $request->end,
            'status' => 1,
            'end' => $request->end
        ]);
        success_message('create task');
        return redirect()->route('task.index');
    }

    public function edit(Request $request){

        $v = Validator::make($request->all(),[
            'task_id'=>'required|numeric'
        ]);

        if($v->failed()){
            dd($v->errors());
        }

        $task = Task::where('id', $request->task_id)->first();

        return view('pages.task.edit', compact('task'));
    }

    public function update(Request $request){
        $v = Validator::make($request->all(),[
            'task_id'=>'required|numeric',
            'name' => ['required', 'string', 'max:255'],
            'start' => ['required', 'string'],
            'end' => ['required', 'string'],
        ]);
        if($v->failed()){
            dd($v->errors());
        }

        $task = Task::where('id', $request->task_id)->first();
        $task->update($request->all());
        success_message('update task');
        return redirect()->route('task.index');

    }
    public function show(Request $request){
        $v = Validator::make($request->all(),[
            'task_id'=>'required|numeric'
        ]);

        if($v->failed()){
            dd($v->errors());
        }

        $task = Task::where('id', $request->task_id)->first();
        return view('pages.task.show', compact('task'));
    }
    public function delete(Request $request){
        $v = Validator::make($request->all(),[
            'task_id'=>'required|numeric'
        ]);
        if($v->failed()){
            dd($v->errors());
        }
        $task = Task::where('id', $request->task_id)->first();
        $task->delete();
        success_message('deleted task');
        return back();
    }
    public function started(Request $request){

        $v = Validator::make($request->all(),[
            'task_id'=>'required|numeric'
        ]);
        if($v->failed()){
//            dd($v->errors());
            error_message($v->errors()->first());
        }

        $task = Task::where('id', $request->task_id)->update(['started' => date('Y-m-d H:i:s')]);
        $task = Task::where('id', $request->task_id)->update(['status' => 2]);
        success_message('started task');
        return back();
    }
    public function ended(Request $request){
        $v = Validator::make($request->all(),[
            'task_id'=>'required|numeric'
        ]);
        if($v->failed()){
            dd($v->errors());
        }
        $task = Task::where('id', $request->task_id)->update(['ended' => date('Y-m-d H:i:s')]);
        $task = Task::where('id', $request->task_id)->update(['status' => 3]);
        success_message('ended task');
        return back();
    }

}
