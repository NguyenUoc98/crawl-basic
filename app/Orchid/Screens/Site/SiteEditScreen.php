<?php

namespace App\Orchid\Screens\Site;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class SiteEditScreen extends Screen
{
    public $site;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Site $site): iterable
    {
        return [
            'site' => $site
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->site->exists ? 'Edit Site' : 'Create Site';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('site.name')
                    ->type('text')
                    ->title('Name'),
                Input::make('site.url')
                    ->type('text')
                    ->title('Url'),
            ]),
        ];
    }

    public function save(Site $site, Request $request)
    {
        $request->validate([
            'site.url'  => [
                'required',
                Rule::unique(Site::class, 'url')->ignore($site),
            ],
            'site.name' => ['required'],
        ]);

        $site
            ->fill($request->collect('site')->toArray())
            ->save();

        Toast::success(__('Site was saved.'));

        return redirect()->route('platform.systems.sites');
    }
}
