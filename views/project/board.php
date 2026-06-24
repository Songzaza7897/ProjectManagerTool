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

    <section class="kanban-board" id="kanbanBoard" aria-label="Kanban task board">
        <?php foreach ($columns as $column): ?>
            <article class="kanban-column kanban-<?= Html::encode($column['tone']) ?>" data-column-key="<?= Html::encode($column['tone']) ?>">
                <header>
                    <span class="column-title"><i></i><?= Html::encode($column['title']) ?></span>
                    <span class="column-count"><?= count($column['tasks']) ?></span>
                    <button class="icon-button" type="button" title="Column options"><i data-lucide="ellipsis"></i></button>
                </header>
                <div class="kanban-tasks" data-column-key="<?= Html::encode($column['tone']) ?>">
                    <?php foreach ($column['tasks'] as $task): ?>
                        <article class="task-card" draggable="true" data-task-id="<?= Html::encode($task['id']) ?>">
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

<script>
(function () {
    const board = document.getElementById('kanbanBoard');
    if (!board) {
        return;
    }

    const storageKey = 'kanban-board-state-v1';
    let draggedTask = null;

    function updateColumnCounts() {
        board.querySelectorAll('.kanban-column').forEach((column) => {
            const countLabel = column.querySelector('.column-count');
            if (countLabel) {
                countLabel.textContent = column.querySelectorAll('.task-card').length;
            }
        });
    }

    function getBoardState() {
        return Array.from(board.querySelectorAll('.kanban-column')).map((column) => ({
            key: column.dataset.columnKey,
            tasks: Array.from(column.querySelectorAll('.task-card')).map((card) => card.dataset.taskId),
        }));
    }

    function saveBoardState() {
        localStorage.setItem(storageKey, JSON.stringify(getBoardState()));
    }

    function applyBoardState(state) {
        if (!Array.isArray(state) || !state.length) {
            updateColumnCounts();
            saveBoardState();
            return;
        }

        const columnMap = new Map(Array.from(board.querySelectorAll('.kanban-column')).map((column) => [column.dataset.columnKey, column]));
        const taskMap = new Map(Array.from(board.querySelectorAll('.task-card')).map((card) => [card.dataset.taskId, card]));

        board.querySelectorAll('.kanban-tasks').forEach((container) => {
            container.innerHTML = '';
        });

        state.forEach(({ key, tasks }) => {
            const targetColumn = columnMap.get(key);
            const targetContainer = targetColumn ? targetColumn.querySelector('.kanban-tasks') : null;

            if (!targetContainer) {
                return;
            }

            (tasks || []).forEach((taskId) => {
                const taskCard = taskMap.get(taskId);
                if (taskCard) {
                    targetContainer.appendChild(taskCard);
                }
            });
        });

        updateColumnCounts();
        saveBoardState();
    }

    function hydrateBoard() {
        try {
            const savedState = localStorage.getItem(storageKey);
            if (!savedState) {
                updateColumnCounts();
                saveBoardState();
                return;
            }

            applyBoardState(JSON.parse(savedState));
        } catch (error) {
            updateColumnCounts();
            saveBoardState();
        }
    }

    board.addEventListener('dragstart', (event) => {
        const taskCard = event.target.closest('.task-card');
        if (!taskCard) {
            return;
        }

        draggedTask = taskCard;
        taskCard.classList.add('dragging');
        event.dataTransfer.effectAllowed = 'move';
        event.dataTransfer.setData('text/plain', taskCard.dataset.taskId);
    });

    board.addEventListener('dragover', (event) => {
        const dropZone = event.target.closest('.kanban-tasks');
        if (!dropZone || !draggedTask) {
            return;
        }

        event.preventDefault();
        event.dataTransfer.dropEffect = 'move';
        board.querySelectorAll('.kanban-tasks').forEach((zone) => zone.classList.remove('drop-target'));
        dropZone.classList.add('drop-target');
    });

    board.addEventListener('dragleave', (event) => {
        const dropZone = event.target.closest('.kanban-tasks');
        if (!dropZone) {
            return;
        }

        const nextTarget = event.relatedTarget;
        if (!nextTarget || !dropZone.contains(nextTarget)) {
            dropZone.classList.remove('drop-target');
        }
    });

    board.addEventListener('drop', (event) => {
        event.preventDefault();

        const dropZone = event.target.closest('.kanban-tasks');
        if (!dropZone || !draggedTask) {
            return;
        }

        const destinationCard = event.target.closest('.task-card');
        if (destinationCard && dropZone.contains(destinationCard)) {
            dropZone.insertBefore(draggedTask, destinationCard);
        } else {
            dropZone.appendChild(draggedTask);
        }

        board.querySelectorAll('.kanban-tasks').forEach((zone) => zone.classList.remove('drop-target'));
        draggedTask.classList.remove('dragging');
        updateColumnCounts();
        saveBoardState();
        draggedTask = null;
    });

    board.addEventListener('dragend', () => {
        board.querySelectorAll('.task-card').forEach((card) => card.classList.remove('dragging'));
        board.querySelectorAll('.kanban-tasks').forEach((zone) => zone.classList.remove('drop-target'));
        draggedTask = null;
    });

    hydrateBoard();
})();
</script>
