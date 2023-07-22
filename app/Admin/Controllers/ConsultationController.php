<?php

namespace App\Admin\Controllers;

use App\Models\Consultation;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ConsultationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Consultation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Consultation());

        $grid->column('id', __('Id'));
        $grid->column('message', __('Message'));
        $grid->column('date', __('Date'));
        $grid->column('user_id', __('User'))->display(function ($user_id) {
            return User::find($user_id)->name;
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
        $show = new Show(Consultation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('message', __('Message'));
        $show->field('date', __('Date'));
        $show->field('user_id', __('User Name'))->display(function ($user_id) {
            return User::find($user_id)->name;
        });
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
        $form = new Form(new Consultation());

        $form->textarea('message', __('Message'));
        $form->datetime('date', __('Date'))->default(date('Y-m-d H:i:s'));
        $form->number('user_id', __('User id'));

        return $form;
    }
}
