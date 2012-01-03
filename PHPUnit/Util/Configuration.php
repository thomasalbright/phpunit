<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2001-2012, Sebastian Bergmann <sebastian@phpunit.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHPUnit
 * @subpackage Util
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2001-2012 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 3.2.0
 */

/**
 * Configuration for PHPUnit test execution.
 * 
 * @package    PHPUnit
 * @subpackage Util
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2001-2012 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 3.2.0
 */
class PHPUnit_Util_Configuration implements ArrayAccess
{
    /**
     * @var array
     */
    protected $configuration = array(
      'addUncoveredFilesFromWhitelist' => TRUE,
      'backupGlobals' => TRUE,
      'backupStaticAttributes' => FALSE,
      'blacklist' => array(
        'include' => array(
          'directory' => array(),
          'file' => array()
        ),
        'exclude' => array(
          'directory' => array(),
          'file' => array()
        )
      ),
      'bootstrap' => FALSE,
      'cacheTokens' => TRUE,
      'colors' => FALSE,
      'convertErrorsToExceptions' => TRUE,
      'convertNoticesToExceptions' => TRUE,
      'convertWarningsToExceptions' => TRUE,
      'filter' => FALSE,
      'forceCoversAnnotation' => FALSE,
      'groups' => array(
        'include' => array(),
        'exclude' => array()
      ),
      'listeners' => array(),
      'logIncompleteSkipped' => FALSE,
      'mapTestClassNameToCoveredClassName' => FALSE,
      'php' => array(
        'include_path' => array(),
        'ini' => array(),
        'const' => array(),
        'var' => array(),
        'env' => array(),
        'post' => array(),
        'get' => array(),
        'cookie' => array(),
        'server' => array(),
        'files' => array(),
        'request' => array()
      ),
      'printerClass' => FALSE,
      'printerFile' => FALSE,
      'processIsolation' => FALSE,
      'repeat' => FALSE,
      'reportCharset' => 'UTF-8',
      'reportHighlight' => FALSE,
      'reportHighLowerBound' => 70,
      'reportLowUpperBound' => 35,
      'reportYUI' => TRUE,
      'stopOnError' => FALSE,
      'stopOnFailure' => FALSE,
      'stopOnIncomplete' => FALSE,
      'stopOnSkipped' => FALSE,
      'strict' => FALSE,
      'testSuiteLoaderClass' => FALSE,
      'testSuiteLoaderFile' => FALSE,
      'timeoutForSmallTests' => 1,
      'timeoutForMediumTests' => 10,
      'timeoutForLargeTests' => 60,
      'verbose' => FALSE,
      'whitelist' => array(
        'include' => array(
          'directory' => array(),
          'file' => array()
        ),
        'exclude' => array(
          'directory' => array(),
          'file' => array()
        )
      )
    );

    /**
     * @var array
     */
    protected $configurationFiles = array();

    /**
     * @var PHPUnit_Util_Configuration
     */
    private static $instance;

    /**
     * The new operator is not supported for this class.
     */
    private final function __construct()
    {
    }

    /**
     * The clone operator is not supported for objects of this class.
     */
    private final function __clone()
    {
    }

    /**
     * The serialize() function is not supported for objects of this class.
     */
    private final function __sleep()
    {
    }

    /**
     * The unserialize() function is not supported for objects of this class.
     */
    private final function __wakeup()
    {
    }

    /**
     * Returns the unique PHPUnit configuration object.
     *
     * @return PHPUnit_Util_Configuration
     */
    public static function getInstance()
    {
        if (self::$instance === NULL) {
            self::$instance = new PHPUnit_Util_Configuration;
        }

        return self::$instance;
    }

    /**
     * Adds a filename to the list of loaded configuration files.
     *
     * @param string $filename
     */
    public function addConfigurationFile($filename)
    {
        $this->configurationFiles[] = realpath($filename);
    }

    /**
     * Returns the configuration files loaded.
     *
     * @return array
     */
    public function getConfigurationFiles()
    {
        return $this->configurationFiles;
    }

    /**
     * Implementation of ArrayAccess::offsetGet().
     *
     * @param  mixed $offset
     * @return mixed
     * @see    http://php.net/ArrayAccess
     */
    public function offsetGet($offset) {
        if (isset($this->configuration[$offset])) {
            return $this->configuration[$offset];
        }
    }

    /**
     * Implementation of ArrayAccess::offsetSet().
     *
     * @param  mixed $offset
     * @param  mixed $value
     * @return mixed
     * @throws PHPUnit_Framework_Exception
     * @see    http://php.net/ArrayAccess
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === NULL) {
            throw new PHPUnit_Framework_Exception('Invalid configuration key.');
        }

        $this->configuration[$offset] = $value;
    }

    /**
     * Implementation of ArrayAccess::offsetUnset().
     *
     * @param mixed $offset
     * @see   http://php.net/ArrayAccess
     */
    public function offsetUnset($offset) {
        if (array_key_exists($offset, $this->configuration)) {
            unset($this->configuration[$offset]);
        }
    }

    /**
     * Implementation of ArrayAccess::offsetExists().
     *
     * @param  mixed $offset
     * @return boolean
     * @see    http://php.net/ArrayAccess
     */
    public function offsetExists($offset) {
        return array_key_exists($offset, $this->configuration);
    }
}
