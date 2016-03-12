# Yii-Wikipedia

### Installation

Begin by installing this package through Composer.

```js
{
    "require": {
        "thewulf7/wikipedia": "dev-master"
    }
}
```

```php
    'components' => [
        ...
        'wikipedia' => [
            'class' => 'thewulf7\Wikipedia\Connection'
        ]
        ...
    ]
```

### Usage

**Retrieve page extract**

```php
$wiki = \Yii::$app->get('wikipedia');
    
return $wiki->createCommand()->search('Rome')->getSentences(5);
```

**Same with QueryBuilder**

```php
$query = new \thewulf7\Wikipedia\Query();

$query
    ->titles('Rome');

return $query
    ->createCommand()
    ->getSentences(5);
```
     