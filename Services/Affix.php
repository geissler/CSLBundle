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
    class Affix extends FormatElement {
        /**
         *  inits the supported attributes 
         */
        public function __construct() {
            $this->setAttributes(array('prefix' => '', 'suffix' => ''));
        }

        /**
         *  adds the prefix and suffix if set
         * 
         *  @param  string  $str_Value
         *  @return string
         */
        public function format($str_Value) {
            if ($this->getAttribute('prefix') !== false) {
                $str_Value  = $this->getAttribute('prefix') . $str_Value;
            }
            
            if ($this->getAttribute('suffix') !== false) {
                $str_Value  .= $this->getAttribute('suffix');
            }
            
            return $str_Value;
        }
    }
?>
