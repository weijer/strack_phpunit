<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

namespace Strack\Phpunit\Command;

use PHPUnit\TextUI\Command as TextUICommand;
use PHPUnit\Util\Blacklist;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\Loader;
use think\Session;

class Test extends Command
{
    public function configure()
    {
        $this->setName('unit')
            ->setDescription('phpunit')
            ->ignoreValidationErrors();
    }

    public function execute(Input $input, Output $output)
    {
        //注册命名空间
        Loader::addNamespace('tests', ROOT_PATH . 'tests');

        Session::init();
        $argv = $_SERVER['argv'];
        array_shift($argv);
        array_shift($argv);
        array_unshift($argv, 'phpunit');
        Blacklist::$blacklistedClassNames = [];

        $code = (new TextUICommand())->run($argv, false);

        return $code;
    }
}
