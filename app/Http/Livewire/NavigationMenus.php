<?php

namespace App\Http\Livewire;

use App\Models\NavigationMenu;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class NavigationMenus extends Component
{

    use WithPagination;
    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;
    public $label;
    public $slug;
    public $sequence = 1;
    public $type = 'SidebarNav';

    public function rules()
    {
        return [

            'label' => 'required',
            'slug' => 'required',
            'sequence' => 'required',
            'type' => 'required',

        ];
    }

    /**
     * Salva form
     * @return void
     */
    public function create()
    {
        $this->validate();
        NavigationMenu::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();

    }

    /**
     * Read function
     * @return mixed
     */
    public function read()
    {
        return NavigationMenu::paginate(5);

    }

    /**
     * Modifica il record
     * @return void
     */
    public function update()
    {
        $this->validate();
        NavigationMenu::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible =false;
    }

    /**
     * Cancella il record
     * @return void
     */
    public function delete()
    {
        NavigationMenu::destroy($this->modelId);
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
       $data = NavigationMenu::find($this->modelId);
       $this->label = $data->label;
       $this->slug = $data->slug;
       $this->type = $data->type;
       $this->sequence = $data->sequence;
    }

    /**
     * Modello dei dati form
     * @return array
     */
    public function modelData()
    {
      return [
          'label' => $this->label,
          'slug' => $this->slug,
          'sequence' =>$this->sequence,
          'type' => $this->type
      ];
    }

    /**
     * Fa vedere la pagina
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.navigation-menus',[
            'data' => $this->read(),
        ]);
    }
}
