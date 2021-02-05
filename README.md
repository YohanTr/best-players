# best-players

Instruction:

- Composer install
- Yarn install
- name DB = playerstats in .env.local
- Workflow = php bin/console doctrine:database:drop
             php bin/console doctrine:database:create
             php bin/console doctrine:migration:migrate
             php bin/console doctrine:fixtures:load
             
             
- symfony server:start
- yarn encore dev

All good
