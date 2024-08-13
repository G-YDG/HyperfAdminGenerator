<?php

declare(strict_types=1);
/**
 * This file is part of HyperfAdminGenerator.
 *
 *  * @link     https://github.com/G-YDG/HyperfAdminGenerator
 *  * @license  https://github.com/G-YDG/HyperfAdminGenerator/blob/master/LICENSE
 */

namespace HyperfAdminGenerator;

class RequestGenerator extends AbstractGenerator
{
    protected array $columns;

    public function __construct($module, $name, $columns = [])
    {
        parent::__construct($module, $name);

        $this->columns = $columns;
    }

    public function qualifyClass(): string
    {
        return parent::qualifyClass() . 'Request';
    }

    /**
     * 获取模板文件.
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/request.stub';
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
            '%SAVE_SCENE%',
            '%UPDATE_SCENE%',
            '%RULES%',
            '%ATTRIBUTES%',
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
            $this->getSaveScene(),
            $this->getUpdateScene(),
            $this->getRules(),
            $this->getAttributes(),
        ];
    }

    /**
     * 获取命名空间.
     */
    protected function getNamespace(): string
    {
        return $this->getModuleNamespace() . '\Request';
    }

    /**
     * 获取类名称.
     */
    protected function getClassName(): string
    {
        return $this->name . 'Request';
    }

    protected function getSaveScene(): string
    {
        $columns = '';
        foreach ($this->columns as $column) {
            if ($column['column_key'] == 'PRI') {
                continue;
            }
            $columns .= $this->getSceneColumn($column);
        }
        return ! empty($columns) ? substr($columns, 0, -2) : $columns;
    }

    protected function getSceneColumn($column): string
    {
        $space = '            ';
        return sprintf("%s'%s',\n", $space, $column['column_name']);
    }

    protected function getUpdateScene(): string
    {
        $columns = '';
        foreach ($this->columns as $column) {
            $columns .= $this->getSceneColumn($column);
        }
        return ! empty($columns) ? substr($columns, 0, -2) : $columns;
    }

    protected function getRules(): string
    {
        $rules = '';
        foreach ($this->columns as $column) {
            $rules .= $this->getRuleColumn($column);
        }
        return ! empty($rules) ? substr($rules, 0, -2) : $rules;
    }

    protected function getRuleColumn(array $column): string
    {
        $space = '            ';
        return sprintf(
            "%s//%s\n%s'%s' => 'required',\n",
            $space,
            $column['column_comment'],
            $space,
            $column['column_name']
        );
    }

    protected function getAttributes(): string
    {
        $attributes = '';
        foreach ($this->columns as $column) {
            $attributes .= $this->getAttributeColumn($column);
        }
        return ! empty($attributes) ? substr($attributes, 0, -2) : $attributes;
    }

    protected function getAttributeColumn(array $column): string
    {
        $space = '            ';
        return sprintf(
            "%s'%s' => '%s',\n",
            $space,
            $column['column_name'],
            $column['column_comment']
        );
    }
}
