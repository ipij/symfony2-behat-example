Behaviour driven development. Business logic.
======================

#### Author

* Piotr Pelczar (me [at] athlan.pl)
* You can find me on: [LinkedIn](http://linkedin.com/in/ppelczar), [Stack Overflow](http://stackoverflow.com/users/1815881/athlan)

### Behat Scenarios

Scenarios are placed under `/features/` directory. Each feature is describd by `.feature file`.

### Run tests

To run *all* Behat scenarios, just run from application directory:

```
$ bin/behat
```

To run Behat scenarios from given tag, just run:

```
$ bin/behat --tags tag_name
```

where _tag_name_ is your `@tag_name` tagged features.

### Application

* User interface: [http://localhost/html/symfony2-behat-example/app_dev.php/](http://localhost/html/symfony2-behat-example/app_dev.php/)
* API interactive documentation: [http://localhost/html/symfony2-behat-example/app_dev.php/api/doc/](http://localhost/html/symfony2-behat-example/app_dev.php/api/doc/)
* There are two users:
  
  Username      | Password      | Role
  ------------- | ------------- | -------------
  Greg          | a             | User
  Katie         | a             | User

### File locations

* You can find **Behat configuration** under:

  - [/behat.yml](behat.yml) - Definitions of Features groupped by Suites. Each suite uses contexts.
  - [/features](features/) - List of features written in Gearman in `*.feature` files

* You can find **possible sentences** defined in Contexts:

  - [/src/AppBundle/Behat/Context/WebContext.php](src/AppBundle/Behat/Context/WebContext.php)
  - [https://github.com/Behat/MinkExtension/blob/master/src/Behat/MinkExtension/Context/MinkContext.php](https://github.com/Behat/MinkExtension/blob/master/src/Behat/MinkExtension/Context/MinkContext.php)

* You can find **fixtres (initial data)** under:

  - [/src/App/ModuleNotebook/Bundle/ModuleNotebookBundle/DataFixtures/ORM](src/App/ModuleNotebook/Bundle/ModuleNotebookBundle/DataFixtures/ORM)
  - [/src/App/ModuleUser/Bundle/ModuleUserBundle/DataFixtures/ORM](src/App/ModuleUser/Bundle/ModuleUserBundle/DataFixtures/ORM)
  