
# [HyperfAdminGenerator](https://github.com/G-YDG/HyperfAdminGenerator)

📦 Hyperf Admin Code Generator

# Install

```bash
composer require ydg/hyperf-admin-generator
```

# Usage

## Generator Mapper

```php
<?php

use HyperfAdminGenerator\MapperGenerator;

(new MapperGenerator('your module', 'your table name'))->generator();

```

## Generator Service

```php
<?php

use HyperfAdminGenerator\ServiceGenerator;

(new ServiceGenerator('your module', 'your table name'))->generator();

```

## Generator Controller

```php
<?php

use HyperfAdminGenerator\ControllerGenerator;

(new ControllerGenerator('your module', 'your table name'))->generator();

```

## Generator Controller with more annotation

```php
<?php

use HyperfAdminGenerator\ControllerGenerator;

(new ControllerGenerator('your module', 'your table name', 'your annotation class'))->generator();

```

example:

```php
<?php

use HyperfAdminGenerator\ControllerGenerator;
use App\Annotation\Auth;

$moduleName = 'System';

$tableName = 'system_user';

(new ControllerGenerator($moduleName, $tableName, Auth:class))->generator();

```

## Generator Request

```php
<?php

use HyperfAdminGenerator\MapperGenerator;

(new RequestGenerator('your module', 'your table name'))->generator();

```

## Generator Request with Columns

```php
<?php

use HyperfAdminGenerator\MapperGenerator;

(new RequestGenerator('your module', 'your table name', 'your table columns'))->generator();

```

example in hyperf:

```php
<?php

use HyperfAdminGenerator\MapperGenerator;
use Hyperf\Database\ConnectionResolverInterface;

$moduleName = 'System';

$tableName = 'system_user';

$resolver = container()->get(ConnectionResolverInterface::class);

$columns = $resolver->connection()->getSchemaBuilder()->getColumnTypeListing($tableName);

(new RequestGenerator($moduleName, $tableName, $columns))->generator();

```