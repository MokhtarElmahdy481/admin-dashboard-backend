<?php

namespace App\Livewire;

use App\Models\Permision;
use App\Models\Role as ModelsRole;
use App\Models\RolePermision;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layout.app')]
class Role extends Component
{
    use WithPagination;

    public $open = false;
    public $editableId='';
    public $editVal;
    public $title;
    public $role;
    public $firstRole='';

    public function mount(){
        $this->createRole(1,'Adminstrator');
        $this->createRole(2,'client');
        $this->createPermission(1,'Add');
        $this->createPermission(2,'Show');
        $this->createPermission(3,'List');
        $this->createPermission(4,'Edit');
        $this->createPermission(5,'Delete');
        
    }
    public function createRole($id,$title){
        try{
            $this->firstRole = ModelsRole::findOrFail($id);
        }catch(Exception $e){
            $data = [
                'id' => $id,
                'title'=> $title,
            ];
            ModelsRole::create($data);
        }
    }
    public function createPermission($id,$title){
        try{
            $this->firstRole = Permision::findOrFail($id);
        }catch(Exception $e){
            $data = [
                'id' => $id,
                'title'=> $title,
            ];
            Permision::create($data);
        }
    }
    public function addPermissionToUser($id,$permision_id,$role_id){
        try{

            DB::insert('insert into role_permision (id,permision_id, role_id) values (?, ?, ?)', [$id, $permision_id, $role_id]);
        }catch(Exception $e){

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
            $this->role = ModelsRole::findOrFail($id);
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
        ModelsRole::create($data);
        $this->open = false;
    }
    public function update(){
        if($this->editableId == 1){
            return session()->flash("error","You Can not edit Adminstrator Role");
        }
        try{

        $this->role = ModelsRole::findOrFail($this->editableId);
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
            $this->role = ModelsRole::findOrFail($id);
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
        // $roles = ModelsRole::with('permision')->get();
        $role = ModelsRole::find($id);
        // dd($role->load('permision'));
        return $role->load('permision');
    }
    public function render()
    {
        $roles = ModelsRole::paginate(5);
        // dd($roles);
        return view('livewire.role',compact("roles"));
    }
}
