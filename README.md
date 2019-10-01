# Build kit v0.1.2

## Description
A Wordpress project boilerplate for the Orange Digital development team.

## Features

### Theme based off [Sage 9 by Roots](https://roots.io/sage-9/)
* Bootstrap 4
* Laravel’s Blade as a templating engine
* Yarn + Webpack with live reload and [Browsersync](https://www.browsersync.io/)
* ES6
* PSR-2 coding standards
* A modern, restructured theme architecture with [SoberWP controllers](https://github.com/soberwp/controller)
* Font Aweseome Pro 5
* Lint with [ESLint](https://eslint.org/) and [Stylelint](https://stylelint.io)

### The most essential Wordpress plugins
* Advanced Custom Fields Pro
* Gravity Forms
* Classic Editor
* Native PHP Sessions for WordPress
* Pantheon Advanced Page Cache (for Pantheon sites)
* Post SMTP
* Redirection
* WP-CFM
* The following mu-plugins:
    * [Wordpress Essentials](https://github.com/mattpfeffer/wordpress-essentials)
    * Pantheon (for Pantheon sites)

### Seperation of content from structure
* Version controlled ACF field groups via JSON (wp-content/fields)

### Other Enhancements
* Safe SVG support
* Disabled XMLRPC and REST API for added security (can be enabled manually)
* Blocked enumeration of users

## Setup
1. Clone or copy the repository into your own project (i.e. web-my-project)
2. `chmod +x ./init.sh`
3. `./init.sh`
4. Follow the prompts

## Workflow

### Git

Follow the [Gitflow](https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow) model

#### Branches

|Branch|Description|Created from|Merged into|
|---|---|---|---|
|`master`|This is your 'good' copy or official release history. Only used to deploy code.|||
|`develop`|This branch is used for merging feature branches and testing. Don't develop directly on this branch.|`master`|`release/...`|
|`feature/...`|Each new feature or component should have it's own branch.|`develop`|`develop`|
|`release/...`|Code that needs to be released.|`develop`|`master` + `develop`|
|`hotfix/...`|When production needs to be quickly patched or updated.|`master`|`master` + `develop`|

### Developing locally with Lando

**Start and stop Lando:**

`lando start` and `lando stop`

**Import/export an existing database:**

`lando db-import database.sql` or `lando db-export database.sql`

**Search and replace strings in the database:**

`lando wp search-replace 'https://oldurl.com' 'https://newurl.com'`

**Access WP CLI**

`lando wp [command]`

### Building Scripts and Styles

#### Setup

The `init.sh` script will perform much of the initial Sage setup but on subsequent pulls, particularly when working with other developers, it may be necessary to run yarn and composer again to pull in any new dependencies. 

```
cd wp-content/themes/mytheme/
composer install 
yarn
yarn build
```

#### Commands

Use the appropriate commands:

`yarn start`            - Watches code, lints and builds on the fly. Includes browser sync and live reloading.

`yarn lint`             - Manually lints your work.

`yarn build`            - Builds static assets. Suitable for development and staging environments.

`yarn build:product`    - Builds production ready assets. Minifies files, compresses images and removes console logs etc.
