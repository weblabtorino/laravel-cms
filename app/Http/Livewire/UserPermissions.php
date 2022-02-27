<?php

namespace App\Http\Livewire;

use App\Models\UserPermission;
use Livewire\Component;
use Livewire\WithPagination;

class UserPermissions extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    /**
     * Custom varibili publbiche
     */

    public $role;
    public $routeName;

    /**
     * Assegna la validazione dei campi
     */
    public function rules()
    {
        return [
            'role' =>'required',
            'routeName' => 'required',
        ];
    }

    /**
     * carica il record da modificare
     * @return void
     */
    public function loadModel()
    {
        $data = UserPermission::find($this->modelId);
        $this->role = $data->role;
        $this->routeName = $data->route_name;
    }

    /**
     * Modello dei dati form
     * @return array
     */
    public function modelData()
    {
        return [
            'role' =>$this->role,
            'route_name' =>$this->routeName,
        ];
    }

    /**
     * Salva form
     * @return void
     */
    public function create()
    {
        $this->validate();
        UserPermission::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();

    }

    /**
     * Modifica il record
     * @return void
     */
    public function update()
    {
        $this->validate();
        UserPermission::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    /**
     * Cancella il record
     * @return void
     */
    public function delete()
    {
        UserPermission::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    /**
     * Apre modal conferma cancellazione record
     * @param $id
     * @return void
     */
    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    /**
     * Fa vedere il modal create
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    /**
     * Fa vedere modal per modifica
     * @param $id
     * @return void
     */
    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
        $this->modelId = $id;
        $this->loadModel();
    }

    /**
     * Fa vedere la pagina
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.user-permissions', [
            'data' => $this->read(),
        ]);
    }

    /**
     * Read function
     * @return mixed
     */
    public function read()
    {
        return UserPermission::paginate(5);

    }
}
