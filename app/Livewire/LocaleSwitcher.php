<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\App;

class LocaleSwitcher extends Component
{
    public string $currentLocale;
 
    public array $locales = [
        'en'    => 'English',
        'zh-CN' => '中文',
    ];
 
    public function mount(): void
    {
        $this->currentLocale = session('locale', config('app.locale'));
        // dd('LocaleSwitcher mounted with locale: ' . $this->currentLocale);
    }
 
    public function switchLocale(string $locale): void
    {
        if (!array_key_exists($locale, $this->locales)) {
            return;
        }
 
        // dd($locale);

        session()->put('locale', $locale);
        App::setLocale($locale);
 
        $this->currentLocale = $locale;
 
        // Full page reload so all translated strings re-render
        $this->redirect(request()->header('Referer') ?? '/', navigate: true);
    }

    public function render()
    {
        return view('livewire.locale-switcher');
    }
}
