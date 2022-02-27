<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\filesystem\Filesystem;
use Illuminate\Support\Str;

class LivewireCustomCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:livewire:crud
    {nameOftheClass? : The name of the class.},
    {namaOftheModelClass? : The name of the model class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea il tuo command Custom CRUD.';

    /**
     * Our custom class propieties here!
     */
    protected $nameOftheClass;
    protected $namaOftheModelClass;
    protected $file;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->file = new Filesystem();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Gathers all parameters
        $this->gatherParameters();
        // Generates the Livewire class file
        $this->generateLivewireCrudClassFile();
        // Generated the Livewire View file
        $this->generateLivewireCrudViewFile();
    }

    /**
     * gatherParameters funzione
     * @return void
     */
    protected function gatherParameters()
    {
        $this->nameOftheClass = $this->argument('nameOftheClass');
        $this->nameOftheModelClass = $this->argument('namaOftheModelClass');

        if (!$this->nameOftheClass) {
            $this->nameOftheClass = $this->ask('Enter class name');

        }
        if (!$this->nameOftheModelClass) {
            $this->nameOftheModelClass = $this->ask('Enter model name');
        }

        // conversione delle stringa
        $this->nameOftheClass = Str::studly($this->nameOftheClass);
        $this->nameOftheModelClass = Str::studly($this->nameOftheModelClass);
    }

    /**
     * Genera la classe LiveWire che comanda la View
     * @return false|void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function generateLivewireCrudClassFile()
    {
        $fileOrigin = base_path('/stubs/Custom.livewire.crud.stub');
        $fileDestination = base_path('/app/Http/LiveWire/' . $this->nameOftheClass . '.php');

        if($this->file->exists($fileDestination))
        {
            $this->info('Questa classe già esiste: '. $this->nameOftheClass.'.php');
            $this->info('Creazione di questo file annullata...');
            return false;
        }

        $fileOriginaString = $this->file->get($fileOrigin);

        $replaceFileOriginalString = Str::replaceArray('{{}}',
            [
                $this->nameOftheModelClass,
                $this->nameOftheClass,
                $this->nameOftheModelClass,
                $this->nameOftheModelClass,
                $this->nameOftheModelClass,
                $this->nameOftheModelClass,
                $this->nameOftheModelClass,
                Str::kebab($this->nameOftheClass),
            ],
            $fileOriginaString
        );

        $this->file->put($fileDestination, $replaceFileOriginalString);
        $this->info('Livewire class file creato: ' . $fileDestination);


    }

    /**
     * Genera la View correlata alla classe LiveWire
     * @return false|void
     */
    protected function generateLivewireCrudViewFile()
    {
        $fileOrigin = base_path('/stubs/Custom.livewire.crud.view.stub');
        $fileDestination = base_path('/resources/views/livewire/' . Str::kebab($this->nameOftheClass) . '.blade.php');

        if($this->file->exists($fileDestination))
        {
            $this->info('Questa View già esiste: '. Str::kebab($this->nameOftheClass) . '.blade.php');
            $this->info('Creazione di questo file annullata...');
            return false;
        }

        $this->file->copy($fileOrigin, $fileDestination);
        $this->info('Livewire view file creato: ' . $fileDestination);
    }

}
