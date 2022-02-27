<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;

    public $name;
    public $role;

        public function rules()
        {
            return [
                'name' =>'required',
                'role' =>'required',
            ];
        }

      /**
           * Salva form
           * @return void
           */
          public function create()
          {
              $this->validate();
              User::create($this->modelData());
              $this->modalFormVisible = false;
              $this->reset();

          }

          /**
           * Read function
           * @return mixed
           */
          public function read()
          {
              return User::paginate(5);

          }

          /**
           * Modifica il record
           * @return void
           */
          public function update()
          {
              $this->validate();
              User::find($this->modelId)->update($this->modelData());
              $this->modalFormVisible =false;
          }

          /**
           * Cancella il record
           * @return void
           */
          public function delete()
          {
              User::destroy($this->modelId);
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
          public function createShowModal(){
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
           * carica il record da modificare
           * @return void
           */
          public function loadModel()
          {
             $data = User::find($this->modelId);
             $this->name = $data->name;
             $this->role = $data->role;
          }

          /**
           * Modello dei dati form
           * @return array
           */
          public function modelData()
          {
            return [
                'name' => $this->name,
                'role' => $this->role,
            ];
          }

          /**
           * Fa vedere la pagina
           * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
           */
          public function render()
          {
              return view('livewire.users',[
                  'data' => $this->read(),
              ]);
          }
}
