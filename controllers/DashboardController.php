<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class DashboardController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'stats' => [
                ['label' => 'Total projects', 'value' => 24, 'icon' => 'folder-kanban', 'tone' => 'blue'],
                ['label' => 'Tasks in progress', 'value' => 18, 'icon' => 'pickaxe', 'tone' => 'violet'],
                ['label' => 'Team members', 'value' => 12, 'icon' => 'users', 'tone' => 'green'],
                ['label' => 'Completed tasks', 'value' => 64, 'icon' => 'file-check-2', 'tone' => 'coral'],
            ],
        ]);
    }
}
