<?php

namespace Dirape\Token;

use Exception;

trait DirapeMultiToken
{
    /**
     * Generate the tokens.
     *
     * @throws Exception
     */
    public function setTokens()
    {
        if (! isset($this->DMT_columns)) {
            throw new Exception("No Columns settings found in model, please see our package documentation https://github.com/F54it/laravel-token");
        }
        $table = $this->getTable();
        $token = new Token();
        foreach ($this->DMT_columns as $column => $settings) {
            $generated_token = null;
            switch ($settings['type']) {
                case DT_Unique:
                    $generated_token = $token->unique($table, $column, $settings['size'], $settings['special_chr']);
                    break;
                case DT_UniqueNum:
                    $generated_token = $token->uniqueNumber($table, $column, $settings['size'], $settings['special_chr']);

                    break;
                case DT_UniqueStr:
                    $generated_token = $token->uniqueString($table, $column, $settings['size'], $settings['special_chr']);

                    break;
                case DT_Random:
                    $generated_token = $token->random($settings['size'], $settings['special_chr']);

                    break;
                case DT_RandomNum:
                    $generated_token = $token->randomNumber($settings['size'], $settings['special_chr']);

                    break;
                case DT_RandomStr:
                    $generated_token = $token->randomString($settings['size'], $settings['special_chr']);

                    break;
                default:
                    $generated_token = $token->unique($table, $column, $settings['size'], $settings['special_chr']);
                    break;
            }
            $this->attributes[$column] = $generated_token;
        }
    }
}