<?php namespace ChannelManager;

class Channel
{

    protected $providers = array();
    protected $formatters = array();

    public function __construct()
    {

    }


    public static function create()
    {
        self::addProvider(self::findProviderClassname("Booking"));
    }

    protected static function getProviderClassname($provider)
    {
        if ($providerClass = self::findProviderClassname($provider)) {
            return $providerClass;
        }
        throw new \InvalidArgumentException(sprintf('Unable to find provider "%s""', $provider));
    }

    protected static function findProviderClassname($provider)
    {
        $providerClass = 'ChannelManager\\' . sprintf('Provider\%s', $provider);
        if (class_exists($providerClass, true)) {
            return $providerClass;
        }
    }

    public function addProvider($provider)
    {
        array_unshift($this->providers, $provider);
    }

    public function getProviders()
    {
        return $this->providers;
    }

    public function __get($attribute)
    {
        return $this->format($attribute);
    }

    public function __call($method, $attributes)
    {
        return $this->format($method, $attributes);
    }

    public function format($formatter, $arguments = array())
    {
        return call_user_func_array($this->getFormatter($formatter), $arguments);
    }

    public function getFormatter($formatter)
    {
        if (isset($this->formatters[$formatter])) {
            return $this->formatters[$formatter];
        }

        foreach ($this->providers as $provider) {
            if (method_exists($provider, $formatter)) {
                $this->formatters[$formatter] = array($provider, $formatter);
                return $this->formatters[$formatter];
            }
        }
        throw new \InvalidArgumentException(sprintf('Unknown formatter "%s"', $formatter));
    }
}