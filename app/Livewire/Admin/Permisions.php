<?php

namespace App\Livewire\Admin;
use App\Models\Permision;
use App\Models\Role;
use App\Models\RolePermision;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layout.app')]
class Permisions extends Component
{
    use WithPagination;
    public $open = false;
    public $editableId='';
    public $editVal;
    public $role;
    public $title;
    public $myPermissions;
    public $checked=false;
    
    






    public $selectedToAdd = '';
    public $selectedToRemove = '';
    
    public function addPermission($id){
        try{
            DB::insert('insert IGNORE into role_permision (permision_id, role_id) values (?, ?)', [$this->selectedToAdd, $id]);
        }catch(Exception $e){
            return session()->flash("error","You Must Select a Value");
        }
    }
    public function remove($id){
        try{
        DB::delete("delete from role_permision where permision_id = $this->selectedToRemove AND role_id = $id");    
}catch(Exception $e){
    return session()->flash("error","You Must Select a Value");
}
    }











    public function errorMessage($action,$roleTitle){
        return session()->flash("error","You Can not $action $roleTitle Role");
    }
    public function checkAvailability($id,$checkedId){
        if($id == $checkedId){
            return true;
        }
        return false;
    }

    public function toggleOpen(){
        $this->open = !$this->open;
    }
    public function toggleEditable($id){
        if( $this->checkAvailability($id,1)){
            return $this->errorMessage("Edit","Adminstrator");
        }elseif($this->checkAvailability($id,2)){
            return $this->errorMessage("Edit","Client");
        }
        try{
            $this->role = Role::findOrFail($id);
        }catch(Exception $e){
            return session()->flash("error","Role Not Found");
        }
        $this->editVal = $this->role->title;
        $this->editableId = $id;
        
    }
    public function cancelEditable(){
        $this->editableId = '';
    }
    public function store(){
        $data = $this->validate([
            'title'=> 'required|string|min:3|max:50|unique:roles,title',
        ]);
        Role::create($data);
        $this->open = false;
    }
    public function update(){
        if($this->editableId == 1){
            return session()->flash("error","You Can not edit Adminstrator Role");
        }
        try{

        $this->role = Role::findOrFail($this->editableId);
        }catch(Exception $e){
            return session()->flash('error','Role Not Found');
        }
        $data = $this->validate([
            'editVal'=> 'required|string|min:3|max:50|unique:roles,title',
        ]);
        $this->role->update([
            'title'=> $data['editVal'],
        ]);
        $this->editableId = '';
    }

    public function delete($id){
        try{
            $this->role = Role::findOrFail($id);
        }catch(Exception $e){
            return session()->flash("error","Role Not Found");
        }
        if( $this->checkAvailability($id,1)){
            return $this->errorMessage("Delete","Adminstrator");
        }elseif($this->checkAvailability($id,2)){
            return $this->errorMessage("Delete","Client");
        }
        $this->role->delete();

    }
    
    public function showPermisions($id)
    {
        // $roles = Role::with('permision')->get();
        $myRole = Role::find($id);
        // dd($role->load('permision'));
        $this->myPermissions = $myRole->permisions;
    }
    public function render()
    {
        $roles = Role::paginate(5);
        $permissions = Permision::all();
        $rolePermision = DB::table('role_permision')->get();
        // dd($rolePermision);
        
        return view('livewire.admin.permisions',compact('roles','permissions','rolePermision'));
    }
}
