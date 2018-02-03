# eSales

## Prerequisites
    1.Have an installed version of Docker greater than or equal to 17.09
    2.Have and installed version of docker-compose 1.18.0
    3.Have an installed version of composer greater than or equal to 1.6.2

## How to start the project
    1.Enter the root of the project and execute composer install for the dependencies
      in composer.json to be downloaded.
    2.In the root of the project execute docker-compose up -d.
      This will start the docker containers in the configuration from the docker-compose.yml file.
    3.In the url bar of a browser enter http://esales.localhost:8000
      This address will access the web/index.php.

## About the project
    1.This project is an implementation of a mini-framework using components from symfony framework
      such as http-foundation, http-kernel, routing component, asset. The project also uses a
      powerful templating engine called twig. The project offers a MVC structure, and implicitly an OOP approac,
      thus offering a very maintainable codebase. It is also very easy for a newcomer to get used to the
      architecture of the project.
    2.The project can be cloned from github at : https://github.com/ChrisHng/esales.git

### Features of the project
    eSales offers basic implementation of the four basic functions of persistent storage (CRUD) for the Product
    entity. Besides this it also comes with login and sign-up functionalities.

### Employed Entities/Models
    1.DatabaseConnection - Created to establish a connection with the database and when needed to close the
      connection to the database. PDO interface is used to facilitate the communication with the database.
      For a detailed view, check eSales/Model/DatabaseConnection.
    2.Product - A mapping between this entity and the products relation. Offers an OOP approach to creating,
      reading, updating and deleting products on the web-site. For a detailed view, check
      eSales/Model/Product.
    3.User - A mapping between this entity and the users relation. Offers an OOP approach to creating,
      new users on the web-site. For a detailed view, check eSales/Model/User.

### Employed Controllers
    1.PageController - controller used to determine the output of all pages of http://esales.localhost:8000/{page}
      pages. See eSales/Controller/PageController for more details.
    2.ProductController - controller used to manage the products in the web-site. For a detailed explanation
      check eSales/Controller/ProductController.