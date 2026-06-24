<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class ProjectController extends Controller
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
            'projects' => $this->projects(),
        ]);
    }

    public function actionView($id = 1)
    {
        $projects = $this->projects();
        $project = isset($projects[$id - 1]) ? $projects[$id - 1] : $projects[0];

        return $this->render('view', [
            'project' => $project,
        ]);
    }

    public function actionBoard($id = 1)
    {
        return $this->render('board', [
            'columns' => [
                [
                    'title' => 'To do',
                    'tone' => 'todo',
                    'tasks' => [
                        ['id' => 'TASK-004', 'title' => 'Calendar integration', 'description' => 'Connect project deadlines to the shared calendar.', 'priority' => 'Medium', 'owner' => 'Alice', 'date' => '24 Aug'],
                        ['id' => 'TASK-009', 'title' => 'Mobile navigation', 'description' => 'Review sidebar flow on smaller screens.', 'priority' => 'Low', 'owner' => 'David', 'date' => '25 Aug'],
                    ],
                ],
                [
                    'title' => 'In progress',
                    'tone' => 'progress',
                    'tasks' => [
                        ['id' => 'TASK-005', 'title' => 'Kanban board UI', 'description' => 'Build drag-and-drop task columns.', 'priority' => 'Medium', 'owner' => 'Alice', 'date' => '22 Aug'],
                    ],
                ],
                [
                    'title' => 'In review',
                    'tone' => 'review',
                    'tasks' => [
                        ['id' => 'TASK-007', 'title' => 'Project activity feed', 'description' => 'Confirm timeline grouping and filters.', 'priority' => 'High', 'owner' => 'Mali', 'date' => '21 Aug'],
                    ],
                ],
                [
                    'title' => 'Done',
                    'tone' => 'done',
                    'tasks' => [
                        ['id' => 'TASK-001', 'title' => 'Dashboard UI design', 'description' => 'Design the main project overview.', 'priority' => 'High', 'owner' => 'John', 'date' => '20 Aug'],
                        ['id' => 'TASK-002', 'title' => 'Database schema', 'description' => 'Create the initial project tables.', 'priority' => 'Medium', 'owner' => 'John', 'date' => '21 Aug'],
                    ],
                ],
            ],
        ]);
    }

    private function projects()
    {
        return [
            ['id' => 1, 'name' => 'PM Tool', 'description' => 'Project management system', 'members' => 6, 'tasks' => 32, 'date' => '10 Aug 2026', 'progress' => 75, 'status' => 'Active'],
            ['id' => 2, 'name' => 'E-Commerce', 'description' => 'Online storefront redesign', 'members' => 8, 'tasks' => 46, 'date' => '18 Aug 2026', 'progress' => 62, 'status' => 'Active'],
            ['id' => 3, 'name' => 'Mobile App', 'description' => 'Customer companion application', 'members' => 5, 'tasks' => 28, 'date' => '22 Aug 2026', 'progress' => 48, 'status' => 'Planning'],
            ['id' => 4, 'name' => 'CRM Workspace', 'description' => 'Sales and customer operations', 'members' => 7, 'tasks' => 39, 'date' => '01 Sep 2026', 'progress' => 84, 'status' => 'Active'],
        ];
    }
}
