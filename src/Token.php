<?php

namespace Dirape\Token;


use Illuminate\Support\Facades\DB;

class Token
{
    /**
     * Create a new Unique Token..
     *
     * @return string
     */
    public function Unique($table, $col, $size, $special = false)
    {
        $this->SpecialCharacter = $special;
        Do {

            $code = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $code .= "abcdefghijklmnopqrstuvwxyz";
            $code .= "0123456789";
            $token = $this->Generate($code, $size);
            $t = DB::table($table)->where($col, $token)->first();

        } while ($t);
        return $token;
    }

    /**
     * Create a new Unique Integer Token.
     *
     * @return integer
     */
    public function UniqueNumber($table, $col, $size, $special = false)
    {
        $this->SpecialCharacter = $special;
        Do {
            $code = "0123456789";
            $token = $this->Generate($code, $size);
            $t = DB::table($table)->where($col, $token)->first();

        } while ($t);
        return $token;
    }

    /**
     * Create a new Unique String Token.
     *
     * @return string
     */
    public function UniqueString($table, $col, $size, $special = false)
    {
        $this->SpecialCharacter = $special;
        Do {
            $code = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $code .= "abcdefghijklmnopqrstuvwxyz";
            $token = $this->Generate($code, $size);
            $t = DB::table($table)->where($col, $token)->first();

        } while ($t);
        return $token;
    }

    /**
     * Create a new Random Token.
     *
     * @return string
     */
    public function Random($size, $special = false)
    {
        $this->SpecialCharacter = $special;
        $code = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code .= "abcdefghijklmnopqrstuvwxyz";
        $code .= "0123456789";
        $token = $this->Generate($code, $size);
        return $token;
    }

    /**
     * Create a new Random Number Token.
     *
     * @return string
     */
    public function RandomNumber($size, $special = false)
    {
        $this->SpecialCharacter = $special;

        $code = "0123456789";
        $token = $this->Generate($code, $size);
        return $token;
    }

    /**
     * Create a new Random Number Token.
     *
     * @return string
     */
    public function RandomString($size, $special = false)
    {
        $this->SpecialCharacter = $special;

        $code = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code .= "abcdefghijklmnopqrstuvwxyz";
        $token = $this->Generate($code, $size);
        return $token;
    }

    /**
     * Generate The Token.
     *
     * @return string
     */
    private function Generate($code, $size)
    {
        if ($this->SpecialCharacter) {
            $code .= '!@#$%^&*()';
        }
        $token = '';
        $max = strlen($code);
        for ($i = 0; $i < $size; $i++) {
            $token .= $code[random_int(0, $max - 1)];
        }
        return $token;
    }

}
