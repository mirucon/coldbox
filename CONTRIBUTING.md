## Contributing to the Coldbox theme

Thanks for contributing to the Coldbox theme! I always welcome any contributions for the project. There are only a few things to know before contributing.

## Coding Standards

This project follows the [WordPress Coding Standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/) **for PHP** codes.  

For JavaScript files, I use [Standard Style](https://github.com/standard/eslint-config-standard) and [Prettier](https://github.com/prettier/prettier).

I don't currently use any standards for the SCSS files. 

## Running the linters

Please make sure that no errors are reported by the linters before submitting a PR.

### PHP
```bash
$ composer lint
```
To auto-fix your problems:
```bash
$ composer fix
```
### JavaScript
```bash
$ yarn lint
```
To auto-fix your problems:
```bash
$ yarn fix
```

## Transpile JS/SCSS files

I use Webpack for transpiling JavaScript and SCSS files.

Run the following command to watch your changes:

```bash
$ yarn watch
```
## Bottom Line

These are all you need to know. If you need help, as always please let me know so that I can help.
