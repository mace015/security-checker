Security-checker is a automatic tool written by [Mace Muilman](https://github.com/mace015) that runs a series of test against a domain to assert its security.

## Current implemented tests/scans:

- Server over HTTPS only.
- HSTS header.

## Documentation

To use this project, follow the following steps:

- Clone this project to a directory of choice.
- `cd` into that directory.
- Install all the dependencies via `composer install`.
- Run a scan via `php security-checker scan insert-domain-here.com`.

## Credits
**Credits where credits are due, to this amazing package:**

- Laravel Zero by [Nuno Maduro](https://github.com/nunomaduro) : [Laravel Zero](https://github.com/laravel-zero/laravel-zero)

## License

This software is open-source software licensed under the **MIT license**.
