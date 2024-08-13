<?php

declare(strict_types=1);
/**
 * This file is part of HyperfAdminGenerator.
 *
 *  * @link     https://github.com/G-YDG/HyperfAdminGenerator
 *  * @license  https://github.com/G-YDG/HyperfAdminGenerator/blob/master/LICENSE
 */

namespace HyperfAdminGenerator;

class MapperGenerator extends AbstractGenerator
{
    public function qualifyClass(): string
    {
        return parent::qualifyClass() . 'Mapper';
    }

    /**
     * 获取模板文件.
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/mapper.stub';
    }

    /**
     * 获取替换占位符.
     *
     * @return string[]
     */
    protected function getReplacePlaceHolder(): array
    {
        return [
            '%NAMESPACE%',
            '%CLASS%',
            '%MODEL_NAMESPACE%',
            '%MODEL_NAME%',
        ];
    }

    /**
     * 获取替换内容.
     */
    protected function getReplaceContent(): array
    {
        return [
            $this->getNamespace(),
            $this->getClassName(),
            $this->getModelNamespace(),
            $this->getModelName(),
        ];
    }

    /**
     * 获取命名空间.
     */
    protected function getNamespace(): string
    {
        return $this->getModuleNamespace() . '\Mapper';
    }

    /**
     * 获取类名称.
     */
    protected function getClassName(): string
    {
        return $this->name . 'Mapper';
    }

    /**
     * 获取模型类命名空间.
     */
    protected function getModelNamespace(): string
    {
        return $this->getModuleNamespace() . '\Model\\' . $this->name;
    }

    /**
     * 获取模型类名称.
     */
    protected function getModelName(): string
    {
        return $this->name;
    }
}
