<?php
declare(strict_types=1);
namespace TaskForce\models;

/**
 * Class Task
 *
 * @author Dmitriy Panov <panodmitrij@gmail.com>
 *
 * @package TaskForce\models
 */
class Task {

    const STATUS_NEW        = 'new';
    const STATUS_CANCELED   = 'canceled';
    const STATUS_IN_WORK    = 'in_work';
    const STATUS_DONE       = 'done';
    const STATUS_FAILED     = 'failed';

    const ACTION_REJECT_TASK    = 'action_reject_task';
    const ACTION_TAKE_TO_WORK   = 'action_take_to_work';
    const ACTION_COMPLETED      = 'action_completed';
    const ACTION_REFUSE         = 'action_refuse';

    /** @var string */
    public $status;

    /** @var int */
    public $executor_id;

    /** @var int */
    public $customer_id;

    /**
     * Task constructor.
     * @param int $customer_id
     */
    public function __construct(int $customer_id)
    {
        $this->customer_id  = $customer_id;
        $this->status       = self::STATUS_NEW;
    }

    /**
     * @return array
     */
    public static function getMapStatus(): array
    {
        return [
            self::STATUS_NEW        => 'Новое',
            self::STATUS_CANCELED   => 'Отменено',
            self::STATUS_IN_WORK    => 'В работе',
            self::STATUS_DONE       => 'Выполнено',
            self::STATUS_FAILED     => 'Провалено',
        ];
    }

    /**
     * @return array
     */
    public static function getMapActions(): array
    {
        return[
            self::ACTION_COMPLETED      => 'Выполнено',
            self::ACTION_REJECT_TASK    => 'Отменить',
            self::ACTION_TAKE_TO_WORK   => 'Откликнуться',
            self::ACTION_REFUSE         => 'Отказаться'
        ];
    }

    /**
     * @param string $action
     * @return string
     */
    public static function getStatusAfterAction(string $action): string
    {
        switch ($action) {
            case $action === self::ACTION_TAKE_TO_WORK :
                return self::STATUS_IN_WORK;
            case $action === self::ACTION_REJECT_TASK :
                return self::STATUS_CANCELED;
            case $action === self::ACTION_REFUSE :
                return self::STATUS_FAILED;
            case $action === self::ACTION_COMPLETED :
                return self::STATUS_DONE;
            default :
                new \Exception("undefined action : $action");
        }
    }

    /**
     * @param string $status
     * @return array
     */
    public static function getActionsForStatus($status): array
    {
        switch ($status) {
            case $status === self::STATUS_NEW :
                return [self::ACTION_REJECT_TASK, self::ACTION_TAKE_TO_WORK];
            case $status === self::STATUS_IN_WORK :
                return [self::ACTION_COMPLETED, self::ACTION_REFUSE];
        }

    }

}