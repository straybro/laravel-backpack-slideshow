<?php

namespace Novius\Backpack\Slideshow\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Novius\Backpack\Slideshow\Http\Requests\Admin\SlideshowRequest as StoreRequest;
use Novius\Backpack\Slideshow\Http\Requests\Admin\SlideshowRequest as UpdateRequest;
use Novius\Backpack\Slideshow\Models\Slideshow;

class SlideshowCrudController extends CrudController
{
    public function setup()
    {
        $this->crud->setModel(Slideshow::class);
        $this->crud->setRoute(config('backpack.base.route_prefix').'/slideshow');
        $this->crud->setEntityNameStrings(trans('backpack_slideshow::slideshow.slideshow'), trans('backpack_slideshow::slideshow.slideshows'));
        $this->crud->addButtonFromView('line', 'show_slides', 'slideshow-show-slides', 'beginning');

        $this->crud->addfield([
            'name' => 'title',
            'label' => trans('backpack_slideshow::slideshow.title'),
            'box' => trans('backpack_slideshow::slideshow.details'),
        ]);

        $formats = collect(config('backpack.slideshow.formats', []))->map(function ($format) {
            return trans('backpack_slideshow::slideshow.format.'.array_get($format, 'name'));
        })->toArray();

        $this->crud->addfield([
            'name' => 'format',
            'label' => trans('backpack_slideshow::slideshow.format.label'),
            'type' => 'select_from_array',
            'options' => $formats,
            'allows_null' => false,
            'box' => trans('backpack_slideshow::slideshow.options'),
        ]);

        $this->crud->setBoxOptions(trans('backpack_slideshow::slideshow.options'), [
            'side' => true,
            'class' => 'box-info',
        ]);

        $this->crud->addColumn([
            'name' => 'title',
            'label' => trans('backpack_slideshow::slideshow.title'),
        ]);
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        return parent::storeCrud($request);
    }

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        return parent::updateCrud($request);
    }
}
