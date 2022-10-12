##Creating entities
- php bin/console make:entity

##Creating migration versioning
- php bin/console make:migration
####Applying migration
- php bin/console doctrine:migration:migrate


#Steps to crete a new project
- Preparing Entities with make
- creating migration versionning
- applying migration with doctrine
- add entity properties if needed
- create Controllers an Repository
  - set methodes
  - set routes / names / requirements / methods
  - set ParamConverter
  
  
#Steps to create an API
- install api platform
    - composer require api
- add all entities (user among)
- add annotation to entities
- add relations between classes
- user should implements UserInterface interface
- add pasword encryption on sercutity.yml file
- add methods selection
- add groups entity for normalization
- add event subscriber for password encryption on prewrite
- add validator
- add regex validator for password : www.regex101.com
- install api platform
    - composer require lexik/jwt-authentication-bundle
- add JWT management
- cree private and publi key
    - openssl genrsa -out config/jwt/private.pem -aes256 4096
    - openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
- manage security actions : firewalls and access controls
- add access to entities
