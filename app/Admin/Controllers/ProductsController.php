<?php

namespace App\Admin\Controllers;

use App\Models\Products;
use App\Models\SubCategories;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Products';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Products());

        $grid->column('id', __('Id'));
        $grid->column('sub_category_id', __('Sub category id'));
        $grid->column('name', __('Name'));
        $grid->column('image', __('Image'))->image();
        $grid->column('description')->display(function ($value) {
            return substr(strip_tags($value), 0, 100);
        });
        $grid->column('price', __('Price'));
        $grid->column('stock', __('Stock'));
        $grid->column('discount', __('Discount'));
        $grid->column('discount_price', __('Discount price'));
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
        $show = new Show(Products::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sub_category_id', __('Sub category id'));
        $show->field('name', __('Name'));
        $show->field('image', __('Image'));
        $show->field('description', __('Description'));
        $show->field('price', __('Price'));
        $show->field('stock', __('Stock'));
        $show->field('discount', __('Discount'));
        $show->field('discount_price', __('Discount price'));
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
        $form = new Form(new Products());
        $form->text('name', __('Name'));
        $form->select('sub_category_id', __('Select Sub Category '))->options(SubCategories::all()->pluck('name', 'id'))->required();
        $form->image('image', __('Image'))->required();
        $form->textarea('description', __('Description'));
        $form->number('price', __('Price'))->required();
        $form->number('stock', __('Stock'));
        $form->number('discount', __('Discount'));
        $form->number('discount_price', __('Discount price'));

        return $form;
    }
}
