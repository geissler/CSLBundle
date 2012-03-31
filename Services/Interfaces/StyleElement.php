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
    interface StyleElement {
        public function setFormat(\DOMNodeList $obj_Format);
        
        public function render();
    }
?>
