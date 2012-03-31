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
    class Layout implements Interfaces\Layout {
        private $arr_Child;
        private $obj_Affix;
        private $obj_Format;
        private $obj_Delimiter;
        private $str_Type;

        public function __construct() {
            $this->arr_Child        =   array();
            $this->obj_Affix        =   new Affix();
            $this->obj_Format       =   new Format();
            $this->obj_Delimiter    =   new Delimiter();
        }

        /**
         *  set the display type
         * 
         *  @param  string  $str_Type   citation or bibliography
         *  @return boolean 
         */
        public function setType($str_Type) {
            if (in_array($str_Type, array('bibliography', 'citation')) == true) {
                $this->str_Type =   $str_Type;
                return true;
            }
            else {
                return false;
            }
        }

        public function init(\DOMElement $obj_Format) {
            // set affix and format
            $this->obj_Affix->init($obj_Format);
            $this->obj_Format->init($obj_Format);
            
            // init delimiter for citation
            if ($this->str_Type == 'citation') {
                $this->obj_Delimiter->init($obj_Format);
            }
            
            // set child elements            
            foreach ($obj_Format->childNodes as $obj_Node) {
                if ($obj_Node->nodeType == 1) {
                    
                    switch($obj_Node->nodeName) {
                        case 'text':
                            $obj_Child  =   new Text();                            
                        break;    
                    }
                    
                    if (isset($obj_Child) == true) {
                        $obj_Child->init($obj_Node);
                        $this->_addChild($obj_Child);
                    }
                    /*
                    
                    var_dump($obj_Node->nodeName);
                    //$this->add_element(csl_factory::create($obj_Node, $citeproc));
                     * 
                     */
                }
            }
        }
        
        public function render($obj_Data) {
            $arr_Return =   array();
            
            foreach($obj_Data as $arr_Entry) {
                $arr_Child  =   array();
                foreach($this->arr_Child as $obj_Child) {
                    $arr_Child[]   =   $obj_Child->render($arr_Entry);
                }
                
                $arr_Return[]   = implode('', $arr_Child);
            }
            
            $str_Return =   $this->obj_Delimiter->format($arr_Return);
            $str_Return =   $this->obj_Affix->format($str_Return);
            $str_Return =   $this->obj_Format->format($str_Return);
            
            return $str_Return;
        }
        
        private function _addChild(Interfaces\RenderingElement $obj_Child) {
            $this->arr_Child[]  =   $obj_Child;
        }
    }
?>
