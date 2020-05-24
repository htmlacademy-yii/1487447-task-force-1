<?php
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

    const ACTION_CANCELED = 'action_canceled';
    const ACTION_IN_WORK  = 'action_in_work';
    const ACTION_FINISH   = 'action_finish';
    const ACTION_FAILED   = 'action_failed';

    /** @var string */
    public $status;

    /** @var int */
    public $executor_id;

    /** @var int */
    public $customer_id;

    /**
     * @return array
     */
    public static function getMapStatus() {
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
    public static function getMapActions() {
        return[
            self::ACTION_FINISH     => 'Выполнено',
            self::ACTION_CANCELED   => 'Отменить',
            self::ACTION_IN_WORK    => 'Откликнуться',
            self::ACTION_FAILED     => 'Отказаться'
        ];
    }

    /**
     * @param string $action
     * @return string
     */
    public static function getStatusAfterAction($action) {
        switch ($action) {
            case $action === self::ACTION_IN_WORK :
                return self::STATUS_IN_WORK;
            case $action === self::ACTION_CANCELED :
                return self::STATUS_CANCELED;
            case $action === self::ACTION_FAILED :
                return self::STATUS_FAILED;
            case $action === self::ACTION_FINISH :
                return self::STATUS_DONE;
            default :
                new \Exception("undefined action : $action");
        }
    }

    /**
     * @param string $status
     * @return array
     */
    public static function getActionsForStatus($status) {
        switch ($status) {
            case $status === self::STATUS_NEW :
                return [self::ACTION_CANCELED, self::ACTION_IN_WORK];
            case $status === self::STATUS_IN_WORK :
                return [self::ACTION_FINISH, self::ACTION_FAILED];
            default :
                new \Exception("undefined status : $status");
        }

    }

}