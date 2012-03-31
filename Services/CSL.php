<?php
    namespace geissler\CSLBundle\Services;
    
    /**
     *  .
     *
     *  @author     Benjamin Geißler <benjamin.geissler@gmail.com>
     *  @version    0.1
     *  @license    MIT
     */
    class CSL {
        private $obj_Citation;
        private $obj_Biblography;

        public function __construct() {
            $this->obj_Citation =   new Citation();
        }

        public function init($str_Style, $str_Language = 'de') {
            $b_Return       =   false;            
            $obj_Document   =   new \DOMDocument();

            if ($obj_Document->loadXML($str_Style) == true) {
                $b_Return   =   $this->obj_Citation->setFormat($obj_Document->getElementsByTagName('citation'));
            }
            
            return $b_Return;
        }

        public function citation($arr_Book, $arr_Citation) {
            
        }
        
        public function bibliography($arr_Book) {
            
        }
    }
?>
