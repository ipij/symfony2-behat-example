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
bin/behat
```

To run Behat scenarios from given tag, just run:

```
bin/behat --tags tag_name
```

where _tag_name_ is your `@tag_name` tagged features.
