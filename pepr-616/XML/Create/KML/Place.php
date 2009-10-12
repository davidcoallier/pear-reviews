<?php

/**
 * Create a KML file
 *
 * Class for creating a KML file from a data source
 * and outputing it to either a file or string
 *  
 * PHP version 5
 *
 * @category     XML
 * @package      Create_KML
 * @author       Robert McLeod <hamstar[[@]]telescum.co.nz>
 * @copyright    2009 Robert McLeod
 * @license      http://www.gnu.org/copyleft/lesser.html  LGPL License 2.1
 * @version      SVN: 1.0
 *
 */

/**
 * Class to define a place to be added to the KML class
 *
 */
class XML_Create_KML_Place
{
    public $type = 'place';
    public $folder = '**[root]**';
    public $id, $name, $desc, $style, $coords;

    /**
     * Sets the folder name or empty argument sets the folder to root
     *
     * @param string
     * @access public
     */
    public function setFolder($folder = '') {
        if ($folder == '') {
            $this->folder = '**[root]**';
        } else {
            $this->folder = $folder;
        }
    }

    /**
     * Sets a CDATA surround on the given comma separated fields
     * Called without params it will CDATA the name and desc fields
     *
     * @param string
     * @access public
     */
    public function setCDATA($fields = '') {
        if ($fields = '') {
            $this->desc = '<![CDATA['.$this->desc.']]>';
            $this->name = '<![CDATA['.$this->name.']]>';
        } else {
            if(strstr($fields,',')) {
                $fields = explode(',',$fields);
                foreach($fields as $f) {
                    $this->$f = '<![CDATA['.$this->$f.']]>';
                }
            } else {
                $this->$fields = '<![CDATA['.$this->$fields.']]>';
            }
        }
    }
}
