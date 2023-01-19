<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class ApplicationLogo extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        $logo_path = !empty(Setting::where('id', 1)->select('application_logo_path')->first()->application_logo_path) ? Storage::url(Setting::where('id', 1)->select('application_logo_path')->first()->application_logo_path) : asset('images/default_logo.png');
        return view('livewire.application-logo', compact('logo_path'));
    }
}
