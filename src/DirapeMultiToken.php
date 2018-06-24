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
                case Token::UNIQUE_NUMBER:
                    $generated_token = $token->uniqueNumber($table, $column, $settings['size'], $settings['special_chr']);

                    break;
                case Token::UNIQUE_STRING:
                    $generated_token = $token->uniqueString($table, $column, $settings['size'], $settings['special_chr']);

                    break;
                case Token::RANDOM:
                    $generated_token = $token->random($settings['size'], $settings['special_chr']);

                    break;
                case Token::RANDOM_NUMBER:
                    $generated_token = $token->randomNumber($settings['size'], $settings['special_chr']);

                    break;
                case Token::RANDOM_STRING:
                    $generated_token = $token->randomString($settings['size'], $settings['special_chr']);

                    break;
                case Token::UNIQUE:
                default:
                    $generated_token = $token->unique($table, $column, $settings['size'], $settings['special_chr']);
                    break;
            }
            $this->attributes[$column] = $generated_token;
        }
    }
}