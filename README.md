# Laravel Grammar
[![CircleCI](https://circleci.com/gh/djunehor/laravel-grammar.svg?style=svg)](https://circleci.com/gh/djunehor/laravel-grammar)
[![Latest Stable Version](https://poser.pugx.org/djunehor/laravel-grammar/v/stable)](https://packagist.org/packages/djunehor/laravel-grammar)
[![Total Downloads](https://poser.pugx.org/djunehor/laravel-grammar/downloads)](https://packagist.org/packages/djunehor/laravel-grammar)
[![License](https://poser.pugx.org/djunehor/laravel-grammar/license)](https://packagist.org/packages/djunehor/laravel-grammar)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/djunehor/laravel-grammar/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/djunehor/laravel-grammar/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/djunehor/laravel-grammar/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Maintainability](https://api.codeclimate.com/v1/badges/9d6be7b057103cb14410/maintainability)](https://codeclimate.com/github/djunehor/laravel-grammar/maintainability)
[![StyleCI](https://github.styleci.io/repos/223423445/shield?branch=master)](https://github.styleci.io/repos/223423445)
[![Code Coverage](https://scrutinizer-ci.com/g/djunehor/laravel-grammar/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/djunehor/laravel-grammar/?branch=master)

Laravel Grammar allows you detect the part of speech of a word. It returns an array of parts of speech a word belong to.

- [Laravel Grammar](#laravel-grammar)
    - [Installation](#installation)
        - [Laravel 5.5 and above](#laravel-55-and-above)
        - [Laravel 5.4 and older](#laravel-54-and-older)
        - [Lumen](#lumen)
    - [Usage](#usage)
        - [All parts of speech](#get-all-parts-of-speech)
        - [Get part of speech](#get-word-part-of-speech)
    - [Contributing](#contributing)

## Installation

### Step 1
You can install the package via composer:

```shell
composer require djunehor/laravel-grammar
```

#### Laravel 5.5 and above

The package will automatically register itself, so you can start using it immediately.

#### Laravel 5.4 and older

In Laravel version 5.4 and older, you have to add the service provider in `config/app.php` file manually:

```php
'providers' => [
    // ...
    Djunehor\Grammar\GrammarServiceProvider::class,
];
```
#### Lumen

After installing the package, you will have to register it in `bootstrap/app.php` file manually:
```php
// Register Service Providers
    // ...
    $app->register(Djunehor\Grammar\GrammarServiceProvider::class);
];
```

### Step 2 - Publishing files
Run:
`php artisan vendor:publish --tag=laravel-grammar`
This will move the migration file, seeder file and config file to your app. You can change the entries table name in config/laravel-grammar.php

### Step 3 - Publishing files
- Run`php artisan migrate` to create the table.
- Run `php artisan db:seed --class=LaravelGrammarSeeder` to seed table


## Usage
```php
use Djunehor\Grammar\Word;`

$grammar = new Word();
```

### Get All Parts of Speech
```php
$partsOfSpeech = $grammar->getPartsOfSpeech();
// ['Preposition', 'Noun', 'Pronoun', 'Adverb', 'Adjective', 'Verb', 'Interjection', 'Conjunction']
```

### Get Word part of Speech
```php
$word = 'boy';
$partsOfSpeech = $grammar->getWordPartOfSpeech($word);
// ['Noun']
```

### Check if is noun
```php
$word = 'boy';
$grammar = new Word($string);
$isNoun = $grammar->isNoun();
// true
```

### Using Facade
In order to use the Grammar facade:
- First add `    'Grammar' => GrammarFacade::class,` to aliases in `config/app.php`
- Then use like `\Grammar::getPartsOfSpeech();`

## Contributing
- Fork this project
- Clone to your repo
- Make your changes and run tests `composer test`
- Push and create Pull request
