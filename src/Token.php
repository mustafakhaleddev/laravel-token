<?php

namespace Dirape\Token;

use Illuminate\Support\Facades\DB;

class Token
{
    /**
     * Create a unique token.
     *
     * @param string $table
     * @param string $col
     * @param integer $size
     * @param bool $withSpecialCharacters
     * @return string
     * @throws \Exception
     */
    public function unique($table, $col, $size, $withSpecialCharacters = false)
    {
        do {
            $token = $this->random($size, $withSpecialCharacters);

            $exists = DB::table($table)->where($col, $token)->exists();
        } while ($exists);

        return $token;
    }

    /**
     * Create a unique number.
     *
     * @param string $table
     * @param string $column
     * @param $size
     * @param bool $withSpecialCharacters
     * @return integer
     * @throws \Exception
     */
    public function uniqueNumber($table, $column, $size, $withSpecialCharacters = false)
    {
        do {
            $token = $this->randomNumber($size, $withSpecialCharacters);

            $exists = DB::table($table)->where($column, $token)->exists();
        } while ($exists);

        return $token;
    }

    /**
     * Create a unique string.
     *
     * @param string $table
     * @param string $column
     * @param int $size
     * @param bool $withSpecialCharacters
     * @return string
     * @throws \Exception
     */
    public function uniqueString($table, $column, $size, $withSpecialCharacters = false)
    {
        do {
            $token = $this->randomString($size, $withSpecialCharacters);

            $exists = DB::table($table)->where($column, $token)->exists();
        } while ($exists);

        return $token;
    }

    /**
     * Create a random token.
     *
     * @param int $size
     * @param bool $withSpecialCharacters
     * @return string
     * @throws \Exception
     */
    public function random($size, $withSpecialCharacters = false)
    {
        $code = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code .= "abcdefghijklmnopqrstuvwxyz";
        $code .= "0123456789";

        $token = $this->generate($code, $size, $withSpecialCharacters);

        return $token;
    }

    /**
     * Create a random number.
     *
     * @param int $size
     * @param bool $withSpecialCharacters
     * @return string
     * @throws \Exception
     */
    public function randomNumber($size, $withSpecialCharacters = false)
    {
        $code = "0123456789";
        $token = $this->generate($code, $size, $withSpecialCharacters);

        return $token;
    }

    /**
     * Create a random string.
     *
     * @param int $size
     * @param bool $withSpecialCharacters
     * @return string
     * @throws \Exception
     */
    public function randomString($size, $withSpecialCharacters = false)
    {
        $code = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code .= "abcdefghijklmnopqrstuvwxyz";
        $token = $this->generate($code, $size, $withSpecialCharacters);

        return $token;
    }

    /**
     * Generate a random token.
     *
     * @param string $characters
     * @param int $size
     * @param bool $withSpecialCharacters
     * @return string
     * @throws \Exception
     */
    private function generate($characters, $size, $withSpecialCharacters = false)
    {
        if ($withSpecialCharacters) {
            $characters .= '!@#$%^&*()';
        }

        $token = '';
        $max = strlen($characters);
        for ($i = 0; $i < $size; $i++) {
            $token .= $characters[random_int(0, $max - 1)];
        }

        return $token;
    }
}
