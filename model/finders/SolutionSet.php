<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SolutionSet
 *
 * @author pulasthi
 */
class SolutionSet {
    public static $selected_index = 0;
    public $solutions = array();
    
    public function add_solution($solution) {
        $this->solutions[] = $solution;
    }
}
?>
