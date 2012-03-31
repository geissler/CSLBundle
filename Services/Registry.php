<?php
    namespace geissler\CSLBundle\Services;
    
    /**
 *  .
 *
 *  @author     Benjamin Geißler <benjamin.geissler@gmail.com>
 *  @version    1.0
 *  @package
 *  @subpackage Functional
 *  @since      1.0
 */
    class Registry {
        private static  $obj_Locale;
        private static  $arr_Macro = array();

        /**
         *  injects the locale translation object
         * 
         *  @param Locale $obj_Locale 
         */
        public static function setLocale(Locale $obj_Locale) {
            self::$obj_Locale   =   $obj_Locale;
        }
        
        /**
         *  access the locale translation object
         * 
         *  @return Locale
         *  @throws \ErrorException 
         */
        public static function getLocale() {
            if (isset(self::$obj_Locale) == true) {
                return self::$obj_Locale;
            }
            else {
                throw new \ErrorException('No Locale object injected');
            }
        }
        
        public static function setMacro($str_Name, $obj_Macro) {
            self::$arr_Macro[$str_Name] =   $obj_Macro;
        }


        public static function getMacro($str_Name) {
            if (isset(self::$arr_Macro[$str_Name]) == true) {
                return self::$arr_Macro[$str_Name];
            }
            else {
                throw new \ErrorException('No macro named ' . $str_Name . ' injected');
            }
        }
    }
?>
