<?php

namespace App\Infrastructure\Config;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Fluent;

class Config extends Model
{

    protected $table = 'config';

    protected $primaryKey = 'key';

    public $timestamps = false;

    protected $fillable = ['key', 'value'];

    protected $cache = false;

    public function set($key, $value)
    {
        $object = self::find($key);

        if ($object) {
            $object->value = \GuzzleHttp\json_encode($value);
        } else {
            $object = new static(compact('key', 'value'));
        }

        $object->save();

        Cache::forget($key);

        return $object;
    }

    public function get($key)
    {
        $callback = function () use ($key) {
            $config = (new static)->newQuery()->find($key);

            if ($config) {
                return $config->value;
            }
        };

        if ($this->cache) {
            return Cache::rememberForever($key, $callback);
        }

        return $callback();
    }

    public function getAsCollection($key, $delimiter = ',')
    {
        $value = self::get($key);

        return collect(explode($delimiter, $value));
    }

    public function getAsBoolean($key)
    {
        return filter_var(self::get($key), FILTER_VALIDATE_BOOLEAN);
    }

    public function getAsObject($key)
    {
        $value = self::get($key);

        if ($value) {
            return new Fluent(json_decode($value));
        }

        return new Fluent;
    }

    public function getAsArray($key)
    {
        $value = static::get($key);

        if ($value) {
            return json_decode($value, true);
        }
    }

    public function cached()
    {
        return (new static)->withCache();
    }

    public function withCache()
    {
        $this->cache = true;
        return $this;
    }

}