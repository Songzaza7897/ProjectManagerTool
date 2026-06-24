<?php

/** @var yii\web\View $this */
/** @var array $projects */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Projects';
?>
<div class="page-container projects-page">
    <div class="page-heading">
        <div>
            <p class="page-kicker">Workspace</p>
            <h1>Projects</h1>
            <p class="page-subtitle">Track ownership, workload, and delivery across every initiative.</p>
        </div>
        <button class="btn btn-dark heading-action" type="button" data-bs-toggle="modal" data-bs-target="#projectModal">
            <i data-lucide="plus"></i><span>Create project</span>
        </button>
    </div>

    <div class="project-toolbar">
        <div class="toolbar-search">
            <i data-lucide="search"></i>
            <input type="search" class="form-control" placeholder="Search projects" aria-label="Search projects">
        </div>
        <select class="form-select" aria-label="Filter by status">
            <option>All statuses</option>
            <option>Active</option>
            <option>Planning</option>
        </select>
        <select class="form-select" aria-label="Sort projects">
            <option>Recently updated</option>
            <option>Name A-Z</option>
            <option>Progress</option>
        </select>
        <div class="view-switch" role="group" aria-label="Project display">
            <button class="icon-button is-selected" type="button" title="List view"><i data-lucide="list"></i></button>
            <button class="icon-button" type="button" title="Grid view"><i data-lucide="grid-2x2"></i></button>
        </div>
    </div>

    <div class="project-list">
        <?php foreach ($projects as $project): ?>
            <article class="project-row">
                <a class="project-main" href="<?= Url::to(['/project/view', 'id' => $project['id']]) ?>">
                    <span class="project-symbol"><?= Html::encode(strtoupper(substr($project['name'], 0, 1))) ?></span>
                    <span>
                        <strong><?= Html::encode($project['name']) ?></strong>
                        <small><?= Html::encode($project['description']) ?></small>
                    </span>
                </a>
                <div class="project-meta"><i data-lucide="users"></i><span><?= Html::encode($project['members']) ?> members</span></div>
                <div class="project-meta"><i data-lucide="square-check-big"></i><span><?= Html::encode($project['tasks']) ?> tasks</span></div>
                <div class="project-meta"><i data-lucide="calendar-days"></i><span><?= Html::encode($project['date']) ?></span></div>
                <div class="project-progress">
                    <div><span>Complete</span><strong><?= Html::encode($project['progress']) ?>%</strong></div>
                    <div class="progress" role="progressbar" aria-valuenow="<?= Html::encode($project['progress']) ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar" style="width: <?= Html::encode($project['progress']) ?>%"></div>
                    </div>
                </div>
                <button class="icon-button row-menu" type="button" title="Project options"><i data-lucide="ellipsis-vertical"></i></button>
            </article>
        <?php endforeach; ?>
    </div>
</div>

<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="projectModalLabel">Create project</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="form-label" for="project-name">Project name</label>
                <input class="form-control" id="project-name" placeholder="New project">
                <label class="form-label mt-3" for="project-description">Description</label>
                <textarea class="form-control" id="project-description" rows="3" placeholder="What is this project about?"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Create project</button>
            </div>
        </div>
    </div>
</div>
