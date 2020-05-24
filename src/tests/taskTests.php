<?php
use TaskForce\models\Task;

require_once '../models/Task.php';

$isPassedTestGetMapActions = Task::getMapActions() === [
        Task::ACTION_FINISH     => 'Выполнено',
        Task::ACTION_CANCELED   => 'Отменить',
        Task::ACTION_IN_WORK    => 'Откликнуться',
        Task::ACTION_FAILED     => 'Отказаться'
    ];

assert($isPassedTestGetMapActions, 'Test failed getMapActions');

$isPassedTestGetMapStatus = Task::getMapStatus() === [
        Task::STATUS_NEW        => 'Новое',
        Task::STATUS_CANCELED   => 'Отменено',
        Task::STATUS_IN_WORK    => 'В работе',
        Task::STATUS_DONE       => 'Выполнено',
        Task::STATUS_FAILED     => 'Провалено',
    ];

assert($isPassedTestGetMapStatus, 'Test failed getMapStatus');


$isPassedTestGetStatusAfterAction = false;

$expectedResults = [
    Task::ACTION_IN_WORK    => Task::STATUS_IN_WORK,
    Task::ACTION_CANCELED   => Task::STATUS_CANCELED,
    Task::ACTION_FAILED     => Task::STATUS_FAILED,
    Task::ACTION_FINISH     => Task::STATUS_DONE
];

foreach ($expectedResults as $action => $expectedStatus) {
    $isPassedTestGetStatusAfterAction = Task::getStatusAfterAction($action) === $expectedStatus;

    if (! $isPassedTestGetStatusAfterAction) {
        assert($isPassedTestGetStatusAfterAction, "Test failed GetStatusAfterAction($action)");

        break;
    }
}

$isPassedTestGetActionsForStatus = false;

$expectedResults = [
    Task::STATUS_NEW        => [Task::ACTION_CANCELED, Task::ACTION_IN_WORK],
    Task::STATUS_IN_WORK    => [Task::ACTION_FINISH, Task::ACTION_FAILED]
];

foreach ($expectedResults as $status => $expectedActions) {
    $isPassedTestGetActionsForStatus = Task::getActionsForStatus($status) === $expectedActions;

    if (! $isPassedTestGetActionsForStatus) {
        assert($isPassedTestGetActionsForStatus, "Test failed getActionsForStatus($status)");
    }
}

if (
$isPassedTestGetMapActions &&
$isPassedTestGetMapStatus &&
$isPassedTestGetStatusAfterAction &&
$isPassedTestGetActionsForStatus
) {
    echo "\n All tests passed successful \n";
}