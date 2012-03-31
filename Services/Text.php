<?php
    namespace geissler\CSLBundle\Services;

    /**
     *  .
     *
     *  @author     Benjamin Geißler <benjamin.geissler@gmail.com>
     *  @version    0.1
     * 
     *  @property   Affix   $obj_Affix
     *  @property   Format  $obj_Format
     */
    class Text implements Interfaces\RenderingElement {
        private $obj_Affix;
        private $obj_Format;
        private $str_Type;
        private $str_Value;
        private $str_Form;
        private $str_Plural;


        public function __construct() {
            $this->obj_Affix    =   new Affix();
            $this->obj_Format   =   new Format();
        }

        /**
         *  loads the formating definition
         * 
         *  @param \DOMElement $obj_Format 
         */
        public function init(\DOMElement $obj_Format) {
            $this->obj_Affix->init($obj_Format);
            $this->obj_Format->init($obj_Format);
            
            // get display value
            if (isset($obj_Format->attributes->length) == true) {
                $i_Length   =   $obj_Format->attributes->length;
                for($i = 0; $i < $i_Length; $i++) {                    
                    if (in_array($obj_Format->attributes->item($i)->name, array('variable', 'macro', 'term', 'value')) == true) {
                        $this->str_Type     =   $obj_Format->attributes->item($i)->name;
                        $this->str_Value    =   $obj_Format->attributes->item($i)->value;
                        
                        // load form and plural attributes if set
                        if ($this->str_Type == 'term') {
                            if (isset($obj_Format->attributes->item($i)->form) == true) {
                                $this->str_Form =   $obj_Format->attributes->item($i)->form;
                            }
                            
                            if (isset($obj_Format->attributes->item($i)->plural) == true) {
                                $this->str_Plural   =   $obj_Format->attributes->item($i)->plural;
                            }
                        }
                        
                        break;
                    }
                }
            }             
        }
        
        public function render($obj_Data) {
            $str_Return =   '';
            
            switch($this->str_Type) {
                case 'variable':
                    if (isset($obj_Data[$this->str_Value]) == true
                        && $obj_Data[$this->str_Value] !== '') {
                            $str_Return =   $obj_Data[$this->str_Value];
                    }
                break;    
                
                case 'value':
                    if ($this->str_Value !== '') {
                        $str_Return =   $this->str_Value;
                    }
                break;    
                
                case 'term':
                    $str_Form   =   '';
                    $str_Plural =   'single';
                    if (isset($this->str_Form) == true) {
                        $str_Form   =   $this->str_Form;
                    }
                    
                    if (isset($this->str_Plural) == true) {
                        $str_Plural =   $this->str_Plural;
                    }
                    
                    $str_Return =   Registry::getLocale()->getTerm($this->str_Value, $str_Form, $str_Plural);
                break;    
                
                case 'macro':
                    $str_Return =   Registry::getMacro($this->str_Value)->render($obj_Data);
                break;    
            }
            
            if ($str_Return !== '') {
                $str_Return =   $this->obj_Affix->format($str_Return);
                $str_Return =   $this->obj_Format->format($str_Return);
            }
            
            return $str_Return;
        }
    }
?>
