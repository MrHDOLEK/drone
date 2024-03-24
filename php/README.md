# Drone

---
# Development setup with Docker

## List all commands in the makefile

- `make help`

### Dependencies

- Docker installation

### Setup

Run `make install` or follow the steps below:

- build and run containers:

        make install
        make start

### Running tests

- run PHP tests: `composer test` or `make test` with docker setup

### Code style

- list PHP-CS-Fixer linting issues: `composer cs:check`
- fix linting issues: `composer cs:fix`  or `make cs-fix` with docker

### Static analysis

- run phpstan: `composer phpstan` or `make phpstan` with docker

### Pull Requests

When creating a pull request, we enforce a specific title format using [blumilksoftware/action-pr-title](https://github.com/blumilksoftware/action-pr-title) github action. The rules are:

- `#123 - Some PR title` - for PRs that deal with a specific issue, where `123` is the issue number
- `- Some PR title` - for PRs that don't have a related issue