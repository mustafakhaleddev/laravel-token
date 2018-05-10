<?php

namespace Dirape\Token;

use MongoDB\Driver\Query;

trait DirapeToken
{
    protected $default_settings = ['type' => 'Unique', 'size' => 40, 'special_chr' => false];
    protected $default_column = 'dt_token';

    /**
     * generate the token
     *
     * @param string $type
     * @param strin $column
     * @param integer $size
     * @param boolean $specialCharacter
     */
    public function setToken($type = null,int $size = null,bool $specialCharacter = null,$column = null)
    {
        if (!isset($this->DT_settings)) {
            $this->DT_settings = $this->default_settings;
        }
        if (!isset($this->DT_Column)) {
            $this->DT_Column = $this->default_column;
        }
        if ($type != null) {
            $this->attributes['DT_settings']['type'] = $type;
        }
        if ($column != null) {
            $this->DT_Column = $column;
        }
        if ($size != null) {
            $this->attributes['DT_settings']['size'] = $size;

        }
        if ($specialCharacter != null) {
            $this->attributes['DT_settings']['special_chr'] = $specialCharacter;
            }
        $table = $this->getTable();
        $token = new Token();
        $generated_token = null;
        switch ($this->DT_settings['type']) {
            case DT_Unique:
                $generated_token = $token->Unique($table, $this->DT_Column, $this->DT_settings['size'], $this->DT_settings['special_chr']);
                break;
            case DT_UniqueNum:
                $generated_token = $token->UniqueNumber($table, $this->DT_Column, $this->DT_settings['size'], $this->DT_settings['special_chr']);

                break;
            case DT_UniqueStr:
                $generated_token = $token->UniqueString($table, $this->DT_Column, $this->DT_settings['size'], $this->DT_settings['special_chr']);

                break;
            case DT_Random:
                $generated_token = $token->Random($this->DT_settings['size'], $this->DT_settings['special_chr']);

                break;
            case DT_RandomNum:
                $generated_token = $token->RandomNumber($this->DT_settings['size'], $this->DT_settings['special_chr']);

                break;
            case DT_RandomStr:
                $generated_token = $token->RandomString($this->DT_settings['size'], $this->DT_settings['special_chr']);

                break;
            default:
                $generated_token = $token->Unique($table, $this->DT_Column, $this->DT_settings['size'], $this->DT_settings['special_chr']);
                break;

        }

        $this->attributes[$this->DT_Column] = $generated_token;
        unset($this->DT_settings);
    }
    /**
     * Scope with token Query
     * @return Query
     */
    public function scopeWithToken($query,$flag=true)
    {
        if (!isset($this->DT_Column)) {
            $this->DT_Column = $this->default_column;
        }

        if($flag)
        {
            return $query->where( $this->DT_Column, '!=',null);
        }else
        {
            return $query->where( $this->DT_Column, '=',null);
        }
    }


}