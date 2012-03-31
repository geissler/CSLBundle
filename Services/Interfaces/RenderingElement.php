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
    
    interface RenderingElement {
        public function init(\DOMElement $obj_Format);
        
        public function render($obj_Data);    
    }
?>
