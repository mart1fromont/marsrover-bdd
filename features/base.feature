Feature: You are given the initial starting point (x,y) of a rover and the direction (N,S,E,W) it is facing.
  - The rover receives a character array of commands.
  - Implement commands that move the rover forward/backward (f,b).
  - Implement commands that turn the rover left/right (l,r).
  - Implement wrapping at edges. But be careful, planets are spheres.
  Connect the x edge to the other x edge, so (1,1) for x-1 to (5,1),
  but connect vertical edges towards themselves in inverted coordinates, so (1,1) for y-1 connects to (5,1).
  - Implement obstacle detection before each move to a new square.
  If a given sequence of commands encounters an obstacle, the rover moves up to the last possible point, aborts the sequence and reports the obstacle.

  Scenario: Rover start at "x" and "y" in Mars
    Given there is a rover
    And there is Mars
    When I land the rover at "0", "1"
    Then Rover should be in "0", "1

  Scenario: Rover moves forward
    Given there is a rover
    And there is Mars
    When I land the rover at "0", "1"
    And I move the rover forward
    Then Rover should be in "0", "2"

  Scenario: Rover moves backward
    Given there is a rover
    And there is Mars
    When I land the rover at "0", "1"
    And I move the rover backward
    Then Rover should be in "0", "0"

  Scenario: Rover turns left
    Given there is a rover
    And there is Mars
    When I land the rover at "0", "1"
    And I turn the rover left
    Then Rover should be facing "W"

  Scenario: Rover turns right
    Given there is a rover
    And there is Mars
    When I land the rover at "0", "1"
    And I turn the rover right
    Then Rover should be facing "E"
