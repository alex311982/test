Feature: move vehicles according to set commnds
  In order to move cehicles within garage
  We create commands
  And set them to vehicles
  As a result commands are executed in context of related vehicles

  Scenario Outline:
    When I call with config name <name>
    Then I should get result <result>

    Examples:
      | name                      | result                                                                  |
      | services_test_normal.yml  | bmv-super-car\nSTART\nMUSIC ON\nairplane-best-for-fly\nTAKE OFF\nFLY\n   |
      | services_test_empty.yml   | Garage for testing is empty now                                         |


  Scenario Outline:
    When I call with config name <name>
    Then I should get exception with <result>

    Examples:
      | name                                  | result                          |
      | services_test_not_exist.yml           | The file "services_test_not_exist.yml" does not exist|
      | services_test_not_exist_vehicle.yml   | Vehicle not-exist-vehicle.vehicle is not exist |
      | services_test_not_exist_command.yml   | Command not-exist-command.command is not exist|



