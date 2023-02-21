Layout for onepiece-framework
===

# File location

 The layout is placed in the following directory.

```
asset:/layout/
```

 The layout uses a common template files.

```
asset:/template/layout/
```

 Set the config file in the following path.

```
asset:/config/layout.php
```

# Usage

## Download from URL

```sh
git submodule add -b BRANCH_NAME URL asset/layout/LAYOUT_NAME
```

## Configuration

```asset/config/layout.php
return [
  'name' => 'LAYOUT_NAME';
];
```

## Dynamic layout switch

 How to dynamic switch templates.

```php
OP()->Config('layout', ['name'=>'layout_name']);
```
