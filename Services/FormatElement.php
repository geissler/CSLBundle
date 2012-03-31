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
    abstract class FormatElement implements Interfaces\FormatElement {
        private $arr_Attribute;
        
        /**
         *  reads the supported attributes defined in arr_Attribute
         * 
         *  @param \DOMElement $obj_Format 
         */
        public function init(\DOMElement $obj_Format) {
            if (isset($obj_Format->attributes->length) == true) {
                $i_Length   =   $obj_Format->attributes->length;
                for($i = 0; $i < $i_Length; $i++) {
                    if (in_array($obj_Format->attributes->item($i)->name, array_keys($this->arr_Attribute)) == true) {
                        $this->arr_Attribute[$obj_Format->attributes->item($i)->name]   =   $obj_Format->attributes->item($i)->value;
                    }
                }
            }                    
        }
        
        /**
         *  injects the possible attributes as keys, values are empty
         * 
         *  @param array $arr_Attribute 
         */
        protected function setAttributes(array $arr_Attribute) {
            $this->arr_Attribute    =   $arr_Attribute;
        }
        
        /**
         *  returns the attribute array
         * 
         *  @return array
         */
        protected function getAttributes() {
            return $this->arr_Attribute;
        }

        /**
         *  returns the value of the requested attribute if set and note empty
         * 
         *  @param  string  $str_Key
         *  @return string|boolean 
         */
        protected function getAttribute($str_Key) {
            if (isset($this->arr_Attribute[$str_Key]) == true
                && $this->arr_Attribute[$str_Key] !== '') {
                    return $this->arr_Attribute[$str_Key];
            }
            else {
                return false;
            }
        }
    }
?>