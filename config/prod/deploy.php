<?php

use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultDeployer;

return new class extends DefaultDeployer
{
    public function configure()
    {
        return $this->getConfigBuilder()
            ->server('root@peterton.nl')
            ->deployDir('/var/www/audit-proxy/')
            ->repositoryUrl('git@github.com:PtrTn/audit-proxy.git')
            ->repositoryBranch('master')
            ->composerInstallFlags('--prefer-dist --no-interaction')
        ;
    }

    public function beforePreparing()
    {
        // Todo, this copies a fresh .env file from git, instead of one with actual details.
        $this->runRemote(sprintf('cp {{ deploy_dir }}/repo/.env {{ project_dir }} 2>/dev/null'));
    }
};
