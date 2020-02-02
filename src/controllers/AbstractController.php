<?php

namespace omny\yii2\ticket\component\controllers;

use yii\web\Controller;

/**
 * Class AbstractController
 * @package omny\yii2\ticket\component\controllers
 */
class AbstractController extends Controller
{
    /** @var null|string */
    protected $viewPath;

    /**
     * @return mixed
     */
    public function getViewPath()
    {
        $viewPath = parent::getViewpath();

        if ($this->viewPath !== null) {
            return $this->viewPath;
        }

        return $viewPath;
    }
}
