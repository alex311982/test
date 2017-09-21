Feature: weather indicator
  In order to get weather information
  As a user
  I want to get a human readable version of xml weather forcast

  Scenario Outline:
    When I call with config name <name>
    Then I should get result <result>

    Examples:
      | name                      | result                                                                |
      | services_test_normal.yml  | bmv-super-car\nSTART\nMUSIC ON\nairplane-best-for-fly\nTAKEOFF\nFLY   |
      | services_test_empty.yml   | Garage for testing is empty now                                       |



