<?php

namespace App\Admin\Controllers;

use App\Models\Companyinfo;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Companyinfo';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Companyinfo());

        $grid->column('id', __('Id'));
        $grid->column('name', 'Name');
        $grid->column('postal_code', __('Postal code'));
        $grid->column('address', __('Address'));
        $grid->column('phone', __('Phone'));
        $grid->column('date_of_incorporation', __('Date of incorporation'));
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
        $show = new Show(Companyinfo::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', 'Name');
        $show->field('postal_code', __('Postal code'));
        $show->field('address', __('Address'));
        $show->field('phone', __('Phone'));
        $show->field('date_of_incorporation', __('Date of incorporation'));
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
        $form = new Form(new Companyinfo());

        $form->text('name', 'Name');
        $form->text('postal_code', __('Postal code'));
        $form->textarea('address', __('Address'));
        $form->mobile('phone', __('Phone'));
        $form->date('date_of_incorporation', __('Date of incorporation'))->default(date('Y-m-d'));

        return $form;
    }
}
