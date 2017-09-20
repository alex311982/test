Feature: weather indicator
  In order to get weather information
  As a user
  I want to get a human readable version of xml weather forcast

  Scenario Outline:
    Given config file by path ./garage/config/services.yml
    When I call for moving vehicles <vehicles>
    Then I should get result <result>

    Examples:
      | vehicles          | result                                                          |
      | bmv,airplane      | bmv-super-car:START,MUSIC ON;airplane-best-for-fly:TAKEOFF,FLY  |
      |                   | Garage is empty for now                                         |
      | bmv               | bmv-super-car:START,MUSIC ON;                                   |

  Scenario:
    Given config file by path garage/config/services_not_exist.yml
    When I call for moving vehicles bmv,airplane
    Then I should get an exception with message 'The file "services11.yml" does not exist'
