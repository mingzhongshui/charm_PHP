<?php 
namespace system\core;

class Security
{


	/**
     * XSS 过滤函数
     * @param  string  &$string 字符串
     * @param  boolean $low     安全等级
     */
    public function clean_xss(&$string, $low = False)
    {
        if (! is_array ( $string ))
        {
            $string = trim ( $string );
            $string = htmlspecialchars ( $string );
            if ($low) return TRUE;

            // $string = str_replace ( array ('"', "\\", "'", "/", "..", "../", "./", "//" ), '', $string );
            $no = '/%0[0-8bcef]/';
            $string = preg_replace ( $no, '', $string );
            $no = '/%1[0-9a-f]/';
            $string = preg_replace ( $no, '', $string );
            $no = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';
            $string = preg_replace ( $no, '', $string );
            return TRUE;
        }
        $keys = array_keys ( $string );
        foreach ( $keys as $key ) {
            $this->clean_xss ( $string [$key] );
        }
    }


	public function isEscape($val, $isboor = false) {
        if (! get_magic_quotes_gpc ()) {
            if(is_array($val)) {
                foreach ($val as $key => $v) {
                    $val[$key] = htmlspecialchars ( $v );
                }
            }
        }
        if ($isboor) {
            $val = strtr ( $val, array (
                    "%" => "\%",
                    "_" => "\_" 
            ) );
        }

        $this->clean_xss($val);
        return $val;
    }

}