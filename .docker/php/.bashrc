
# Note: PS1 and umask are already set in /etc/profile. You should not
# need this unless you want different defaults for root.
# PS1='${debian_chroot:+($debian_chroot)}\h:\w\$ '
# umask 022

# Aliases

# aliases Symfony
# Doctrine
alias make:entity='php bin/console make:entity'
alias make:migration='php bin/console make:migration'
alias migrations:migrate='php bin/console doctrine:migrations:migrate'
alias schema:drop='time php bin/console doctrine:schema:drop -f'
alias schema:update='time php bin/console doctrine:schema:update -f'
# Cache
alias cache:clear='php bin/console cache:clear'
alias cache:clear:prod='php bin/console cache:clear --env=prod'
# Debug
alias debug:autowiring='php bin/console debug:autowiring'
alias debug:config='php bin/console debug:config'
alias debug:container='php bin/console debug:container'
alias debug:form='php bin/console debug:form'
alias debug:router='php bin/console debug:router'
alias debug:translation='php bin/console debug:translation'
alias debug:twig='php bin/console debug:twig'
# PHP
alias fix:code='php bin/console fix:code'