<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Scaffold;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ScaffoldController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Scaffold(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('aid');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Scaffold(), function (Show $show) {
            $show->field('id');
            $show->field('aid');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Scaffold(), function (Form $form) {
            $form->display('id');
            $form->text('aid');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
