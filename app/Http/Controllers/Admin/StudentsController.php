<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Place;
use App\Models\Management;
use App\Models\Charge;



class StudentsController extends Controller{
    
    public function index(){
        
        $users = User::where('deleted', 0)->where('roles_id',2)->get();
        
        return view('admin.students.index', compact('users'));
    }
    
    
    public function create(){

         $places= Place::all();
         $managements= Management::all();
         $charges= Charge::orderBy('title')->get();
        
        return view('admin.students.create',compact('places','managements','charges'));
    }
    
    public function store(Request $request) {   

        
        $request->validate([
            'firstname' => 'required|max:100',
            'places_id' => 'required|max:100',
            'charges_id' => 'required|max:100',
            'managements_id' => 'required|max:100',
            'email' => 'required|max:100|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        
        $request->request->add(['roles_id' => 2]);  // Student
        
        $user = User::create($request->all());

        return redirect()->route('admin.students.index')->with('success', 'Registro guardado satisfactoriamente');
    }
    
    public function show($id){
        
        $user = User::findOrFail($id);
        
        return view('admin.students.show', compact('user'));
    }
    
    public function edit($id){
        
        $user = User::findOrFail($id);
        
        return view('admin.students.edit', compact('user'));    
    }
    
    public function update(Request $request, $id) {
        
        $request->validate([
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'email' => 'required|max:100|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);
        
        $user = User::findOrFail($id);
        
        if ($request->get('password') == '') {
            $request->request->remove('password');
        }
        
        if ($request->has('status')) {
            $request->request->set('status', '1');
        } else {
            $request->request->set('status', '0');
        }
        
        $user->update($request->all());

        return redirect()->route('admin.students.index')->with('success', 'Registro guardado satisfactoriamente');
    }
    
    public function destroy($id){
        
        $user = User::findOrFail($id);
        $user->deleted = 1;
        $user->save();
//        $user->delete();

        return redirect()->route('admin.students.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
    
}
