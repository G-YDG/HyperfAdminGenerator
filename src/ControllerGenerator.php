<?php

declare(strict_types=1);
/**
 * This file is part of HyperfAdminGenerator.
 *
 *  * @link     https://github.com/G-YDG/HyperfAdminGenerator
 *  * @license  https://github.com/G-YDG/HyperfAdminGenerator/blob/master/LICENSE
 */

namespace HyperfAdminGenerator;

use Hyperf\Stringable\Str;
use function Hyperf\Support\class_basename;

class ControllerGenerator extends AbstractGenerator
{
    protected ?string $annotation;

    public function __construct($module, $name, $annotation = null)
    {
        parent::__construct($module, $name);

        $this->annotation = $annotation;
    }

    /**
     * 获取模板文件.
     */
    protected function getStub(): string
    {
        if (!empty($this->authClass)) {
            return __DIR__ . '/stubs/controller-annotation.stub';
        }
        return __DIR__ . '/stubs/controller.stub';
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
            '%SERVICE_NAMESPACE%',
            '%REQUEST_NAMESPACE%',
            '%ANNOTATION_NAMESPACE%',
            '%ANNOTATION_NAME%',
            '%ROUTE%',
            '%SERVICE_NAME%',
            '%REQUEST_NAME%',
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
            $this->getServiceNamespace(),
            $this->getRequestNamespace(),
            $this->getAnnotationNamespace(),
            $this->getAnnotationName(),
            $this->getControllerRoute(),
            $this->getServiceName(),
            $this->getRequestName(),
        ];
    }

    /**
     * 获取类命名空间.
     */
    protected function getNamespace(): string
    {
        return $this->getModuleNamespace() . '\Controller';
    }

    /**
     * 获取类名称.
     */
    protected function getClassName(): string
    {
        return $this->name . 'Controller';
    }

    /**
     * 获取服务类命名空间.
     */
    protected function getServiceNamespace(): string
    {
        return $this->getModuleNamespace() . '\Service\\' . $this->name . 'Service';
    }

    /**
     * 获取验证器命名空间.
     */
    protected function getRequestNamespace(): string
    {
        return $this->getModuleNamespace() . '\Request\\' . $this->name . 'Request';
    }

    protected function getAnnotationNamespace()
    {
        if (empty($this->annotation)) {
            return '';
        }
        return $this->annotation;
    }

    protected function getAnnotationName(): string
    {
        if (empty($this->annotation)) {
            return '';
        }
        return class_basename($this->annotation);
    }

    /**
     * 获取控制器路由.
     */
    protected function getControllerRoute(): string
    {
        return sprintf(
            '%s/%s',
            Str::lcfirst($this->module),
            Str::lcfirst($this->name)
        );
    }

    /**
     * 获取服务类名称.
     */
    protected function getServiceName(): string
    {
        return $this->name . 'Service';
    }

    /**
     * 获取验证器名称.
     */
    protected function getRequestName(): string
    {
        return $this->name . 'Request';
    }

    protected function qualifyClass(): string
    {
        return parent::qualifyClass() . 'Controller';
    }
}
