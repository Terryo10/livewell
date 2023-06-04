<?php

namespace App\Admin\Controllers;

use App\Models\ProductImages;
use App\Models\Products;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductImagesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ProductImages';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductImages());

        $grid->column('id', __('Id'));
        
        $grid->column('product_id', __('Product id'))->display(function ($value) {
            $product = Products::find($value);
            return $product->name;
        });
        $grid->column('image', __('Image'))->image();
        $grid->column('is_main', __('Is main'))->display(function ($value) {
            return $value ? 'Yes' : 'No';
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ProductImages::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_id', __('Product id'));
        $show->field('image', __('Image'));
        $show->field('is_main', __('Is main'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProductImages());
        $form->select('product_id', __('Product Category '))->options(Products::all()->pluck('name', 'id'))->required();
        $form->image('image', __('Image'));
        $form->switch('is_main', __('Is main'));

        return $form;
    }
}
