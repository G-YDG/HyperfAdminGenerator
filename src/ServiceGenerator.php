<?php

declare(strict_types=1);
/**
 * This file is part of HyperfAdminGenerator.
 *
 *  * @link     https://github.com/G-YDG/HyperfAdminGenerator
 *  * @license  https://github.com/G-YDG/HyperfAdminGenerator/blob/master/LICENSE
 */

namespace HyperfAdminGenerator;

class ServiceGenerator extends AbstractGenerator
{
    public function qualifyClass(): string
    {
        return parent::qualifyClass() . 'Service';
    }

    /**
     * 获取模板文件.
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/service.stub';
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
            '%MAPPER_NAMESPACE%',
            '%MAPPER_NAME%',
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
            $this->getMapperNamespace(),
            $this->getMapperName(),
        ];
    }

    /**
     * 获取命名空间.
     */
    protected function getNamespace(): string
    {
        return $this->getModuleNamespace() . '\Service';
    }

    /**
     * 获取控制器类名称.
     */
    protected function getClassName(): string
    {
        return $this->name . 'Service';
    }

    /**
     * 获取Mapper类命名空间.
     */
    protected function getMapperNamespace(): string
    {
        return $this->getModuleNamespace() . '\Mapper\\' . $this->name . 'Mapper';
    }

    /**
     * 获取Mapper类名称.
     */
    protected function getMapperName(): string
    {
        return $this->name . 'Mapper';
    }
}
