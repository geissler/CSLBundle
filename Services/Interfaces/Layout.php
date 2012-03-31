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
    interface Layout extends RenderingElement {
        /**
         *  set the display type
         * 
         *  @param  string  $str_Type   citation or bibliography
         *  @return boolean 
         */
        public function setType($str_Type);
    }
?>
