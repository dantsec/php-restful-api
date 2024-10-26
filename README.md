# Pure PHP Restful API 🚀

> The **Pure PHP Restful API** is a lightweight and efficient framework designed to facilitate the development of RESTful APIs using PHP. Its primary purpose is to streamline the process of creating web services that can handle various HTTP methods, allowing developers to easily manage data and interact with client applications.

## Authors 👥

- For more information see my blog and my contributions to community.
  - [**dantsec**](https://www.github.com/dantsec)

## Tech Stack 🧑‍💻

- This project was developed with the following technologies:
  - [**PHP**](https://www.php.net/) (Main Language)

## Documents 📂

- [**License**](./LICENSE)
- [**HTTP Collection**](./docs/php-api-collection/)

## Installation / Run Locally ⚙️

- **Important**: First of all, you must have **PHP** and a server like **APACHE** installed;

```bash
#
# Put the project into the server folder (e.g.: `public_html`, `/var/www/html`)
#

#
# Setup your database and start your server
#
# e.g.:
sudo systemctl start xampp

#
# Copy .env.example and configure it
#
cp config/.env.example .env

#
# Go to: <PROTOCOL>://<HOST>:<PORT>/<PROJECT_PATH>/public
#
# e.g.:
brave http://localhost:8080/php-restful-api/public/
```

## Todo List 📌

- Priority (**1**)
    - [ ] "Universalize" `{id}` field in `Core/Core.php` line 32.
    - [ ] Improve file security on `.htaccess`.
    - [ ] Make migrations.
    - [ ] Authentication.
- Priority (**2**)
    - [ ] Make it full MVC (implementing _view_ like laravel <3)

## Contributing 🛠️

```bash
# Create a fork from the original repository and clone it.
git clone https://github.com/dantsec/php-restful-api.git
# Enter into the project folder.
cd php-restful-api/
# Create a new branch with the name feat-[BRANCH_NAME].
git checkout -b feat-[BRANCH_NAME]
# Make your changes and commit them.
git add . && git commit -m "YOUR_COMMIT_MESSAGE"
# Push your branch and open a pull request.
git push origin feat-[BRANCH_NAME]
```
