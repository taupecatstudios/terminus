<?php

namespace Pantheon\Terminus\Commands\Import;

use Pantheon\Terminus\Commands\TerminusCommand;
use Pantheon\Terminus\Commands\WorkflowProcessingTrait;
use Pantheon\Terminus\Site\SiteAwareInterface;
use Pantheon\Terminus\Site\SiteAwareTrait;

/**
 * Class FilesCommand
 * @package Pantheon\Terminus\Commands\Import
 */
class FilesCommand extends TerminusCommand implements SiteAwareInterface
{
    use SiteAwareTrait;
    use WorkflowProcessingTrait;

    /**
     * Imports a file archive to the environment.
     *
     * @authorize
     *
     * @command import:files
     *
     * @param string $site_env Site & environment in the format `site-name.env`
     * @param string $url Publicly accessible URL of the file archive
     *
     * @usage <site>.<env> <archive_url> Imports the files in the archive at <archive_url> to <site>'s <env> environment.
     */
    public function import($site_env, $url)
    {
        list($site, $env) = $this->getSiteEnv($site_env);

        $tr = ['site' => $site->getName(), 'env' => $env->getName()];
        if (!$this->confirm('Are you sure you overwrite the files for {env} on {site}?', $tr)) {
            return;
        }

        $this->processWorkflow($env->importFiles($url));
        $this->log()->notice(
            'Imported files to {site}.{env}.',
            ['site' => $site->get('name'), 'env' => $env->id,]
        );
    }
}
