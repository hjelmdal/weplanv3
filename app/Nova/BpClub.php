<?php

namespace App\Nova;

use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use PharIo\Manifest\Email;

class BpClub extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\BadmintonPeople\BpClub';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','name'
    ];

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'BadmintonPeople';

    public static function label() {
        return 'BP Clubs';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Number::make('club_id')->sortable()->withMeta(['extraAttributes' => [
                'readonly' => true
            ]]),
            Text::make('name')->sortable()->withMeta(['extraAttributes' => [
                'readonly' => true
            ]]),
            Text::make('Address')->withMeta(['extraAttributes' => [
                'readonly' => true
            ]]),
            Number::make('Postal_code')->withMeta(['extraAttributes' => [
                'readonly' => true
            ]]),
            Text::make('City')->withMeta(['extraAttributes' => [
                'readonly' => true
            ]]),
            Text::make('Contact Email')->withMeta(['extraAttributes' => [
                'readonly' => true
            ]])->withMeta(['extraAttributes' => [
                'readonly' => true
            ]]),
            Text::make('Association')->withMeta(['extraAttributes' => [
                'readonly' => true
            ]]),
            HasMany::make('BpPlayers')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
