<?php
/**
 * Created by PhpStorm.
 * User: ralf
 * Date: 01.08.15
 * Time: 12:22
 */

namespace App\Http;
class Flash {
    /**
     * Creates a new message
     *
     * @param $title
     * @param $message
     * @param $level
     * @param string $key
     */

    public function create($title, $message, $level, $key = 'flash_message')
    {
        session()->flash( $key, [
            'title'     => $title,
            'message'   => $message,
            'level'     => $level
        ]);
    }
    /**
     * Creates a new information message
     *
     * @param $title
     * @param $message
     */
    public function info($title, $message)
    {
        return $this->create($title, $message, 'info');
    }
    /**
     * Creates a new successs message
     *
     * @param $title
     * @param $message
     */
    public function success($title, $message)
    {
        return $this->create($title, $message, 'success');
    }
    /**
     * Creates a new error message
     *
     * @param $title
     * @param $message
     */
    public function error($title, $message)
    {
        return $this->create($title, $message, 'error');
    }
    /**
     * Creates a new overlay message with a button to confirm
     *
     * @param $title
     * @param $message
     * @param string $level
     */
    public function overlay($title, $message, $level = 'success')
    {
        return $this->create($title, $message, $level, 'flash_message_overlay');
    }
}