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
    class Citation implements Interfaces\StyleElement {
        private $obj_Option;
        private $obj_Sort;
        private $obj_Layout;

        public function __construct() {
            $this->obj_Layout   =   new Layout();
        }

        public function setFormat(\DOMNodeList $obj_Format) {
            $b_Return   =   false;
            
            foreach ($obj_Format as $obj_Node) {
                // options for all citations
                $obj_Option =   $obj_Node->getElementsByTagName('option');
                
                foreach ($obj_Option as $obj_SubNode) {
                    /*
                    $value = $obj_SubNode->getAttribute('value');
                    $name  = $obj_SubNode->getAttribute('name');
                    $this->attributes[$name]  = $value;
                     * 
                     */
                }

                // get sorting options
                
                // get layout options
                $obj_Layout = $obj_Node->getElementsByTagName('layout');
                foreach ($obj_Layout as $obj_SubNode) {
                    $this->obj_Layout->setType('citation');
                    $this->obj_Layout->init($obj_SubNode);
                }
                
                $b_Return   =   true;
            }
            
            return $b_Return;
        }
        
        public function render() {
            
        }
    }
?>
