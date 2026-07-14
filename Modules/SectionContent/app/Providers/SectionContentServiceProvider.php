<?php

namespace Modules\SectionContent\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SectionContentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Blade directive: parse *cetak tebal* menjadi gradient span
        Blade::directive('accentTitle', function ($expression) {
            return "<?php echo preg_replace('/\\*(.*?)\\*/', '<span class=\"text-transparent bg-clip-text bg-gradient-to-r from-orange-400 via-orange-500 to-amber-500\">$1</span>', $expression); ?>";
        });
    }
}