<?php


namespace admin\app\controllers;


use admin\app\Factory;

class Site extends ActionController
{
    private $view_name = null;
    private $model_name = null;

    public function __invoke()
    {
        Factory::getController("Render")
            ->render("vhome");
    }

    public function page($switch/*, $id = null*/)
    {
        if ($switch == "list")
        {
            Factory::getController("Render")
                ->render(
                    "page-list",
                    ['pages' => Factory::createModelGroup(
                        "Page", "ru",
                        "id, name, visible_at"
                    )]
                );
        }
        elseif ($switch == "edit")
        {
            $this->view_name = "edit-page";
            $this->model_name = "Page";
        }
    }

    public function menu($switch/*, $id = null*/)
    {
        if ($switch == "list")
        {
            Factory::getController("Render")
                ->render(
                    "menu-list",
                    ['menus' => Factory::createModelGroup("Menu", "ru")]
                );
        }
        elseif ($switch == "edit")
        {
            $this->view_name = "edit-menu";
            $this->model_name = "Menu";
        }
    }

    public function reviews($switch/*, $id = null*/)
    {

    }

    public function id($id)
    {
        //return (string) $id;
        if ($this->view_name !== null)
        {
            Factory::getController("Render")
                ->render(
                    $this->view_name,
                    ['model' => Factory::createModel($this->model_name, null, true, $id)]
                );
        }
    }
}