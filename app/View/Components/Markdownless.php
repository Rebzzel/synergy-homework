<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Spatie\LaravelMarkdown\MarkdownRenderer;
use Soundasleep\Html2Text;

class Markdownless extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            return Html2Text::convert(
                app(MarkdownRenderer::class)->toHtml($data['slot'])
            );
        };
    }
}
