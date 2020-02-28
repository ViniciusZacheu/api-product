# Treinamento API

## Setup

### Pre-requisites:

* Docker
* docker-compose
* Composer Authentication

#### Docker

Install Docker for your platform.

* Mac: https://store.docker.com/editions/community/docker-ce-desktop-mac
* Windows: https://store.docker.com/editions/community/docker-ce-desktop-windows
* Linux: Please see your distributions package management system

#### docker-compose

Install docker-compose for your platform.

* Mac: Included with Docker
* Windows: Included with Docker
* Linux: Please see your distributions package management system

#### Composer Authentication

In order to install private packages, composer needs to authenticate with GitHub. By default, composer uses dist files (tarballs and such) instead of SSH since it is faster. This requires a personal access token as mandates the use of 2FA.

Please get a personal application token from GitHub. Instructions are below.

* GitHub: https://help.github.com/articles/creating-a-personal-access-token-for-the-command-line/

Next we'll create an `auth.json` file in your `$COMPOSER_HOME` folder.

The default paths are:

* Mac: `~/.composer/auth.json`
* Windows: ` %APPDATA%\..\Roaming\Composer\auth.json`
* Linux: ` ~/.config/composer/auth.json`

Update the file auth.json with:

```json
{
  "github-oauth": {
    "github.com": "YOUR_GITHUB_TOKEN"
  }
}
```

> **Note:** _If the file already exists, just add the missing keys._

### Misc.

It is recommended to create an alias for `docker-compose -f docker-compose.cli.yml run --rm` and call it `dcli` (Docker CLI).

If you are migrating from pre-existing setup of app you will need to remove the `vendor` directory.

```bash
rm -rf ./vendor
```

### Installation

**Step 1:** You need to clone the project.

```bash
cd ~/code # or whatever directory you keep your projects in

git clone git@github.com:bhut-it/treinamento-api.git

cd treinamento-api
```

**Step 2:** You need to copy the `*.dist` files to base file:

```bash
cp .env.dist .env
cp docker-compose.override.yml.dist docker-compose.override.yml
```

And update the `.env` for our system.

Before installing our dependencies we need the docker images that are being used.

```bash
docker-compose build --pull

docker-compose -f docker-compose.cli.yml build --pull
```

**Step 3:** Now you are able to install the dependencies. We are using PHP, etc. through Docker. In order to use tools like Composer through Docker, you must pass our commands to the Docker container:

The command `dcli ` is equal `docker-compose -f docker-compose.cli.yml run --rm`

```bash
dcli composer install
```

### Usage

To test application locally, execute the following command:

```bash
docker-compose up -d

dcli php artisan migrate
```
