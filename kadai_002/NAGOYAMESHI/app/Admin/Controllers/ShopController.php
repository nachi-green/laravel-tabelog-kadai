<?php

namespace App\Admin\Controllers;

use App\Models\Shop;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Shop';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Shop());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', 'Name')->sortable();
        $grid->column('category.name', __('Category Name'))->sortable();
        $grid->column('image', __('Image'))->image();
        $grid->column('description', __('Description'));
        $grid->column('lower_price', __('Lower price'))->sortable();
        $grid->column('upper_price', __('Upper price'))->sortable();
        $grid->column('start_time', __('Start time'));
        $grid->column('close_time', __('Close time'));
        $grid->column('regular_holiday', __('Regular holiday'));
        $grid->column('postal_code', __('Postal code'));
        $grid->column('address', __('Address'));
        $grid->column('phone', __('Phone'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('name', '店舗名');
            $filter->in('category_id', 'カテゴリー名')->multipleSelect(Category::all()->pluck('name', 'id'));
        });

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
        $show = new Show(Shop::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name','Name');
        $show->field('category.name', __('Category Name'));
        $show->field('image', __('Image'))->image();
        $show->field('description', __('Description'));
        $show->field('lower_price', __('Lower price'));
        $show->field('upper_price', __('Upper price'));
        $show->field('start_time', __('Start time'));
        $show->field('close_time', __('Close time'));
        $show->field('regular_holiday', __('Regular holiday'));
        $show->field('postal_code', __('Postal code'));
        $show->field('address', __('Address'));
        $show->field('phone', __('Phone'));
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
        $form = new Form(new Shop());

        $form->text('name','Name');
        $form->number('category_id', __('Category Name'))->options(Category::all()->pluck('name', 'id'));
        $form->image('image', __('Image'));
        $form->textarea('description', __('Description'));
        $form->number('lower_price', __('Lower price'));
        $form->number('upper_price', __('Upper price'));
        $form->time('start_time', __('Start time'))->default(date('H:i:s'));
        $form->time('close_time', __('Close time'))->default(date('H:i:s'));
        $form->textarea('regular_holiday', __('Regular holiday'));
        $form->text('postal_code', __('Postal code'));
        $form->textarea('address', __('Address'));
        $form->mobile('phone', __('Phone'));

        return $form;
    }
}
