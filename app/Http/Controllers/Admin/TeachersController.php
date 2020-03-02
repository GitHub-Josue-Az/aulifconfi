<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TeachersController extends Controller{
    
    public function index(){
        
        $users = User::where('deleted', 0)->where('roles_id', 2)->get();
        
        return view('admin.teachers.index', compact('users'));
    }
    
    public function create(){
        
        return view('admin.teachers.create');
    }
    
    public function store(Request $request) {
        
        $request->validate([
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6',
        ]);
        
        $request->request->add(['roles_id' => 2]);  // Teacher
        
        $user = User::create($request->all());

        return redirect()->route('admin.teachers.index')->with('success', 'Registro guardado satisfactoriamente');
    }
    
    public function show($id){
        
        $user = User::findOrFail($id);
        
        return view('admin.teachers.show', compact('user'));
    }
    
    public function edit($id){
        
        $user = User::findOrFail($id);
        
        return view('admin.teachers.edit', compact('user'));
    }
    
    public function update(Request $request, $id) {
        
        $request->validate([
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $id,
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

        return redirect()->route('admin.teachers.index')->with('success', 'Registro guardado satisfactoriamente');
    }
    
    public function destroy($id){
        
        $user = User::findOrFail($id);
        $user->deleted = 1;
        $user->save();
//        $user->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
    
}
