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
* Class to define a style to be added to the KML class
*
*/
class XML_Create_KML_Style
{
    public $type = 'style';
    public $id, $iconid, $iconhref;
}
