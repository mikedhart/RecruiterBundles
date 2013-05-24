<?php

namespace Recruiter\CommonBundle\Services;

/**
 * Generic Data Exporter
 *
 * @author: Mike Hart
 * @copyright: Smaller Earth Tech Ltd
 * @version: 0.1
 */
class CsvExporter
{
    /**
     * Holds the value of what the csv fields will be terminated by.
     * @var array 
     */
    protected $data = array();
    
    /**
     * Holds the value of what fields will be terminated by.
     * @var string 
     */
    protected $fieldTerminator = ',';
    
    /**
     * Holds the value of what the fields will be encapsulated by.
     * @var string 
     */
    protected $fieldEncapsulator = "\"";
    
    /**
     * Holds the value of what a line will be terminated by.
     * @var string
     */
    protected $lineBreaker = "\n";
    
    /**
     * If the mode is development, data will be echoed.
     * If the mode is production, data will be exported.
     * @var string 
     */
    protected $operationMode = "production";
    
    /**
     * Holds the string which will be exported.
     * @var string 
     */
    protected $exportString;
    
    /**
     * Holds the values of the column headers.
     * @var array 
     */
    protected $columnHeaders = array();
    
    /**
     * Holds the values of the headers in string format.
     * @var string
     */
    protected $headersString;


    /**
     * Add a row to the exporter.
     * @param type $data 
     */
    public function addRow(array $data)
    {
        array_push($this->data, $data);
    }
    
    /**
     * Perform the actual export.
     */
    public function doExport()
    {
        // If the operation mode is production, force the csv file to be downloaded.
        if($this->operationMode === "production"){
        	$filename = $_SERVER["DOCUMENT_ROOT"] . "/tmp/file.csv";
            header("Content-type: application/csv");
            header("Content-Disposition: attachment; filename={$filename}");
            header("Pragma: no-cache");
            header("Expires: 0");
        }
        
        foreach($this->columnHeaders as $header){
            $this->headersString .= $this->fieldEncapsulator;
            $this->headersString .= $header;
            $this->headersString .= $this->fieldEncapsulator;
            $this->headersString .= $this->fieldTerminator;
        }

        // Loop through each of the rows and columns.
        foreach($this->data as $row){
            foreach($row as $col){
                $this->exportString .= $this->fieldEncapsulator;
                $this->exportString .= $col;
                $this->exportString .= $this->fieldEncapsulator;
                $this->exportString .= $this->fieldTerminator;
            }

            $this->exportString = substr($this->exportString, 0, strlen($this->exportString)-1);
            $this->exportString .= $this->lineBreaker;
        }
        
        // Trim the final comma from the export string.
        $headers = substr($this->headersString, 0, strlen($this->headersString)-1);
        //$export = substr($this->exportString, 0, strlen($this->exportString)-2);

        // Echo the data.
        print $headers;
        print $this->lineBreaker;
        print $this->exportString;
        die;
    }
    
    /**
     * Sets the column headers.
     * @param array $headers 
     */
    public function setColumnHeaders(array $headers)
    {
        $this->columnHeaders = $headers;
    }
}
