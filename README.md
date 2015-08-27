### Basic authenticator to show a simple way to decouple from the data layer

### How to test:
```
git clone https://github.com/marcelsud/backtothebasics.git
cd backtothebasics/authenticator
composer install
php app/array_authenticator.php
php app/csv_authenticator.php
php app/respect_authenticator.php
php app/pdo_authenticator.php
```

It should show something like this:

```
object(Basic\Login\Entity\User)#21 (3) {
  ["id":"Basic\Login\Entity\User":private]=>
  int(1)
  ["username":"Basic\Login\Entity\User":private]=>
  string(8) "john.doe"
  ["password":"Basic\Login\Entity\User":private]=>
  string(60) "$2y$10$R8E3yIfyjBrTXwq/c8F54e..sUHIx2THoZhvEg45ddC58eA2LnE46"
}
```
