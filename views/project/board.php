<?php

/** @var yii\web\View $this */
/** @var array $columns */

use yii\helpers\Html;

$this->title = 'Project board';
?>
<div class="page-container board-page">
    <div class="project-context-bar">
        <?= $this->render('_tabs', ['active' => 'board']) ?>
        <div class="toolbar-search compact-search">
            <i data-lucide="search"></i>
            <input type="search" class="form-control" placeholder="Search tasks" aria-label="Search tasks">
        </div>
    </div>

    <div class="board-heading">
        <div>
            <p class="page-kicker">PM Tool</p>
            <h1>Project board</h1>
            <p class="page-subtitle">Follow work as it moves from idea to complete.</p>
        </div>
        <div class="board-actions">
            <button class="btn btn-outline-dark" type="button"><i data-lucide="sliders-horizontal"></i> Filter</button>
            <button class="btn btn-dark" type="button"><i data-lucide="plus"></i> Add task</button>
        </div>
    </div>

    <section class="kanban-board" aria-label="Kanban task board">
        <?php foreach ($columns as $column): ?>
            <article class="kanban-column kanban-<?= Html::encode($column['tone']) ?>">
                <header>
                    <span class="column-title"><i></i><?= Html::encode($column['title']) ?></span>
                    <span class="column-count"><?= count($column['tasks']) ?></span>
                    <button class="icon-button" type="button" title="Column options"><i data-lucide="ellipsis"></i></button>
                </header>
                <div class="kanban-tasks">
                    <?php foreach ($column['tasks'] as $task): ?>
                        <article class="task-card">
                            <div class="task-card-top">
                                <span class="task-id"><?= Html::encode($task['id']) ?></span>
                                <button class="icon-button task-menu" type="button" title="Task options"><i data-lucide="ellipsis"></i></button>
                            </div>
                            <h2><?= Html::encode($task['title']) ?></h2>
                            <p><?= Html::encode($task['description']) ?></p>
                            <div class="task-tags"><span><?= Html::encode($task['priority']) ?></span></div>
                            <footer>
                                <span class="mini-avatar"><?= Html::encode(substr($task['owner'], 0, 1)) ?></span>
                                <span><?= Html::encode($task['owner']) ?></span>
                                <span class="task-date"><i data-lucide="calendar-days"></i><?= Html::encode($task['date']) ?></span>
                            </footer>
                        </article>
                    <?php endforeach; ?>
                </div>
                <button class="add-task-button" type="button"><i data-lucide="plus"></i> Add task</button>
            </article>
        <?php endforeach; ?>
    </section>
</div>
