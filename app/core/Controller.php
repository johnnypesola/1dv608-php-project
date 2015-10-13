<?php
/**
 * Created by jopes
 * Date: 2015-10-13
 * Time: 13:25
 */

namespace controller;

class Controller
{
    public function Index()
    {

    }

    protected function CreateBLLModel($modelName)
    {
        require_once '../app/model/' . $modelName . '.php';
        return new $modelName;
    }

    protected function CreateDALModel($modelName)
    {
        require_once '../app/model/DAL/' . $modelName . '.php';
        return new $modelName;
    }

    protected function CreateService($serviceName)
    {
        require_once '../app/model/' . $serviceName . '.php';
        return new $serviceName;
    }

    protected function CreateView($viewName, $data = [])
    {
        require_once '../app/view/' . $viewName . '.php';
        return new $viewName;
    }
}