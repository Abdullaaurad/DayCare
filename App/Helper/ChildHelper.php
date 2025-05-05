<?php

    namespace App\Helpers;

    class ChildHelper
    {
        public function store_child()
        {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $session = new \Core\Session;
            $UserID = $session->get('USERID');

            // Fetch ParentID based on the current user's ID
            $parent = new \Modal\ParentUser;
            $pre = $parent->first(['UserID' => $UserID]);
            $ParentID = $pre->ParentID;

            // Fetch all children for the ParentID
            $child = new \Modal\Child;
            $children = $child->where_norder(['ParentID' => $ParentID]);

            return $children;
        }

        public function child_count(){
            return count($this->store_child());
        }

        public function getAgeGroup($dob) {
            $session = new \Core\Session;
            $session->set("USERID", 1);
            $current_year = date("Y");
            $dob_date = new \DateTime($dob);
            $start_of_year = new \DateTime("$current_year-01-01");
            $age = $start_of_year->diff($dob_date)->y;
        
            // Define age groups
            $age_groups = ['3-5', '6-9', '10-13'];
            
            // Default AgeGroup
            $AgeGroup = '3-5';
        
            // Match age to group
            foreach ($age_groups as $group) {
                list($start, $end) = explode('-', $group);
                if ($age >= $start && $age <= $end) {
                    $AgeGroup = $group;
                    break;
                }
            }
        
            return $AgeGroup;
        }
        
    }

?>