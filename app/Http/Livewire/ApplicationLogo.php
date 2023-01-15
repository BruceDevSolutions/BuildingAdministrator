<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class ApplicationLogo extends Component
{
    public function render()
    {
        $logo_path = Setting::where('id', 1)->select('application_logo_path')->first()->aplication_logo_path ?? asset('images/default_logo.png');

        return view('livewire.application-logo', compact('logo_path'));
    }
}
