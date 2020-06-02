<?php
use TaskForce\models\Task;

require_once '../models/Task.php';

assert(Task::getMapActions() === [
        Task::ACTION_COMPLETED      => 'Выполнено',
        Task::ACTION_REJECT_TASK    => 'Отменить',
        Task::ACTION_TAKE_TO_WORK   => 'Откликнуться',
        Task::ACTION_REFUSE         => 'Отказаться'
    ], 'Test failed getMapActions');

assert(Task::getMapStatus() === [
        Task::STATUS_NEW        => 'Новое',
        Task::STATUS_CANCELED   => 'Отменено',
        Task::STATUS_IN_WORK    => 'В работе',
        Task::STATUS_DONE       => 'Выполнено',
        Task::STATUS_FAILED     => 'Провалено',
    ], 'Test failed getMapStatus');


$isPassedTestGetStatusAfterAction = false;

$expectedResults = [
    Task::ACTION_TAKE_TO_WORK   => Task::STATUS_IN_WORK,
    Task::ACTION_REJECT_TASK    => Task::STATUS_CANCELED,
    Task::ACTION_REFUSE         => Task::STATUS_FAILED,
    Task::ACTION_COMPLETED      => Task::STATUS_DONE
];

foreach ($expectedResults as $action => $expectedStatus) {
    assert(Task::getStatusAfterAction($action) === $expectedStatus, "Test failed GetStatusAfterAction($action)");
}

$isPassedTestGetActionsForStatus = false;

$expectedResults = [
    Task::STATUS_NEW        => [Task::ACTION_REJECT_TASK, Task::ACTION_TAKE_TO_WORK],
    Task::STATUS_IN_WORK    => [Task::ACTION_COMPLETED, Task::ACTION_REFUSE]
];

foreach ($expectedResults as $status => $expectedActions) {
    assert(Task::getActionsForStatus($status) === $expectedActions, "Test failed getActionsForStatus($status)");
}