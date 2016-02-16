<?php namespace ChannelManager\Provider;

class Booking implements ChannelBase
{
    public static function send()
    {
        return "sent";
    }

    public static function initRate()
    {
        return "inited";
    }

    public static function initAvailability($data)
    {
        return "availil";
    }

    public static function initReserrvations($param, $param2)
    {
        return "reservations";
    }

}
?>