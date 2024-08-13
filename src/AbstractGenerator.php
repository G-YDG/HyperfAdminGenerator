<?php

declare(strict_types=1);
/**
 * This file is part of HyperfAdminGenerator.
 *
 *  * @link     https://github.com/G-YDG/HyperfAdminGenerator
 *  * @license  https://github.com/G-YDG/HyperfAdminGenerator/blob/master/LICENSE
 */

namespace HyperfAdminGenerator;

use Hyperf\CodeParser\Project;
use Hyperf\Stringable\Str;

abstract class AbstractGenerator implements GeneratorInterface
{
    protected string $module;

    protected string $name;

    public function __construct($module, $name)
    {
        $this->module = Str::studly(trim($module));
        $this->name = Str::studly(trim($name));
    }

    /**
     * 生成类文件.
     */
    public function generator(): void
    {
        $path = $this->getPath($this->qualifyClass());
        $this->makeDirectory($path);
        file_put_contents($path, $this->preview());
    }

    /**
     * 预览生成内容.
     */
    public function preview(): string
    {
        $stub = file_get_contents($this->getStub());

        return str_replace(
            $this->getReplacePlaceHolder(),
            $this->getReplaceContent(),
            $stub
        );
    }

    /**
     * 获取类路径.
     */
    protected function getPath(string $name): string
    {
        $project = new Project();
        return BASE_PATH . '/' . $project->path($name);
    }

    protected function qualifyClass(): string
    {
        $name = ltrim($this->name, '\/');

        $name = str_replace('/', '\\', $name);

        return $this->getNamespace() . '\\' . $name;
    }

    /**
     * 获取命名空间.
     */
    abstract protected function getNamespace(): string;

    /**
     * 创建目录.
     */
    protected function makeDirectory(string $path): string
    {
        if (! is_dir(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        return $path;
    }

    /**
     * 获取模板文件.
     */
    abstract protected function getStub(): string;

    /**
     * 获取替换占位符.
     */
    abstract protected function getReplacePlaceHolder(): array;

    /**
     * 获取替换内容.
     */
    abstract protected function getReplaceContent(): array;

    /**
     * 获取控制器类名称.
     */
    abstract protected function getClassName(): string;

    /**
     * 获取模块命名空间.
     */
    protected function getModuleNamespace(): string
    {
        return 'App\\' . $this->module;
    }
}
