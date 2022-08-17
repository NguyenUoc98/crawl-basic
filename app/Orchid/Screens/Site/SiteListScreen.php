<?php

namespace App\Orchid\Screens\Site;

use App\Models\Site;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class SiteListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'sites' => Site::query()
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'List Site';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.systems.sites.create'),
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
            Layout::table('sites', [
                TD::make('id', 'ID')->alignCenter(),
                TD::make('name', 'Name'),
                TD::make('url', 'Url'),
                TD::make('created_at', 'Created_at')
                    ->render(function ($site) {
                        return $site->created_at->toDateTimeString();
                    }),
                TD::make('updated_at', 'Updated_at')
                    ->render(function ($site) {
                        return $site->updated_at->toDateTimeString();
                    }),
            ])
        ];
    }
}
