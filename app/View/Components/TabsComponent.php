<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TabsComponent extends Component
{
    public $activeTab;

    public function mount($activeTab = 'suggestions')
    {
        $this->activeTab = $activeTab;
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('components.network_connections');
    }
}
