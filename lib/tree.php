<?php

/**
 * @package lib
 */

class Dtree
{
    protected $i = 0;
    protected $j = 0;
    protected $path = array('0');
    protected $name = 'dtree';
    protected $output = array();
    public $config = array(
        'useIcons' => false,
        'useLines' => false,
        'useCookies' => true,
        'useSelection' => false,
    );

    /**
     * construct 
     * 
     * @param string $name   tree name
     * @param array  $config see $config
     * 
     * @return null
     *
     * @issue 2763
     */
    public function __construct($name = 'd', $config = array()) {
        $this->name = $name;
        $this->config = array_merge($this->config, $config);
    }

    /**
     * leaf 
     * 
     * @param string $text leaf name
     * @param string $url  leaf url
     * 
     * @return object       
     *
     * @issue 2763
     */
    public function leaf($text, $url) {
        $this->output [] = sprintf('%s.add(%s, %s, "%s", "%s")', $this->name, $this->i . str_pad(++$this->j, 3, "0", STR_PAD_LEFT), $this->i, $text, $url);
    }

    /**
     * node
     * 
     * @param string $text   node name
     * @param string $pathTo path
     * @param string $level  level
     * @param string $url    node url
     * 
     * @return array         
     *
     * @issue 2763
     */
    public function node($text, $pathTo = '0', $level = '1', $url = '') {
        $this->i++;
        if ($pathTo == '-1') {
            array_splice($this->path, -$level);
        } elseif ($pathTo == '1') {
            array_push($this->path, $this->i - 1);
        }

        if (empty($this->path)) {
            $this->path[] = 0;
        }
        $this->output [] = sprintf('%s.add(%s, %s, "%s", "%s")', $this->name, $this->i, $this->path[count($this->path) - 1], $text, $url);
    }

    /**
     * get root path
     * 
     * @return object
     *
     * @issue 2763
     */
    public function returnRoot() {
        return $this->path = array('0');
    }

    /**
     * toString function
     * 
     * @return string 
     *
     * @issue 2763
     */
    public function __toString() {
        $output = array();
        $output [] = sprintf('%s = new dTree("%s")', $this->name, $this->name);
        $output [] = sprintf('%s.config.useIcons = %s;', $this->name, $this->config['useIcons'] ? 'true' : 'false');
        $output [] = sprintf('%s.config.useLines = %s;', $this->name, $this->config['useLines'] ? 'true' : 'false');
        $output [] = sprintf('%s.config.useCookies = %s;', $this->name, $this->config['useCookies'] ? 'true' : 'false');
        $output [] = sprintf('%s.config.useSelection = %s;', $this->name, $this->config['useSelection'] ? 'true' : 'false');
        $output [] = sprintf('%s.add(0, -1, "");', $this->name);
        foreach ($this->output as $line) {
            $output [] = $line;
        }
        $output [] = sprintf('document.write(%s);', $this->name);
        return implode(PHP_EOL, $output);
    }

}