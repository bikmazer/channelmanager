<?php

namespace ChannelManager\Provider;


interface ChannelBase
{

    /**
     * Send xml
     *
     * @return boolean
     */
    public static function send();

    /**
     * InitRate
     *
     * @return boolean
     */
    public static function initRate();

    /**
     * InitAvailability
     *
     * @param $data
     * @return bool
     */
    public static function initAvailability($data);

    /**
     * InitAvailability
     *
     * @param $param
     * @param $param2
     * @return bool
     */
    public static function initReserrvations($param,$param2);

}
