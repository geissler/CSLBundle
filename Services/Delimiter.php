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
    class Delimiter extends FormatElement {
        /**
         *  set supported attributes 
         */
        public function __construct() {
            $this->setAttributes(array('delimiter' => ''));
        }
        
        /**
         *  seperats more than one value with the given delimiter
         *  @param   array   $str_Value
         *  @return  string
         */
        public function format($str_Value) {
            if ($this->getAttribute('delimiter') !== false
                && is_array($str_Value) == true
                && count($str_Value) > 0) {
                    return implode($this->getAttribute('delimiter'), $str_Value);
            }
            else if (is_array ($str_Value) == true){
                return implode('', $str_Value);
            }
            else {
                return $str_Value;
            }
        }
    }
?>