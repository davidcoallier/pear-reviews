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
 * Main class to add items to and create the KML
 *
 */
class XML_Create_KML
{
    /**
    * The array of styles
    *
    * @var array
    * @access protected
    */
    protected $styles = array();

    /**
    * The array of places in their folders
    *
    * @var array
    * @access protected
    */
    protected $folders = array();

    /**
    * Print the content header for a KML file or optionally an XML file
    * (so it can be viewed in a browser)
    *
    * @param bool
    * @access public
    */
    public function printHeader($xml = false)
    {
        if ($xml == false {
            header('Content-type: application/vnd.google-earth.kml+xml');
        } else {
            header('Content-type: text/xml');
        }
    }

    /**
    * Adds an item to the KML data
    *
    * @param object
    * @access public
    * @return bool
    */
    public function addItem($item)
    {
        if (!$item
            || gettype($item) != 'object'
            || $item->type != 'style'
            && $it array();

    /**
    * Print the content header for a KML file or optionally an XML file
    * (so it can be viewed in a browser)
    *
    * @param bool
    * @access public
    */
    public function printHeader($xml = false)
    {
        if ($xml == false {
            header('Content-type: application/vnd.google-earth.kml = $item;
                break;
           
            default:
                return false;
                break;
        }
        return true;
    }

    /**
    * Creates the file under the filename given with the KML code
    *
    * @param string     filename
    * @access public
    * @return bool
    */
    public function save($filename)
    {
        if (!$filename) {
            return false;
        }
   
        return file_put_contents($filename, $this->create());
    }

    /**
    * Creates the KML code from data given
    *
    * @access public
    * @return string
    */
    public function create()
    {

        // Set some tabs
        function pad($num, $str) {
            return str_pad($str,$num,"\t",STR_PAD_LEFT);
        }

        // Set the xml version and open the kml and document
        $kml[] = '<?xml version="1.0" encoding="UTF-8"?>';
        $kml[] = '<kml xmlns = "http://earth.google.com/kml/2.1">';
        $kml[] = pad(1, '<Document>');
   
        // Set all the styles for the document
        foreach ($this->styles as $s) {
            $kml[] = pad(2, '<Style id="'.$s->id.'">');
            $kml[] = pad(3, '<IconStyle id="'.$s->iconid.'">');
            $kml[] = pad(3, '<Icon>');
            $kml[] = pad(4, '<href>'.$s->iconhref.'</href>');
            $kml[] = pad(3, '</Icon>');
            $kml[] = pad(3, '</IconStyle>');
            $kml[] = pad(2, '</Style>');
        }
   
        // Set all the folders and places in each folder
        foreach ($this->folders as $f => $places) {
            if ($f != '**[root]**') {
                // Set the folder and folder name
                $kml[] = pad(2, '<Folder>');
                $kml[] = pad(3, "<name>$f</name>");
                $kml[] = pad(3, '<open>0</open>');
           
                // Set all the placemarks in this folder
                foreach ($places as $p) {
                    $kml[] = pad(3, '<Placemark id="'.$p->id.'">');
                    $kml[] = pad(4, '<name>'.$p->name.'</name>');
                    $kml[] = pad(4, '<description>'.$p->desc.'</description>');
                    $kml[] = pad(4, '<styleUrl>'.$p->style.'</styleUrl>');
                    $kml[] = pad(4, '<Point>');
                    $kml[] = pad(5, '<coordinates>'.$p->coords.'</coordinates>');
                    $kml[] = pad(4, '</Point>');
                    $kml[] = pad(3, '</Placemark>');
                }
           
                // Close the folder
                $kml[] = pad(2, '</Folder>');
            }
        }
   
        // Set all the root placemarks so they are not in a folder
        foreach($this->folders['**[root]**'] as $p) {
            // Set all the placemarks in the root folder
            foreach ($places as $p) {
                $kml[] = pad(2, '<Placemark id="'.$p->id.'">');
                $kml[] = pad(3, '<name>'.$p->name.'</name>');
                $kml[] = pad(3, '<description>'.$p->desc.'</description>');
                $kml[] = pad(3, '<styleUrl>'.$p->style.'</styleUrl>');
                $kml[] = pad(3, '<Point>');
                $kml[] = pad(4, '<coordinates>'.$p->coords.'</coordinates>');
                $kml[] = pad(3, '</Point>');
                $kml[] = pad(2, '</Placemark>');
            }
        }
   
        // End the document and kml
        $kml[] = pad(1, '</Document>');
        $kml[] = '</kml>';

        // Return the string of KML data
        return join("\n", $kml);
    }

    /**
    * Clears all the data to free up memory
    *
    * @access public
    */
    public function clear()
    {
        $this->folders = null;
        $this->styles = null;
    }
}

