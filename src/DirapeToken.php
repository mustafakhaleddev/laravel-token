<?php

namespace Dirape\Token;

use MongoDB\Driver\Query;

trait DirapeToken
{
    /**
     * The default token settings.
     *
     * @var array
     */
    protected $defaultSettings = [
        'type' => 'Unique',
        'size' => 40,
        'special_chr' => false,
    ];

    /**
     * The default database column name.
     *
     * @var string
     */
    protected $defaultColumn = 'dt_token';

    /**
     * generate the token
     *
     * @param string $type
     * @param string $column
     * @param int $size
     * @param bool $specialCharacter
     * @throws \Exception
     */
    public function setToken($type = null, int $size = null, bool $specialCharacter = null, $column = null)
    {
        if (! isset($this->DT_settings)) {
            $this->DT_settings = $this->defaultSettings;
        }
        if (! isset($this->DT_Column)) {
            $this->DT_Column = $this->defaultColumn;
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
                $generated_token = $token->unique($table, $this->DT_Column, $this->DT_settings['size'], $this->DT_settings['special_chr']);
                break;
            case DT_UniqueNum:
                $generated_token = $token->uniqueNumber($table, $this->DT_Column, $this->DT_settings['size'], $this->DT_settings['special_chr']);

                break;
            case DT_UniqueStr:
                $generated_token = $token->uniqueString($table, $this->DT_Column, $this->DT_settings['size'], $this->DT_settings['special_chr']);

                break;
            case DT_Random:
                $generated_token = $token->random($this->DT_settings['size'], $this->DT_settings['special_chr']);

                break;
            case DT_RandomNum:
                $generated_token = $token->randomNumber($this->DT_settings['size'], $this->DT_settings['special_chr']);

                break;
            case DT_RandomStr:
                $generated_token = $token->randomString($this->DT_settings['size'], $this->DT_settings['special_chr']);

                break;
            default:
                $generated_token = $token->Unique($table, $this->DT_Column, $this->DT_settings['size'], $this->DT_settings['special_chr']);
                break;
        }

        $this->attributes[$this->DT_Column] = $generated_token;
        unset($this->DT_settings);
    }

    /**
     * Scope with token query.
     *
     * @param $query
     * @param bool $flag
     * @return Query
     */
    public function scopeWithToken($query, $flag = true)
    {
        if (! isset($this->DT_Column)) {
            $this->DT_Column = $this->defaultColumn;
        }

        if ($flag) {
            return $query->where($this->DT_Column, '!=', null);
        } else {
            return $query->where($this->DT_Column, '=', null);
        }
    }
}