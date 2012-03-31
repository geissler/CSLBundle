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
    class Locale {
        private $arr_Term;
        private $arr_DateText;
        private $arr_DateNumeric;
        private $b_Punctiation;
        private $str_Path;
        private $arr_Base;

        /**
         *   
         */
        public function __construct() {
            $this->arr_Term         =   array();
            $this->arr_DateText     =   array();
            $this->arr_DateNumeric  =   array();
            $this->b_Punctiation    =   false;
            
            $this->str_Path =   dirname(__FILE__) . '/locale/locales-';
            $this->arr_Base =   array(
                                    'af' => 'af-ZA',
                                    'ar' => 'ar-AR',
                                    'bg' => 'bg-BG',
                                    'ca' => 'ca-AD',
                                    'cs' => 'cs-CZ',
                                    'da' => 'da-DK',
                                    'de' => 'de-DE',
                                    'el' => 'el-GR',
                                    'en' => 'en-GB',
                                    'en' => 'en-US',
                                    'es' => 'es-ES',
                                    'et' => 'et-EE',
                                    'fa' => 'fa-IR',
                                    'fi' => 'fi-FI',
                                    'fr' => 'fr-FR',
                                    'he' => 'he-IL',
                                    'hu' => 'hu-HU',
                                    'is' => 'is-IS',
                                    'it' => 'it-IT',
                                    'ja' => 'ja-JP',
                                    'km' => 'km-KH',
                                    'ko' => 'ko-KR',
                                    'mn' => 'mn-MN',
                                    'nb' => 'nb-NO',
                                    'nl' => 'nl-NL',
                                    'nn' => 'nn-NO',
                                    'pl' => 'pl-PL',
                                    'pt' => 'pt-PT',
                                    'ro' => 'ro-RO',
                                    'ru' => 'ru-RU',
                                    'sk' => 'sk-SK',
                                    'sl' => 'sl-SI',
                                    'sr' => 'sr-RS',
                                    'sv' => 'sv-SE',
                                    'th' => 'th-TH',
                                    'tr' => 'tr-TR',
                                    'uk' => 'uk-UA',
                                    'vi' => 'vi-VN',
                                    'zh' => 'zh-CN');
        }

        /**
         *  loads the locale translation. If file does not exists, en-US translation will be loaded.
         * 
         *  @param  string  $str_Language   language (de-De, or en)
         *  @return boolean 
         */
        public function load($str_Language) {
            $b_Return       =   false;
            $str_Content    =   $this->_readFile($str_Language);
            
            if ($str_Content !== '') {
                $b_Return   =   $this->_parseXML($this->_loadXML($str_Content));
            } 
            
            return $b_Return;
        }

        /**
         *  loads the locale translation from the given XML.
         * 
         *  @param  string  $str_Content    XML content
         *  @return boolean
         */
        public function loadContent($str_Content) {            
            return $this->_parseXML($this->_loadXML($str_Content));;
        }

        /**
         *  returns the value of the term.
         * 
         *  @param  string  $str_Name   the name
         *  @param  string  $str_Form   the form to load, optional
         *  @param  string  $str_Plural single or multiple, optional
         *  @return string
         */
        public function getTerm($str_Name, $str_Form = '', $str_Plural = false) {
            $str_Return =   '';
            $i_Length   =   count($this->arr_Term);
            
            for($i = 0; $i < $i_Length; $i++) {
                if ($this->arr_Term[$i]['name'] == $str_Name) {
                    if ((isset($this->arr_Term[$i]['form']) == true
                            && $this->arr_Term[$i]['form'] == $str_Form)
                        || (isset($this->arr_Term[$i]['form']) == false
                            && $str_Form == '')) {
                                if ($str_Plural == false
                                    && isset($this->arr_Term[$i]['single']) == true) {
                                        $str_Return =   $this->arr_Term[$i]['single'];
                                }
                                else if ($str_Plural == true
                                    && isset($this->arr_Term[$i]['multiple']) == true) {
                                        $str_Return =   $this->arr_Term[$i]['multiple'];
                                }
                                else {
                                    $str_Return =   $this->arr_Term[$i]['value'];
                                }
                                
                                break;
                    }
                }
            }
            
            // if nothing found, load no form
            if ($str_Return == ''
                && $str_Form !== '') {
                    $str_Return =   $this->getTerm($str_Name, '', $str_Plural);
            }
            
            return $str_Return;
        }
        
        public function getDate($str_Name, $str_Form) {
            
        }
        
        /**
         *  access the style-options punctuation-in-quote
         * 
         *  @return boolean
         */
        public function getPunctuation() {
            return $this->b_Punctiation;
        }
        
        /**
         *  get content of xml file
         * 
         *  @param  string  $str_Language
         *  @return string
         */
        private function _readFile($str_Language) {
            $str_Content    =   '';
            
            if (file_exists($this->str_Path . $str_Language . '.xml') == true) {
                $str_Content    =   file_get_contents($this->str_Path . $str_Language . '.xml');
            }
            else if (in_array($str_Language, array_keys($this->arr_Base)) == true
                && file_exists($this->str_Path . $this->arr_Base[$str_Language] . '.xml') == true) {
                    $str_Content    =   file_get_contents($this->str_Path . $this->arr_Base[$str_Language] . '.xml');                
            }
            else if (file_exists($this->str_Path . 'en-US.xml') == true) {
                $str_Content    =   file_get_contents($this->str_Path . 'en-US.xml');
            }
            
            return $str_Content;
        }
        
        /**
         *  creates a \SimpleXMLElement object
         * 
         *  @param  string  $str_Content    XML Content
         *  @return boolean|\SimpleXMLElement 
         */
        private function _loadXML($str_Content) {
            try {
                return new \SimpleXMLElement($str_Content);
            } catch (Exception $obj_Exeption) {
                return false;
                echo $obj_Exeption->getTraceAsString();
            }            
        }
        
        /**
         *  parses the XML and reads the locale attributes
         * 
         *  @param  \SimpleXMLElement   $obj_XML
         *  @return boolean 
         */
        private function _parseXML(\SimpleXMLElement $obj_XML) {
            $b_Return   =   false;
            
            foreach($obj_XML as $obj_Node) {
                switch($obj_Node->getName()) {
                    case 'style-options':
                        foreach($obj_Node->attributes() as $mix_Value) {
                            if ((string) $mix_Value == 'false') {
                                $this->b_Punctiation    =   false;
                            }
                            else {
                                $this->b_Punctiation    =   true;
                            }
                        }                            
                    break;

                    case 'terms':
                        foreach($obj_Node->children() as $obj_Child) {
                            $arr_Child  =   array('value' => (string) $obj_Child);

                            foreach($obj_Child->attributes() as $str_Key => $mix_Value) {                                    
                                $arr_Child[$str_Key]    =   (string) $mix_Value;
                            }

                            foreach($obj_Child->children() as $obj_Sub) {
                                $arr_Child[$obj_Sub->getName()] =   (string) $obj_Sub;
                            }

                            $this->arr_Term[]   =   $arr_Child;
                        }
                    break;

                    case 'date':
                        foreach($obj_Node->attributes() as $str_Form) {

                        }
                    break;
                }                    
            }
            
            if (count($this->arr_Term) > 0
                || count($this->arr_DateNumeric) > 0
                || count($this->arr_DateText) > 0) {
                    $b_Return   =   true;
            }
            
            return $b_Return;
        }
    }
?>
