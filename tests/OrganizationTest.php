<?php
namespace tests;

include __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Command\Exception\CommandClientException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Trello\Organization;

class OrganizationTest extends \PHPUnit_Framework_TestCase
{
    public function testAddMember()
    {
        $mockBody = json_encode([
            "id" => "552bfa4aadda3e05254317k",
            "avatarHash" => null,
            "bio" => "",
            "bioData" => null,
            "confirmed" => false,
            "fullName" => "Test User",
            "idPremOrgsAdmin" => [],
            "initials" => "PT",
            "memberType" => "ghost",
            "products" => [],
            "status" => "disconnected",
            "url" => "https =>//trello.com/testuser1",
            "username" => "testuser1",
            "avatarSource" => null,
            "email" => "testuser@domain.org",
            "gravatarHash" => null,
            "idBoards" => [],
            "idOrganizations" => [
                "5519vgdgh561a4a4b51154123b"
            ],
            "loginTypes" => null,
            "oneTimeMessagesDismissed" => null,
            "prefs" => null,
            "trophies" => [],
            "uploadedAvatarHash" => null,
            "premiumFeatures" => [],
            "idBoardsPinned" => null,
        ]);

        $client = $this->getMockClient($mockBody);

        // Add user to org
        $user = $client->addMember([
            'idOrg' => '5519vgdgh561a4a4b51154123b',
            'email' => 'testuser@domain.org',
            'fullName' => 'Test User',
        ]);

        $this->assertEquals(200, $user['statusCode']);
        $this->assertEquals("552bfa4aadda3e05254317k", $user['id']);
    }

    public function testAddMemberAlreadyExists()
    {
        $mockBody = 'Member already invited';

        $client = $this->getMockClient($mockBody, 403);

        try {
            // Add user to org
            $user = $client->addMember([
                'idOrg' => '5519vgdgh561a4a4b51154123b',
                'email' => 'testuser@domain.org',
                'fullName' => 'Test User',
            ]);
        } catch (CommandClientException $e) {
            $response = $e->getResponse();
            $body = $response->getBody();

            $this->assertEquals(403, $response->getStatusCode());
            $this->assertEquals('Member already invited', $body);
        } catch (\Exception $e) {
            $this->fail('Unexpected exception');
        }

    }

    public function testRemoveMember()
    {
        $mockBody = json_encode([
            "id" => "5sbg5e97597761a12r1455da12b",
            "name" => "testingorg187",
            "displayName" => "Testing Org",
            "desc" => "Testing out the API",
            "descData" => null,
            "url" => "https =>//trello.com/testingorg187",
            "website" => null,
            "logoHash" => null,
            "products" => [],
            "powerUps" => [],
            "members" => [
                [
                    "id" => "5463vgse8f9e37a2154133c66f",
                    "avatarHash" => null,
                    "fullName" => "Different User",
                    "initials" => "DU",
                    "username" => "differentuser8",
                    "confirmed" => true
                ]
            ]
        ]);

        $client = $this->getMockClient($mockBody);


        // Remove user from org, returns org
        $org = $client->removeMember([
            'idOrg' => '5sbg5e97597761a12r1455da12b',
            'idMember' => '34fq44ggf4f4fvsavg5y6s6h',
        ]);

        $this->assertEquals(200, $org['statusCode']);
        $this->assertEquals("5sbg5e97597761a12r1455da12b", $org['id']);
    }

    public function testRemoveMemberDoesntExist()
    {
        $mockBody = 'membership not found';
        $client = $this->getMockClient($mockBody, 401);

        try {
            // Add user to org
            $user = $client->removeMember([
                'idOrg' => '5sbg5e97597761a12r1455da12b',
                'idMember' => '34fq44ggf4f4fvsavg5y6s6h',
            ]);
        } catch (CommandClientException $e) {
            $response = $e->getResponse();
            $body = $response->getBody();

            $this->assertEquals(401, $response->getStatusCode());
            $this->assertEquals('membership not found', $body);
        } catch (\Exception $e) {
            $this->fail('Unexpected exception');
        }
    }

    public function testListMembers()
    {
        $mockBody = json_encode([
            [
                "id" => "5vaf3ee8asg52213a9dc66f",
                "fullName" => "Testing User",
                "username" => "testuser1"
            ],
            [
                "id" => "525fde540abar435hfr6bc0",
                "fullName" => "Another Test",
                "username" => "anothertest1"
            ]
        ]);

        $client = $this->getMockClient($mockBody);

        // Add user to org
        $users = $client->listMembers([
            'idOrg' => '5519vgdgh561a4a4b51154123b',
        ]);

        $this->assertEquals(200, $users['statusCode']);
        // Use count()-1 because we don't want to count statusCode element
        $this->assertEquals(2, count($users)-1);
    }

    private function getMockClient(string $mockBody, int $responseCode = 200) : Organization
    {
        $config = include __DIR__ . '/config-test.php';

        $mockHandler = new MockHandler([
            new Response($responseCode, [], $mockBody),
        ]);

        $handlerStack = HandlerStack::create($mockHandler);
        return new Organization(array_merge([
            'http_client_options' => [
                'handler' => $handlerStack,
            ]
        ], $config));
    }
}
