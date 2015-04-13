<?php return [
    'baseUrl' => 'https://api.trello.com',
    'apiVersion' => '1',
    'operations' => [
        'AddMember' => [
            'httpMethod' => 'PUT',
            'uri' => '/{ApiVersion}/organizations/{idOrg}/members',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'key' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'token' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'idOrg' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'email' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'json',
                ],
                'fullName' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'json',
                ],
                'type' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'json',
                ],
            ]
        ],
        'RemoveMember' => [
            'httpMethod' => 'DELETE',
            'uri' => '/{ApiVersion}/organizations/{idOrg}/members/{idMember}',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'key' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'token' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'idOrg' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'idMember' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
            ]
        ],
        'ListMembers' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/organizations/{idOrg}/member',
            'responseModel' => 'Result',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'key' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'token' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'idOrg' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'filter' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                    'enum' => ['admins','all','none','normal','owners'],
                ],
                'fields' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'activity' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                    'enum' => ['true','false'],
                ],
            ]
        ],
    ],
    'models' => [
        'Result' => [
            'type' => 'object',
            'properties' => [
                'statusCode' => ['location' => 'statusCode'],
            ],
            'additionalProperties' => [
                'location' => 'json'
            ]
        ]
    ]

];