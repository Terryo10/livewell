<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrdersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->column('id', __('Id'));
        $grid->column('paymentStatus', __('PaymentStatus'));
        $grid->column('transaction_ref', __('Transaction ref'));
        $grid->column('delivery_id', __('Delivery id'));
        $grid->column('status', __('Status'));
        $grid->column('user_id', __('User Name'))->display(function () {
            return $this->user->name;
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
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('paymentStatus', __('PaymentStatus'));
        $show->field('transaction_ref', __('Transaction ref'));
        $show->field('delivery_id', __('Delivery id'));
        $show->field('status', __('Status'));
        $show->field('user_id', __('User Name'))->as(function ($user_id) {
            return $this->user->name;
        });
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->delivery('Delivery Details',function ($delivery){
            $delivery->address();
            $delivery->phone();
            $delivery->city();
            $delivery->state();
            $delivery->country();


        });
        $show->order_items('Order Items',function ($order_items){
            $order_items->product()->name();
            $order_items->product()->image()->image();
            $order_items->quantity();
            $order_items->price();
//            $order_items->total();

        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order());

        $form->text('paymentStatus', __('PaymentStatus'))->default('initiated');
        $form->text('transaction_ref', __('Transaction ref'));
        $form->number('delivery_id', __('Delivery id'));
        $form->text('status', __('Status'));
        $form->number('user_id', __('User id'));

        return $form;
    }
}
