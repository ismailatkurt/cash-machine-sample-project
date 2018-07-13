Feature: Testing sample request

  Scenario: 120 returns 100 and 20
    Given I am on "http://local.cashmachine.com"
    When I go to "/notes/withdraw/120"
    Then I should see "{\"result\":{\"0\":{\"100\":1},\"2\":{\"20\":1},\"3\":{\"10\":1}}}"