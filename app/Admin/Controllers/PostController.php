<?php

namespace App\Admin\Controllers;

use App\Models\BlogCategories;
use App\Models\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());
        $grid->filter(function($filter){
            // Remove the default id filter
            $filter->disableIdFilter();
            // Add a column filter
            $filter->like('title', 'title');


        });

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('blog_category_id', __('Blog category'))->display(function ($value) {
            $category = BlogCategories::find($value);
            return $category->name;
        });
        $grid->column('image_path', __('Image'))->image();
        $grid->column('content', __('Content'))->display(function ($value) {
            return substr(strip_tags($value), 0, 100);
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
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('blog_category_id', __('Blog category'));
        $show->field('content', __('Content'));
        $show->field('image_path', __('Image'))->image();
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->comments('Comments',function ($comments){
           $comments->user()->name();
              $comments->content();
                $comments->created_at();
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
        $form = new Form(new Post());

        $form->text('title', __('Title'))->required();
        $form->image('image_path', __('Image'))->required();
        $form->select('blog_category_id', __('Blog Category'))->options(BlogCategories::all()->pluck('name', 'id'))->required();
        $form->ckeditor('content', __('Content'))->required();

        return $form;
    }
}
