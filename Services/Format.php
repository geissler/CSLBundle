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
    class Format extends FormatElement {
        /**
         *  init the attritbutes 
         */
        public function __construct() {
            $this->setAttributes(
                                array(
                                    'font-style'        =>  '', 
                                    'font-variant'      =>  '', 
                                    'font-weight'       =>  '', 
                                    'text-decoration'   =>  '',
                                    'vertical-align'    =>  ''));
        }
        
        /**
         *  surounds the value with a span and the given style parameters
         * 
         *  @param  string $str_Value
         *  @return string 
         */
        public function format($str_Value) {
            $arr_Font   =   array();
            foreach($this->getAttributes() as $str_Format => $mix_Value) {
                if ($mix_Value !== '') {
                    $arr_Font[] =   $str_Format . ': ' . $mix_Value;
                }                               
            }
            
            if (count($arr_Font) > 0) {
                $str_Value  =   '<span style="' . implode(';', $arr_Font) . '">' . $str_Value . '</span>';
            }
            
            return $str_Value;
        }
    }
?>
