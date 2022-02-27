<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

/**
 *
 */
class Pages extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;
    public $modelId;
    public $slug;
    public $title;
    public $content;
    public $isSetToDefaultHomePage;
    public $isSetToDefaulNotFoundPage;


    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages', 'slug')->ignore($this->modelId)],
            'content' => 'required'

        ];
    }

    /**
     * Reset paginazione
     * @return void
     */
    public function mount()
    {
        $this->resetPage();
    }

    /**
     * Crea automanticamente lo slug della pagina
     * @param $value
     * @return void
     */
    public function updatedTitle($value)
    {
        $this->generateSlug($value);
    }

    public function updatedIsSetToDefaultHomePage()
    {

        $this->isSetToDefaulNotFoundPage = null;
    }

    public function updatedIsSetToDefaulNotFoundPage()
    {
        $this->isSetToDefaultHomePage = null;
    }

    /**
     * Salva i dati del form
     * @return void
     */
    public function create()
    {
        $this->validate();
        $this->unassignDefaultHomePage();
        $this->unassignDefaultnotfoundPage();
        Page::create($this->modelData());
        $this->modalFormVisible = false;
        $this->resetVars();
    }

    public function read()
    {
        return Page::paginate(5);
    }

    /**
     * Fa upload della pagina
     * @return void
     */
    public function update()
    {
        $this->validate();
        $this->unassignDefaultHomePage();
        $this->unassignDefaultnotfoundPage();
        Page::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;

    }

    /**
     * Cancella la pagina
     * @return void
     */
    public function delete()
    {
        Page::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    /**
     * Mostra il form del modal
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modalFormVisible = true;
    }

    /**
     * Modifica dati pagina
     * @param $id
     * @return void
     */
    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }

    /**
     * Apre il modal per la conferma cancellazione pagina
     * @param $id
     * @return void
     */
    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;

    }

    /**
     * Trova i dati della pagina da mettere nel modal
     * @return void
     */
    public function loadModel()
    {
        $data = Page::find($this->modelId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
        $this->isSetToDefaultHomePage = !$data->is_default_home ? null : true;
        $this->updatedIsSetToDefaulNotFoundPage = !$data->is_default_not_found ? null : true;

    }

    /**
     * Mappa il modello dei dati Pagina
     * @return array
     */
    public function modelData()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'is_default_home' => $this->isSetToDefaultHomePage,
            'is_default_not_found' => $this->isSetToDefaulNotFoundPage
        ];

    }

    /**
     * Reset data form
     * @return void
     */
    public function resetVars()
    {
        $this->title = null;
        $this->slug = null;
        $this->content = null;
        $this->modelId = null;
        $this->isSetToDefaulNotFoundPage = null;
        $this->isSetToDefaultHomePage = null;
    }

    /**
     * Genera lo slug della pagina
     * @param $value
     * @return void
     */
    private function generateSlug($value)
    {

        $process1 = str_replace(' ', '-', $value);
        $process2 = strtolower($process1);
        $this->slug = $process2;
    }

    /**
     * Disassegna il default home page se già assegnato
     * @return void
     */
    private function unassignDefaultHomePage(){
        if($this->isSetToDefaultHomePage!= null){
            Page::where('is_default_home',true)->update([
               'is_default_home' => false,
            ]);
        }
    }

    /**
     * Disassegna il default page not found se già assegnato
     * @return void
     */
    private function unassignDefaultnotfoundPage()
    {
        if ($this->isSetToDefaulNotFoundPage != null) {
            Page::where('is_default_not_found', true)->update([
                'is_default_not_found' => false,
            ]);
        }
    }


    /**
     * Renderizza la pagina
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->read()
        ]);
    }
}
