<?php

namespace Dirape\Token;


trait DirapeMultiToken
{
    /**
     * generate the token
     *
     * @param string $type
     * @param strin $column
     * @param integer $size
     * @param boolean $specialCharacter
     */
    public function setTokens()
    {
        if (!isset($this->DMT_columns)) {
            throw new \Exception("No Columns settings found in model, please see our package documentation https://github.com/F54it/laravel-token");
        }
        $table = $this->getTable();
        $token = new Token();
        foreach($this->DMT_columns as $column=>$settings) {
            $generated_token = null;
            switch ($settings['type']) {
                case DT_Unique:
                    $generated_token = $token->Unique($table, $column, $settings['size'],$settings['special_chr']);
                    break;
                case DT_UniqueNum:
                    $generated_token = $token->UniqueNumber($table, $column, $settings['size'],$settings['special_chr']);

                    break;
                case DT_UniqueStr:
                    $generated_token = $token->UniqueString($table,$column, $settings['size'],$settings['special_chr']);

                    break;
                case DT_Random:
                    $generated_token = $token->Random($settings['size'],$settings['special_chr']);

                    break;
                case DT_RandomNum:
                    $generated_token = $token->RandomNumber($settings['size'],$settings['special_chr']);

                    break;
                case DT_RandomStr:
                    $generated_token = $token->RandomString($settings['size'],$settings['special_chr']);

                    break;
                default:
                    $generated_token = $token->Unique($table, $column, $settings['size'],$settings['special_chr']);
                    break;

            }
            $this->attributes[$column] = $generated_token;
        }
    }



}