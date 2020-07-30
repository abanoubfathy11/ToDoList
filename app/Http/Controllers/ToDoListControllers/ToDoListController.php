<?php


namespace App\Http\Controllers\ToDoListControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToDoRequest;
use App\Models\ToDoList;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
;

class ToDoListController extends Controller
{
    //
    public function goToHome()
    {
        return redirect()->route('home');
    }

    public function index()
    {

        return view('home')->with('data',ToDoList::get());
        
    }
    public function create(ToDoRequest $request)
    {

        $task= new ToDoList();

        if($request->taskImage!='')
            $fileName=$this->uploadPhoto($request->taskImage);
        else
            $fileName=Null;

        $task::create([
            'name'=>$request->taskName,
            'category'=>$request->taskCategory,
            'image'=>$fileName,
            'description'=>$request->taskDesc,

        ]);
        return redirect()->route('home')->with(['success'=>__('messages.addTaskSuccessfully')]);
    }

    public function uploadPhoto($image)
    {
        $fileExtension=$image->getClientOriginalExtension();
        $fileName=time().'.'.$fileExtension;
        $filePath='images';
        $image->move($filePath,$fileName);
        return $fileName;
    }
    public function edit($id)
    {


        if(is_numeric($id))
        {
            $task=ToDoList::find($id);

            if(!$task)
                return redirect()->route('home')->with(['fail'=>__('messages.thisIdDosentExist')]);
            $task=ToDoList::select('id','name','category','image','description')->find($id);
            return view('homeUpdate',compact('task'));
        }
        else{
            return redirect()->route('home')->with(['fail'=>__('messages.notANumber')]);
        }
    }

    public function update($id,ToDoRequest $request)
    {
        $task=ToDoList::find($id);

        if(!$task)
        return redirect()->route('home')->with(['fail'=>__('messages.thisIdDosentExist')]);

        if($request->taskImage!='')
            $fileName=$this->uploadPhoto($request->taskImage);
        else
            $fileName=$task->image;


        $task->update([
            'name'=>$request->taskName,
            'category'=>$request->taskCategory,
            'image'=>$fileName,
            'description'=>$request->taskDesc,
        ]);

        return redirect()->route('home')->with(['success'=>__('messages.taskHasBeenUpdated')]);


    }
    public function delete($id)
    {
        if(is_numeric($id))
        {
            $task=ToDoList::find($id);
            if(!$task)
            return redirect()->route('home')->with(['fail'=>__('messages.thisIdDosentExist')]);

            $task->delete($id);
            return redirect()->route('home')->with(['success'=>__('messages.taskHasBeenDeleted')]);
        }
        else
        {
            return redirect()->route('home')->with(['fail'=>__('messages.notANumber')]);
        }
    }
}
