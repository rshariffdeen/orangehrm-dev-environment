<?php

class UbuntuContainerCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function ContainerTest(AcceptanceTester $I){
        $I->wantTo("verify ubuntu container up and running");
        $I->runShellCommand("docker inspect -f {{.State.Running}} dev_web");
        $I->seeInShellOutput("true");
    }

    public function phpTest(AcceptanceTester $I){
        $I->wantTo("verify php 5.5 is installed in the container");
        $I->runShellCommand("docker exec dev_web php --version");
        $I->seeInShellOutput('PHP 5.5.9');
    }

    public function nodeTest(AcceptanceTester $I){
        $I->wantTo("verify node v4 is installed in the container");
        $I->runShellCommand("docker exec dev_web node -v");
        $I->seeInShellOutput('v4');
    }

    public function mysqlServerTest(AcceptanceTester $I){
        $I->wantTo("verify mysql server container is linked properly");
        $I->runShellCommand("docker exec dev_web mysqladmin -hdb -uroot -p1234 ping");
        $I->seeInShellOutput('is alive');
    }
}
