<?php
    namespace geissler\CSLBundle\Services\Interfaces;
    
    /**
 *  .
 *
 *  @author     Benjamin Geißler <benjamin.geissler@gmail.com>
 *  @version    1.0
 *  @package
 *  @subpackage Functional
 *  @since      1.0
 */
    interface FormatElement {
        /**
         *  reads the supported attributes of this type of formating class
         * 
         *  @param  \DOMElement $obj_Format
         *  @return void
         */
        public function init(\DOMElement $obj_Format);
        
        /**
         *  returns the values formated
         * 
         *  @param  string  $str_Value
         *  @return string 
         */
        public function format($str_Value);
    }
?>
