<?php

namespace App\Admin\Controllers;

use App\Firm;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class FirmController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Firm);

        $grid->id('Id');
        $grid->name('Name');
        $grid->legal_per('Legal per');
        $grid->taxno('Taxno');
        $grid->publicno('Publicno');
        $grid->license('License');
        $grid->appID('AppID');
        $grid->key('Key');
        $grid->status('Status');

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
        $show = new Show(Firm::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->legal_per('Legal per');
        $show->taxno('Taxno');
        $show->publicno('Publicno');
        $show->license('License');
        $show->appID('AppID');
        $show->key('Key');
        $show->status('Status');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Firm);

        $form->text('name', 'Name');
        $form->text('legal_per', 'Legal per');
        $form->text('taxno', 'Taxno');
        $form->text('publicno', 'Publicno');
        $form->text('license', 'License');
        $form->text('appID', 'AppID');
        $form->text('key', 'Key');
        $form->switch('status', 'Status')->default(2);

        return $form;
    }
}
