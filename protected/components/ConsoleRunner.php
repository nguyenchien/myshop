<?php

/**
 * ConsoleRunner - a component for running console commands on background.
 *
 * Usage:
 * ```
 * ...
 * $cr = new ConsoleRunner(['file' => '@my/path/to/yii', 'php' => 'c:\path\to\php.exe']);
 * $cr->run('controller action param1 param2 ...');
 * ...
 * ```
 * ...
 *
 * ConsoleRunner::console()->run('sitemap index')
 * 
 * ```
 */
class ConsoleRunner
{
    /**
     * @var string Console application file that will be executed.
     * Usually it can be `yii` file.
     */
    public $file = 'D:\wamp\www\kimono_optimze_frontend\protected\yiic';

    /**
     * @var string PHP executable including full path
     * Needed because PHP_BINDIR and PHP_BINARY do not work properly under Windows
     */
    public $php = 'D:\wamp\bin\php\php5.5.12\php.exe';
    
	public $_waiting_command = false;
	
	private static $_console = array();
	
    /**
     * @inheritdoc
     */
    public function __construct($config = array())
    {	
		if (!$this->isWindows()) { // for Linux
			$this->file = dirname(dirname(__FILE__)).'/yiic';
		}
		
        if (!empty($config['file'])){
            $this->file = $config['file'];
        }
		
        if (($this->isWindows() === true) && !empty($config['php'])){
            $this->php = $config['php'];
        }
		
		if (!empty($config['waiting_command'])) {
			$this->_waiting_command = $config['waiting_command'];
		}
    }

    /**
     * Running console command on background
     *
     * @param string $cmd Argument that will be passed to console application
     * @return boolean
     */
    public function run($cmd)
    {		
        if ($this->isWindows() === true)
		{
            $cmd = $this->php . ' ' . $this->file . ' ' . $cmd;
        } else {
            $cmd = PHP_BINDIR . '/php ' . $this->file . ' ' . $cmd;
			
			if ($this->_waiting_command) {
				exec($cmd);
			} else {
				pclose(popen($cmd . ' > /dev/null &', 'r'));
			}
        }
		
        return true;
    }

    /**
     * Check operating system
     *
     * @return boolean true if it's Windows OS
     */
    protected function isWindows()
    {
        if (PHP_OS == 'WINNT' || PHP_OS == 'WIN32')
		{
            return true;
        } else
		{
            return false;
        }
    }
	
	public static function console($config = array(),$className=__CLASS__){
		if(isset(self::$_console[$className]))
			return self::$_console[$className];
		else
		{
			$console = self::$_console[$className] = new ConsoleRunner($config);
			return $console;
		}
	}
}