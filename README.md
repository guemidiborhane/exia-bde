# CESI.ei second year web project
This project was made during the second year at CESI.ei (CESI exia).

### Project members
* Borhaneddine GUEMIDI
* Aya BOUAKKAZ ([@bouakkazaya](https://github.com/bouakkazaya))
* Anis Fayçal YAGOUB ([@faycalnis](https://github.com/faycalnis))
* Hichem SOUMATI ([@hichemsoum](https://github.com/hichemsoum))

# Tools
* Laravel 5.8 (updated to Laravel 6 during the project)
* Vue.js: for some reusable components (eg: comments, likes, ...)
* express (for the [API](https://github.com/hichemsoum/exia-bde-api))

# Installation
For the PHP part:
```bash
# Clone the project
git clone --recursive https://github.com/guemidiborhane/exia-bde.git

# Install the dependencies
composer install
yarn

# Compile the assets
yarn run dev

# Run the server
php artisan serve
```

for the API, assuming you already cloned the master project (which has the API as a submodule):
```bash
cd exia-bde/node-api

# Install the dependencies
yarn

# Run the server
yarn run start
```

# Screenshots

## Homepage

![Homepage](screenshots/homepage.png?raw=true)

## Events Listing

![Events index page](screenshots/events@index.png?raw=true)

## Events Page

![Events show page](screenshots/events@show.png?raw=true)

# Notes
This project was made public so that other students **CAN SOLVE** some of their issues by seeing how we did it. **NOT TO USE IT** as is, so please respect this and don't try to pass it for your work.
