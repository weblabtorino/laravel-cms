<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class Frontpage extends Component
{

    public $title;
    public $content;
    public $slider = false;

    public function mount($urlslug = null)
    {
        $this->retrieveContent($urlslug);
    }

    public function retrieveContent($urlslug)
    {
        if (empty($urlslug)) {
            $data = Page::where('is_default_home', true)->first();
            $slider = true;
        } else {
            $data = Page::where('slug', $urlslug)->first();
            if ($data->slug === 'home'){
                $slider = true;
            } else {
                $slider = false;
            }
        }

        if (!$data) {
            $data = Page::where('is_default_not_found', true)->first();
        }

        $this->title = $data->title;
        $this->content = $data->content;
        $this->slider = $slider;


    }

    /**
     * Cerca del DB il menu sidebarNav
     * @return mixed
     */
    private function sideBarLinks()
    {
        return DB::table('navigation_menus')
            ->where('type', '=', 'SidebarNav')
            ->orderBy('sequence', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();

    }

    /**
     * Cerca del DB il menu sidebarNav
     * @return mixed
     */
    private function topNavLinks()
    {
        return DB::table('navigation_menus')
            ->where('type', '=', 'TopNav')
            ->orderBy('sequence', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.frontpage', [
            'sideBarLinks' => $this->sideBarLinks(),
            'topNavLinks' => $this->topNavLinks(),
        ])->layout('layouts.frontend',['sideBarLinks' => $this->sideBarLinks()]);
    }
}
