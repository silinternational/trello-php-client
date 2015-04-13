<?php
namespace Trello;

use Trello\BaseClient;

/**
 * Partial Trello API client implemented with Guzzle.
 *
 * @method array addMember(array $config = [])
 * @method array removeMember(array $config = [])
 * @method array listMembers(array $config = [])
 */
class Organization extends BaseClient
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        // Apply some defaults.
        $config += [
            'description_path' => __DIR__ . '/descriptions/organization.php',
        ];

        // Create the client.
        parent::__construct(
            $config
        );

    }
}