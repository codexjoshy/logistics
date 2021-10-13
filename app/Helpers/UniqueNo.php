<?php

namespace App\Helpers;

class UniqueNo
{
    protected int $seed = 1;

    protected int $base = 2019;

    protected $validator = null;

    protected $afterHook = null;

    protected int $length = 8;

    protected bool $format = true;

    protected ?string $prefix = '';

    protected ?string $suffix = '';

    public function setBase(int $base)
    {
        $this->base = $base;
        return $this;
    }

    public function setValidator(callable $validator)
    {
        $this->validator = $validator;
        return $this;
    }

    public function setAfterHook(callable $afterHook)
    {
        $this->afterHook = $afterHook;
        return $this;
    }

    public function setLength(int $length)
    {
        $this->length = $length;
        return $this;
    }

    public function setFormat(bool $format)
    {
        $this->format = $format;
        return $this;
    }

    public function setPrefix(?string $prefix = '')
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function setSuffix(?string $suffix = '')
    {
        $this->suffix = $suffix;
        return $this;
    }

    public function generate()
    {
        $seed = $this->seed;
        $value = $this->create($seed);
        if (!$this->validator) {
            return $value;
        }
        //
        while(call_user_func($this->validator, $value)){
            ++$seed;
            $value = $this->create($seed);
        }
        if ($this->afterHook) {
            call_user_func($this->afterHook, $value);
        }
        return $value;
    }

    public function create(int $seed)
    {
        if($this->format){
            $lastYear = $this->base;
            for ($i=0; $i < 10; $i++) {
                $yearCollection[++$lastYear] = $i;
            }
            for ($j=65; $j <= 90; $j++) {
                $yearCollection[++$lastYear] = chr($j);
            }
            $lastMonth = 0;
            for ($i=0; $i < 10; $i++) {
                ++$lastMonth;
                $monthCollection[$lastMonth] = $i;
            }
            $monthCollection[10] = 9; $monthCollection[11] = "A"; $monthCollection[12] = "B";
            $yesterday = 0;
            for ($i=0; $i < 10; $i++) {
                ++$yesterday;
                $dayCollection[$yesterday] = $i;
            }
            for ($j=65; $j <= 90; $j++) {
                ++$i;
                $dayCollection[$i] = chr($j);
            }
            $timePart = $yearCollection[date("Y")].$monthCollection[date("n")].$dayCollection[date("j")];
        }
        else {
            $timePart = date("y").date("m").date("d");
        }
        if($diff = $this->length - strlen($seed)) {
            for ($i=0; $i < $diff; $i++) {
                $seed = "0".$seed;
            }
        }
        return $this->prefix.$timePart.$seed.$this->suffix;
    }
}
