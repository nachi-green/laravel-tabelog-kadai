<?php

namespace App\Admin\Controllers;

use App\Models\Book;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BookController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Book';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Book());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('shop_id', __('Shop id'));
        $grid->column('book_date', __('Book date'));
        $grid->column('book_time', __('Book time'));
        $grid->column('book_number', __('Book number'));
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
        $show = new Show(Book::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('shop_id', __('Shop id'));
        $show->field('book_date', __('Book date'));
        $show->field('book_time', __('Book time'));
        $show->field('book_number', __('Book number'));
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
        $form = new Form(new Book());

        $form->number('user_id', __('User id'));
        $form->number('shop_id', __('Shop id'));
        $form->date('book_date', __('Book date'))->default(date('Y-m-d'));
        $form->time('book_time', __('Book time'))->default(date('H:i:s'));
        $form->number('book_number', __('Book number'));

        return $form;
    }
}
